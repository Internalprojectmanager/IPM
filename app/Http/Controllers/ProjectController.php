<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectValidator;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Company;
use App\Project;
use App\Release;
use App\Document;
use App\Letter;

class ProjectController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function addProject()
    {
        $companys = Company::all();

        return view('project.add_project', compact('companys'));
    }

    public function storeProject(ProjectValidator $request)
    {
        $project_id = strtoupper(substr($request->company,0 ,5)).strtoupper(substr($request->project_name,0 ,5));
        $findproject = Project::find($project_id);
        if($findproject){
            return redirect()->back()->withErrors('Project name is already being used for this client');
        }else{
            $project = new Project();
            $project->id = $project_id;
            $project->name = $request->project_name;
            $project->company_id = strtoupper(substr($request->company,0 ,5));
            $project->description = $request->description;

            $project->save();

            return redirect()->route('overviewproject');
        }

    }

    public function overviewProject()
    {
        $projects = Project::with('company')->get();
        if(!$projects){
            abort(404);
        }

        return view('project.project', compact('projects'));
    }

    public function detailsProject($company_id, $name)
    {
        $projects = Project::where(['name' => $name, 'company_id' =>$company_id])->first();
        if(!$projects){
            abort(404);
        }
        $companys = Company::where('id', $company_id)->first();
        $releases = Release::where('project_id', $projects->id)->get();
        $documents = Document::where('project_id', $projects->id)->get();
        $letters = Letter::where('project_id', $projects->id)->get();

        return view('project.details_project', compact('projects', 'companys', 'releases', 'documents', 'letters'));
    }

    public function editProject($company_id, $name)
    {
        $projects = Project::with('company')->where(['name' =>  $name, 'company_id' => $company_id])->first();
        $companys = Company::all();

        return view('project.edit_project', compact('projects', 'companys'));
    }

    public function updateProject($company_id, $name, Request $request)
    {
        $request->validate([
            'project_name' => 'required|unique:project,name'
        ]);

        $project = Project::where(['name' => $name, 'company_id' => $company_id] )->first();
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
