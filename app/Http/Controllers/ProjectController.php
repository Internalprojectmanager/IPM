<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectValidator;
use Faker\Provider\DateTime;
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

    public function calcDeadline($data){
        $today = date('Y/m/d H:i');
        foreach ($data as $d){
            if($d->deadline !== NULL){
                $negative = NULL;
                $diff = strtotime($d->deadline) - strtotime($today);
                if($diff < 0){
                    $negative = "-";
                    $diff = strtotime($today) - strtotime($d->deadline);
                }
                $years = floor($diff / (365*60*60*24));
                $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
                $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

                if($negative == NULL && $years > 0){
                    if($years == 1){
                        $d->daysleft = $years. " year left";
                    }else{
                        $d->daysleft = $years. " year left";
                    }
                }
                else if($negative == NULL && $years < 1 && $months > 0){
                    if($months == 1){
                        $d->daysleft = $months. " month left";
                    }else{
                        $d->daysleft = $months. " months left";
                    }
                }
                else if($negative == NULL && $months < 1 && $years < 1 && $days > 3){
                    $d->daysleft = $days. " days left";
                }
                else{
                    if($negative == NULL && $days > 1){
                        $d->daysleft = "<span style='color:#FC1907;'>".$days. " days left</span>";
                    }else if ($negative == NULL && $days == 1){
                        $d->daysleft = "<span style='color:#FC1907;'>".$days. " day left</span>";
                    }else{
                        if($days == 0 && $months == 0 and $years == 0){
                            $d->daysleft = "<span style='color:#FC1907;'>Deadline Today</span>";
                        }else{
                            $d->daysleft = "<span style='color:#FC1907;'>Overdue</span>";
                        }

                    }
                }
            }
        }

        return $data;

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
        $projects = Project::with('company')
        ->orderByRaw("FIELD(status , 'Draft', 'In Progress', 'Canceled', 'Paused') ASC")->paginate(8);

        $projects = $this->calcDeadline($projects);
        if(!$projects){
            abort(404);
        }

        $projectcount = $projects->count();

        return view('project.project', compact('projects', 'projectcount'));
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
