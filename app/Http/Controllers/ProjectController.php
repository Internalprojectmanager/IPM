<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Company;
use App\Project;

class ProjectController extends Controller
{
    public function addProject()
    {
        $companys = Company::all();

        return view('project.add_project', compact('companys'));
    }

    public function storeProject($company, Request $request)
    {
        $project = new Project();
        $project->id =strtoupper(substr($request->project_name,0 ,5));
        $project->name = $request->project_name;
        $project->company_id = Company::all()->where('name', $company);
        $project->description = $request->description;

        $project->save();

        return redirect()->route('overviewproject');
    }
    public function projectOverwiew(){
        $projects = Project::with('company')->get();

        return view('project.overview_projects', compact('projects'));
    }
}
