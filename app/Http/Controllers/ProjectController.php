<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;

class ProjectController extends Controller
{
    public function projectOverwiew(){
        $projects = Project::with('company')->get();

        //dd($project);
        return view('project.overview_projects', compact('projects'));
    }
}
