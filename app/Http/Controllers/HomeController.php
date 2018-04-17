<?php

namespace App\Http\Controllers;

use App\Assignee;
use App\Requirement;
use Illuminate\Http\Request;
use App\Status;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        return redirect()->route('dashboard');
    }

    public function calcDeadline($data){
        $now = Carbon::now()->endOfDay();
        foreach($data as $d){
            $deadline  = Carbon::parse($d->features->releases->deadline)->endOfDay();
            $d->features->releases->daysleft = $now->diffInDays($deadline, false);
            if($d->features->releases->daysleft >= 30 && $d->features->releases->daysleft < 365 ||
                $d->features->releases->daysleft <= -30 && $d->features->releases->daysleft > -365){
                $d->features->releases->monthsleft = $now->diffInMonths($deadline, false);
            }
        }

        return $data;
    }

    public function dashboard(Request $request)
    {
        $requirements = [];
        $status = Status::wherein('name', ['Draft', 'In Progress', 'Testing'])->select('name');
        $assinged = Assignee::where('userid', \Auth::id())->where('status', '!=', Status::name('Completed')->id)->select('uuid')->get();

        if($assinged){
            foreach ($assinged as $a){
                $validator = \Validator::make(['uuid' => $a->uuid], ['uuid' => 'uuid']);
                if($validator->passes()):
                    $requirements[] = $a->uuid;
                endif;
            }
        }
        $requirements = Requirement::with('features.releases.projects.company', 'rstatus', 'assignees')
            ->whereHas('rstatus', function($query) use ($status) {
                $query->wherein('name', $status);
            })->whereHas( 'features.releases', function($q2) {
                $q2->orderbyraw('-deadline desc');
            })->whereHas('assignees', function ($q3){
                $q3->where('userid', \Auth::id());
            })->whereIn('requirement_uuid', $requirements);

        $requirementscount = $requirements->get()->count();
        $requirements = $requirements->paginate(10);

        $requirements = $this->calcDeadline($requirements);
        $status  = Status::type('Progress')->get();


        if($request->method() == 'POST') {
            return view('profile.dashboard_table', compact('requirements', 'requirementscount', 'status'));

        }

        return view('profile.dashboard', compact('requirements', 'requirementscount', 'status'));
    }

    public function dashboardSearch(Request $request){
        if(isset($request->data)){
            return app('App\Http\Controllers\RequirementController')->saveAuthStatus($request);
        }

        $pro = array();
        $page = $request->page;
        $search = $request->search;

        $requirements = [];
        $features = [];
        $status = Status::wherein('name', ['Draft', 'In Progress', 'Testing'])->select('name');
        $assinged = Assignee::where('userid', \Auth::id())->where('status', '!=', Status::name('Completed')->id)->select('uuid')->get();
        $feature = Requirement::search($search)->get();

        if($assinged){
            foreach ($assinged as $a){
                $validator = \Validator::make(['uuid' => $a->uuid], ['uuid' => 'uuid']);
                if($validator->passes()):
                    $requirements[] = $a->uuid;
                endif;
            }
        }

        if($feature){
            foreach ($feature as $f){
                if(in_array($f->requirement_uuid, $requirements)){
                    $features[] = $f->requirement_uuid;
                }
            }
        }

        $feature = Requirement::with('features.releases.projects.company', 'rstatus')
            ->whereHas('rstatus', function($query) use ($status) {
                $query->wherein('name', $status);
            })->whereHas( 'features.releases', function($q2) {
                $q2->orderbyraw('-deadline desc');
            })->whereIn('requirement_uuid', $features);

        $requirementscount = $feature->get()->count();

        if ($requirementscount <= 10) {
            $page = 1;
        }
        $feature = $feature->paginate(10, ['*'], 'page', $page);

        $requirements = $this->calcDeadline($feature);
        $status  = Status::type('Progress')->get();

        return view('profile.dashboard_table', compact('requirements', 'requirementscount', 'status'));
    }
}
