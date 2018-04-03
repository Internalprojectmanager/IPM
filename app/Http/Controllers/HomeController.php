<?php

namespace App\Http\Controllers;

use App\Assignee;
use App\Requirement;
use Illuminate\Http\Request;

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
    public function index()
    {
        $requirements = [];
        $assinged = Assignee::where('userid', \Auth::id())->select('uuid')->get();



        foreach ($assinged as $a){
            $requirements[] = $a->uuid;
        }

        $feature = Requirement::with('features.releases.projects.company', 'rstatus')->whereIn('requirement_uuid', $requirements)->get();

        return view('profile.dashboard', compact('feature'));
    }
}
