<?php

namespace App\Http\Controllers;

use App\Assignee;
use App\Http\Requests\ProjectValidator;
use App\Status;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Routing\Controller as BaseController;
use App\Client;
use App\Project;
use App\Release;
use App\Document;
use App\User;
use Illuminate\Support\Facades\DB;

class ProjectController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function projectsCollection($ids = null){

        if(isset($ids)){
            $projectnext = Project::with('company', 'pstatus', 'assignee.users')
                ->whereIn('id', $ids)->where('deadline', '>=', Carbon::now('Europe/Amsterdam'))->orderBy('deadline', 'asc')->get();
            $projectprev = Project::with('company', 'pstatus', 'assignee.users')
                ->whereIn('id', $ids)->where('deadline', '<=', Carbon::now())
                ->orderBy('deadline', 'desc')->get();
            $projectnull= Project::with('company', 'pstatus', 'assignee.users')
                ->whereIn('id', $ids)
                ->where('deadline', '=', NULL)->get();
        }else{
            $projectnext = Project::with('company', 'pstatus', 'assignee.users')
                ->where('deadline', '>=', Carbon::now('Europe/Amsterdam'))->orderBy('deadline', 'asc')->get();
            $projectprev = Project::with('company', 'pstatus', 'assignee.users')
                ->where('deadline', '<=', Carbon::now())
                ->orderBy('deadline', 'desc')->get();
            $projectnull= Project::with('company', 'pstatus', 'assignee.users')
                ->where('deadline', '=', NULL)->get();
        }

        $projects = $projectnext->merge($projectprev);
        $projects = $projects->merge($projectnull);
        $perPage = 8;

        $currentPage = LengthAwarePaginator::resolveCurrentPage();

        if ($currentPage == 1) {
        $start = 0;
        }
        else {
            $start = ($currentPage - 1) * $perPage;
        }
        $projects = $this->calcDeadline($projects, 'project');
        $curprojects = $projects->slice($start, $perPage)->all();
        $projects = new LengthAwarePaginator($curprojects, count($projects), $perPage);
        $projects->setPath(LengthAwarePaginator::resolveCurrentPath());
        return $projects;
    }

    public function calcDeadline($data, $type)
    {

        $today = date('Y/m/d H:i');
        foreach ($data as $d) {
            switch ($type) {
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

            if ($d->deadline !== NULL && $status->name !== 'Paused' && $status->name !== 'Cancelled') {
                $negative = NULL;
                if ($status->name == 'Completed') {
                    $diff = strtotime($d->deadline) - strtotime($d->updated_at);
                } else {
                    $diff = strtotime($d->deadline) - strtotime($today);
                }

                if ($diff < 0) {
                    $negative = "-";
                    if ($status->name == 'Completed') {
                        $diff = strtotime($d->updated_at) - strtotime($d->deadline);
                    } else {
                        $diff = strtotime($today) - strtotime($d->deadline);
                    }
                }
                $years = floor($diff / (365 * 60 * 60 * 24));
                $months = floor(($diff - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
                $days = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));

                if (strtotime($d->updated_at) < strtotime($d->deadline) && $status->name == 'Completed') {
                    $d->daysleft = "<span class='tablesubtitle'>Completed: " . gmdate('d-m-Y', strtotime($d->updated_at)) . "</span>";
                } else if (strtotime($d->updated_at) > strtotime($d->deadline) && $status->name == 'Completed') {
                    $d->daysleft = "<span class='tablesubtitle'>Completed: $days days Overdue</span>";
                } else {
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
            } else {
                if ($status->name == "Cancelled")
                    $d->daysleft = "<span class='tablesubtitle'>Cancelled on " . gmdate('d-m-Y', strtotime($d->updated_at)) . "</span>";
                if ($status->name == "Paused")
                    $d->daysleft = "<span class='tablesubtitle'>Paused on " . gmdate('d-m-Y', strtotime($d->updated_at)) . "</span>";
            }
        }

        return $data;

    }

    public function storeProject(ProjectValidator $request)
    {
        $findproject = Project::where([['name', $request->project_name], ['company_id', $request->company]])->first();
        if ($findproject) {
            return redirect()->back()->withErrors('Project name is already being used for this client');
        } else {
            $project = new Project();
            $project->name = $request->project_name;
            $project->path = strtolower(str_replace(" ", "-", $project->name));
            if (!empty($request->new_client)) {
                $client = Client::firstOrCreate(['name' => $request->new_client, 'path' => strtolower(str_replace(" ", "-", $request->new_client)), 'status' => Status::Name('Client')->first()->id]);
                $project->company_id = $client->id;
            } else {
                $project->company_id = $request->company;
            }
            $project->projectcode = mb_strtoupper($request->project_code);
            $project->status = Status::Name('Draft')->first()->id;
            $project->description = $request->description;
            $project->save();
            $project->projectcode = "P-".str_pad($project->id,  4, "0", STR_PAD_LEFT);
            $project->save();

            if (!empty($request->new_client)) {
                $findproject = Project::where([['name', $request->project_name], ['company_id', $client->id]])->first();
            } else {
                $findproject = Project::where([['name', $request->project_name], ['company_id', $request->company]])->first();
            }
            if (!empty($request->assignee)) {
                foreach ($request->assignee as $a) {
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
        $projectcount = Project::select('id')->get()->count();
        $projects = $this->projectsCollection();
        $clients = Client::select('name', 'id')->get();
        $status = Status::where('type', 'Progress')->select('name', 'id')->get();
        $user = User::all();

        return view('project.project', compact('projects', 'projectcount', 'clients', 'status', 'user'));
    }

    public function searchProject(Request $request)
    {
        $pro = array();
        $search = $request->search;
        $client = $request->client;
        $status = $request->status;
        $sort = $request->sort;
        $order = $request->order;
        $page = $request->page;

        $projects = Project::search($search);
        if (isset($status)) {
            $projects->where('status', $status);
        }
        if (isset($client)) {
            $projects->where('company_id', $client);
        }
        $projectcount = $projects->get()->count();

        if ($projectcount <= 8) {
            $page = 1;
        }
        $projects = $projects->get();

        foreach ($projects as $p) {
            $pro[] = $p->id;
        }



        if(!isset($order)) {
            $projects = $this->projectsCollection($pro);
        }else{
            $projects = Project::with('pstatus')
                ->sortable([$sort => $order])
                ->whereIn('project.id', $pro)
                ->paginate(8, ['*'], 'page', $page);
        }
        $projects = $this->calcDeadline($projects, 'project');
        $status = Status::where('type', 'Progress')->get();
        return view('project.project_table', compact('projects', 'projectcount', 'status'));
    }

    public function detailsProject($company_id, $name)
    {
        $client = Client::where('path', $company_id)->first();
        $projects = Project::with('pstatus')->where(['path' => $name, 'company_id' => $client->id])->first();
        if (!$projects) {
            abort(404);
        }
        $releases = Release::with('rstatus')->where('project_id', $projects->id)->orderBy('version', 'desc')->get();
        $releases = $this->calcDeadline($releases, 'release');
        $documents = Document::where('project_id', $projects->id)->get();
        $user = User::orderby('job_title', 'desc')->orderby('last_name', 'asc')->get();
        $assignee = Assignee::with('users')->where('uuid', $projects->id)->get();
        $status = Status::where('type', 'Progress')->get();
        return view('project.details_project', compact('projects', 'client', 'releases', 'documents', 'user', 'assignee', 'status'));
    }

    public function editProject($company_id, $name)
    {
        $client = Client::where('path', $company_id)->select('id')->first();
        $projects = Project::with('company')->where(['path' => $name, 'company_id' => $client->id])->first();
        $status = Status::where('type', 'Progress')->get();
        $companys = Client::all();

        return view('project.edit_project', compact('projects', 'companys', 'status'));
    }

    public function updateProject($company_id, $name, ProjectValidator $request)
    {
        $client = Client::where('path', $company_id)->select('id', 'path')->first();
        $project = Project::where(['path' => $name, 'company_id' => $client->id])->first();
        $release = Release::select('project_id')->where('project_id', $project->id)->get();
        $project->name = $request->project_name;
        $project->path = strtolower(str_replace(" ","-",$project->name));

        if (!empty($request->new_client)) {
            $client = Client::firstOrCreate(['name' => $request->new_client]);
            $client->name = $request->new_client;
            $client->path = strtolower(str_replace(" ","-",$client->name));
            $client->save();
            $project->company_id = $client->id;
        } else {
            $project->company_id = $request->company;
        }
        $project->status = $request->status;
        $project->projectcode = $request->project_code;
        $project->description = $request->description;
        if (!empty($request->deadline)) {
            $project->deadline = date("Y-m-d", strtotime($request->deadline));
        }
        $project->save();

        $company_id = $client->path;
        $name = $project->path;
        return redirect()->route('projectdetails', compact('company_id', 'name'));
    }

    public function deleteProject($company_id, $name)
    {
        $client = Client::where('path', $company_id)->select('id')->first();
        $project = Project::where(['path' => $name, 'company_id' => $client->id])->first();
        $project->delete();

        return redirect()->route('overviewproject');
    }

    public function updateAssignees($company_id, $name, Request $request)
    {
        if(empty($request->assignee)){
            $request->assignee = array();
        }

        $client = Client::where('path', $company_id)->select('id', 'path')->first();
        $project = Project::where(['path' => $name, 'company_id' => $client->id])->first();
        $assignees = Assignee::where('uuid', $project->id)->get();
        foreach ($assignees as $a) {
            if (!in_array($a->userid, $request->assignee)) {
                $a->delete();
            }
        }

        foreach ($request->assignee as $as) {
            $assignees = Assignee::where([['uuid', $project->id], ['userid', $as]])->first();
            if (empty($assignees)) {
                $assignee = new Assignee();
                $assignee->userid = $as;
                $assignee->uuid = $project->id;
                $assignee->save();

            }
        }
        return redirect()->route('projectdetails', compact('company_id', 'name'));
    }
}
