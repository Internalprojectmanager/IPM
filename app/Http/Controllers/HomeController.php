<?php

namespace App\Http\Controllers;

use App\Assignee;
use App\Requirement;
use Illuminate\Http\Request;
use App\Status;

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
            })->whereIn('requirement_uuid', $requirements)->get();

        return view('profile.dashboard', compact('feature'));
    }
}
