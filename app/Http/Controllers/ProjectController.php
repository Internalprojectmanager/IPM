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

    public function storeProject(Request $request)
    {
        $request->validate([
            'project_name' => 'required|unique:project,name'
        ]);

        $project = new Project();
        $project->id = strtoupper(substr($request->project_name,0 ,5));
        $project->name = $request->project_name;
        $project->company_id = strtoupper(substr($request->company,0 ,5));
        $project->description = $request->description;

        $project->save();

        return redirect()->route('overviewproject');
    }

    public function overviewProject()
    {
        $projects = Project::all();

        return view('project.project', compact('projects'));
    }

    public function detailsProject($name, $company_id)
    {
        $projects = Project::where('name', $name)->first();
        $companys = Company::where('id', $company_id)->first();

        return view('project.details_project', compact('projects', 'companys'));
    }

    public function editProject($name)
    {
        $projects = Project::all()->where('name', $name);
        $companys = Company::all();

        return view('project.edit_project', compact('projects', 'companys'));
    }

    public function updateProject($name, Request $request)
    {
        $request->validate([
            'project_name' => 'required|unique:project,name'
        ]);

        $project = Project::all()->where('name', $name)->first();
        $project->id =strtoupper(substr($request->project_name,0 ,5));
        $project->name = $request->project_name;
        $project->company_id = strtoupper(substr($request->company,0 ,5));
        $project->description = $request->description;

        $project->save();

        return redirect()->route('overviewproject');
    }

    public function deleteProject($name)
    {
        $project = Project::where('name', $name);
        $project->delete();

        return redirect()->route('overviewproject');
    }
}
