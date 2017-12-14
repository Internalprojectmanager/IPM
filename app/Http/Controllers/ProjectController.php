<?php

namespace App\Http\Controllers;

use App\Assignee;
use App\Http\Requests\ProjectValidator;
use App\Status;
use Faker\Provider\DateTime;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Client;
use App\Project;
use App\Release;
use App\Document;
use App\Letter;
use App\User;
use Psy\Command\ListCommand\PropertyEnumerator;

class ProjectController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function calcDeadline($data, $type){

        $today = date('Y/m/d H:i');
        foreach ($data as $d){
            switch ($type){
                case 'project':
                    $status = $d->pstatus;
                    break;
                case 'release':
                    $status = $d->rstatus;
                    break;
                default:
                    $status = $d->pstatus;
                    break;
            }
            if($d->deadline !== NULL && $status->name !== 'Paused' && $status->name  !== 'Cancelled'){
                $negative = NULL;
                if($status->name  == 'Completed'){
                    $diff = strtotime($d->deadline) - strtotime($d->updated_at);
                }else{
                    $diff = strtotime($d->deadline) - strtotime($today);
                }

                if($diff < 0){
                    $negative = "-";
                    if($status->name  == 'Completed'){
                        $diff = strtotime($d->updated_at) - strtotime($d->deadline);
                    }else{
                        $diff = strtotime($today) - strtotime($d->deadline);
                    }
                }
                $years = floor($diff / (365*60*60*24));
                $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
                $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

                if(strtotime($d->updated_at) < strtotime($d->deadline) && $status->name == 'Completed'){
                    $d->daysleft = "<span class='tablesubtitle'>Completed on ". gmdate('d-m-Y', strtotime($d->updated_at)) . "</span>";
                }else if(strtotime($d->updated_at) > strtotime($d->deadline) && $status->name == 'Completed'){
                    $d->daysleft = "<span class='tablesubtitle'>Completed with $days days Overdue</span>";
                }else {
                    if ($negative == NULL && $years > 0) {
                        if ($years == 1) {
                            $d->daysleft = $years . " year left";
                        } else {
                            $d->daysleft = $years . " year left";
                        }
                    } else if ($negative == NULL && $years < 1 && $months > 0) {
                        if ($months == 1) {
                            $d->daysleft = $months . " month left";
                        } else {
                            $d->daysleft = $months . " months left";
                        }
                    } else if ($negative == NULL && $months < 1 && $years < 1 && $days > 3) {
                        $d->daysleft = $days . " days left";
                    } else {
                        if ($negative == NULL && $days > 1) {
                            $d->daysleft = "<span style='color:#FC1907;'>" . $days . " days left</span>";
                        } else if ($negative == NULL && $days == 1) {
                            $d->daysleft = "<span style='color:#FC1907;'>" . $days . " day left</span>";
                        } else {
                            if ($days == 0 && $months == 0 and $years == 0) {
                                $d->daysleft = "<span style='color:#FC1907;'>Deadline Today</span>";
                            } else {
                                $d->daysleft = "<span style='color:#FC1907;'>Overdue</span>";
                            }

                        }
                    }
                }
            }else{
                if($status->name == "Cancelled")
                    $d->daysleft = "<span class='tablesubtitle'>Cancelled on ". gmdate('d-m-Y', strtotime($d->updated_at)). "</span>";
            }
        }

        return $data;

    }


    public function addProject()
    {
        $companys = Client::all();
        $status = Status::where('type', 'progress')->get();
        $user = User::all();

        return view('project.add_project', compact('companys', 'status', 'user'));
    }

    public function storeProject(ProjectValidator $request)
    {
        $findproject = Project::where([['name', $request->project_name],['company_id', $request->company]])->first();
        if($findproject){
            return redirect()->back()->withErrors('Project name is already being used for this client');
        }else{
            $project = new Project();
            $project->name = $request->project_name;
            $project->company_id = strtoupper(substr($request->company,0 ,5));
            $project->status = $request->status;
            $project->description = $request->description;
            $project->deadline = $request->deadline;
            $project->save();

            $findproject = Project::where([['name', $request->project_name],['company_id', $request->company]])->first();
            if(!empty($request->assignee)){
                foreach ($request->assignee as $a){
                    $assingee = new Assignee();
                    $assingee->userid = $a;
                    $assingee->uuid = $findproject->id;
                    $assingee->save();
                }
            }



            return redirect()->route('overviewproject');
        }

    }

    public function overviewProject()
    {
        $projectcount = Project::all()->count();
        $projects = Project::sortable()->with('company', 'pstatus', 'assignee.users')
        ->orderByRAW(' (CASE WHEN deadline IS NULL then 1 ELSE 0 END)')->orderBy('deadline')->paginate(8);
        $projects = $this->calcDeadline($projects, 'project');
        $clients = Client::select('name')->get();
        $status = Status::where('type', 'Progress')->select('name')->get();

        return view('project.project', compact('projects', 'projectcount','clients', 'status'));
    }

    public function searchProject(Request $request){
            $search = $request->data[0]['value'];
            $client = $request->data[1]['value'];
            $status = $request->data[2]['value'];
            if(!empty($status)) {
                $status = Status::where('name', $status)->first();
            }if(!empty($client)) {
                $client = Client::search($client)->first();
            }


            if(isset($status->id) && isset($client->id)){
                $projects = Project::search($search)->where('status', $status->id)->where('company_id', $client->id)->paginate(8);
                $projectcount = Project::search($search)->where('status', $status->id)->where('company_id', $client->id)->get();
            }elseif(isset($status->id) && !isset($client->id)){
                $projects = Project::search($search)->where('status', $status->id)->paginate(8);
                $projectcount = Project::search($search)->where('status', $status->id)->get();
            }elseif(!isset($status->id) && isset($client->id)){
                $projects = Project::search($search)->where('company_id', $client->id)->paginate(8);
                $projectcount = Project::search($search)->where('company_id', $client->id)->get();
            }else{
                $projectcount = Project::search($search)->get();
                $projects = Project::search($search)->paginate(8);
            }
            $projects = $this->calcDeadline($projects, 'project');
            $projectcount = $projectcount->count();
            $status = Status::where('type', 'Progress')->get();
            return view('project.project_search', compact('projects','projectcount', 'status'));

        }

    public function detailsProject($company_id, $name)
    {
        $projects = Project::with('pstatus')->where(['name' => $name, 'company_id' =>$company_id])->first();
        if(!$projects){
            abort(404);
        }
        $companys = Client::where('id', $company_id)->first();
        $releases = Release::with('rstatus')->where('project_id', $projects->id)->get();
        $releases = $this->calcDeadline($releases, 'release');
        $documents = Document::where('project_id', $projects->id)->get();
        $letters = Letter::where('project_id', $projects->id)->get();

        return view('project.details_project', compact('projects', 'companys', 'releases', 'documents', 'letters'));
    }

    public function editProject($company_id, $name)
    {
        $projects = Project::with('company')->where(['name' =>  $name, 'company_id' => $company_id])->first();
        $companys = Client::all();

        return view('project.edit_project', compact('projects', 'companys'));
    }

    public function updateProject($company_id, $name, Request $request)
    {
        $project = Project::where(['name' => $name, 'company_id' => $company_id] )->first();
        $project_id = $project->company_id.''.strtoupper(substr($project->name,0 ,5));
        $new_project_id = strtoupper(substr($request->company,0 ,5)).strtoupper(substr($request->project_name,0 ,5));
        $release = Release::select('project_id')->where('project_id', $project->id)->get();
        $letter = Letter::select('project_id')->where('project_id', $project->id)->get();
        $document = Document::select('project_id')->where('project_id', $project->id)->get();

        if($release->count() > 0){
            foreach($release as $r){
                $r->fill(['project_id' => $new_project_id]);
            }
        }

        if($letter->count() > 0){
            foreach($letter as $l){
                $l->project_id = $new_project_id;
                $l->save();
            }
        }

        if($document->count() > 0){
            foreach($document as $d){
                $d->project_id = $new_project_id;
                $d->save();
            }
        }

        $project->name = $request->project_name;
        $project->company_id = strtoupper(substr($request->company,0 ,5));
        $project->id = $new_project_id;
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
