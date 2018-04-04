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
        return redirect()->route('overviewproject');
    }

    public function calcDeadline($data){
        $now = Carbon::now();
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

    public function dashboard()
    {
        $requirements = [];
        $status = Status::wherein('name', ['Draft', 'In Progress'])->select('name');
        $assinged = Assignee::where('userid', \Auth::id())->select('uuid')->get();

        if($assinged){
            foreach ($assinged as $a){
                $validator = \Validator::make(['uuid' => $a->uuid], ['uuid' => 'uuid']);
                if($validator->passes()):
                    $requirements[] = $a->uuid;
                endif;
            }
        }
        $feature = Requirement::with('features.releases.projects.company', 'rstatus')
            ->whereHas('rstatus', function($query) use ($status) {
                $query->wherein('name', $status);
            })->whereHas( 'features.releases', function($q2) {
                $q2->orderbyraw('-deadline desc');
            })->whereIn('requirement_uuid', $requirements);

        $featurecount = $feature->get()->count();
        $feature = $feature->paginate(10);

        $feature = $this->calcDeadline($feature);

        return view('profile.dashboard', compact('feature', 'featurecount'));
    }

    public function dashboardSearch(Request $request){
        $pro = array();
        $page = $request->page;

        $requirements = [];
        $status = Status::wherein('name', ['Draft', 'In Progress'])->select('name');
        $assinged = Assignee::where('userid', \Auth::id())->select('uuid')->get();

        if($assinged){
            foreach ($assinged as $a){
                $validator = \Validator::make(['uuid' => $a->uuid], ['uuid' => 'uuid']);
                if($validator->passes()):
                    $requirements[] = $a->uuid;
                endif;
            }
        }

        $feature = Requirement::with('features.releases.projects.company', 'rstatus')
            ->whereHas('rstatus', function($query) use ($status) {
                $query->wherein('name', $status);
            })->whereHas( 'features.releases', function($q2) {
                $q2->orderbyraw('-deadline desc');
            })->whereIn('requirement_uuid', $requirements);

        $featurecount = $feature->get()->count();

        if ($featurecount <= 10) {
            $page = 1;
        }
        $feature = $feature->paginate(10, ['*'], 'page', $page);

        $feature = $this->calcDeadline($feature);
        return view('profile.dashboard_table', compact('feature', 'featurecount'));
    }
}
