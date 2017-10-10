<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Company;
use App\Project;
use App\Release;

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
        $projects = Project::with('Company')->get();


        return view('project.project', compact('projects'));
    }

    public function detailsProject($company_id, $name)
    {
        $projects = Project::where(['name' => $name, 'company_id' =>$company_id])->first();
        $companys = Company::where('id', $company_id)->first();
        $releases = Release::all();

        return view('project.details_project', compact('projects', 'companys', 'releases'));
    }

    public function editProject($company_id, $name)
    {
        $projects = Project::where(['name' =>  $name, 'company_id' => $company_id])->first();
        $companys = Company::all();

        return view('project.edit_project', compact('projects', 'companys'));
    }

    public function updateProject($company_id, $name, Request $request)
    {
        $request->validate([
            'project_name' => 'required|unique:project,name'
        ]);

        $project = Project::where(['name' => $name, 'company_id' => $company_id] )->first();
        $project->id =strtoupper(substr($request->project_name,0 ,5));
        $project->name = $request->project_name;
        $project->company_id = strtoupper(substr($request->company,0 ,5));
        $project->description = $request->description;

        $project->save();

        return redirect()->route('overviewproject');
    }

    public function deleteProject($company_id, $name)
    {
        $project = Project::where(['name' => $name, 'company_id' => $company_id])->first();
        $project->delete();

        return redirect()->route('overviewproject');
    }
}
