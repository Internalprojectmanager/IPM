<?php

namespace App\Http\Controllers;

use App\Assignee;
use App\AssigneeRole;
use App\Http\Requests\ProjectValidator;
use App\Status;
use App\Team;
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
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Role;

class ProjectController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth', 'checkactive']);
    }

    public function projectsCollection($ids = null)
    {
        $projectprev = Project::with('company', 'pstatus', 'assignee.users', 'team')
            ->when(!empty($ids), function ($query) use ($ids) {
                return $query->whereIn('id', $ids);
            })
            ->where('deadline', '<=', Carbon::now('Europe/Amsterdam'))
            ->orderBy('deadline', 'desc')
            ->currentuserteam()
            ->get();
        $projectnull = Project::with('company', 'pstatus', 'assignee.users', 'team')
            ->when(!empty($ids), function ($query) use ($ids) {
                return $query->whereIn('id', $ids);
            })
            ->where('deadline', null)
            ->orderBy('deadline', 'desc')
            ->currentuserteam()
            ->get();
        $projectnext = Project::with('company', 'pstatus', 'assignee.users', 'team')
            ->when(!empty($ids), function ($query) use ($ids) {
                return $query->whereIn('id', $ids);
            })
            ->where('deadline', '>=', Carbon::now('Europe/Amsterdam'))
            ->currentuserteam()
            ->orderBy('deadline', 'asc')
            ->get();

        $projects = $projectnext->merge($projectprev);
        $projects = $projects->merge($projectnull);
        $perPage = 8;

        $currentPage = LengthAwarePaginator::resolveCurrentPage();

        if ($currentPage == 1) {
            $start = 0;
        } else {
            $start = ($currentPage - 1) * $perPage;
        }
        $projects = $this->calcDeadline($projects, 'project');
        $curprojects = $projects->slice($start, $perPage)->all();
        $projects = new LengthAwarePaginator($curprojects, count($projects), $perPage);
        $projects->setPath(LengthAwarePaginator::resolveCurrentPath());
        return $projects;
    }

    public function calcDeadline($data)
    {
        $now = Carbon::now()->endOfDay();
        foreach ($data as $d) {
            $deadline = Carbon::parse($d->deadline)->endOfDay();
            $d->daysleft = $now->diffInDays($deadline, false);
            if ($d->daysleft >= 30 && $d->daysleft < 365 || $d->daysleft <= -30 && $d->daysleft > -365) {
                $d->monthsleft = $now->diffInMonths($deadline, false);
            }
        }
        return $data;
    }

    public function storeProject(ProjectValidator $request)
    {
        $project = new Project();
        $project->name = $request->project_name;
        $project->team_id = $request->team;
        if (!empty($request->new_client)) {
            $client = Client::firstOrCreate(
                ['name' => $request->new_client, 'team_id' => $request->team],
                ['status' => Status::Name('Client')->first()->id]
            );
            $project->company_id = $client->id;
        } else {
            $project->company_id = $request->company;
        }
        $project->projectcode = mb_strtoupper($request->project_code);
        $project->status = Status::Name('Draft')->first()->id;
        $project->description = $request->description;
        $project->save();
        $project->projectcode = "P-" . str_pad($project->id, 4, "0", STR_PAD_LEFT);
        $project->save();

        if (!empty($request->new_client)) {
            $findproject = Project::where([
                ['name', $request->project_name],
                ['company_id', $client->id]
            ])->first();
        } else {
            $findproject = Project::where([
                ['name', $request->project_name],
                ['company_id', $request->company]
            ])->first();
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

    public function overviewProject()
    {
        $projectcount = Project::select('id')
            ->currentuserteam()->get()->count();
        $projects = $this->projectsCollection();
        $client = Client::select('name', 'id')
            ->currentuserteam()->orderby('name', 'asc')->get();
        $status = Status::where('type', 'Progress')->select('name', 'id')->get();
        $teams = Auth::user()->teams();
        return view('project.project', compact('projects', 'projectcount', 'client', 'status', 'teams'));
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

        if (empty($pro)) {
            $pro = [0];
        }

        if (!isset($order)) {
            $projects = $this->projectsCollection($pro);
        } else {
            $projects = Project::with('pstatus', 'team')
                ->sortable([$sort => $order])
                ->currentuserteam()
                ->whereIn('project.id', $pro)
                ->paginate(8, ['*'], 'page', $page);
        }
        $projects = $this->calcDeadline($projects);
        $status = Status::where('type', 'Progress')->get();
        return view('project.project_table', compact('projects', 'projectcount', 'status'));
    }

    public function detailsProject($project)
    {
        $releases = Release::with('rstatus')
            ->where('project_id', $project->id)
            ->orderBy('version', 'desc')
            ->get();
        $releases = $this->calcDeadline($releases);
        $documents = Document::where('project_id', $project->id)->get();
        $user = Team::find($project->team_id)->users()->get();
        $assignee = Assignee::with('users', 'role')->where('uuid', $project->id)->get();
        $roles = Role::orderBy('id', 'asc')->get();
        $status = Status::where('type', 'Progress')->get();
        $client = $project->company;
        return view(
            'project.details_project',
            compact('project', 'client', 'releases', 'documents', 'user', 'assignee', 'status', 'roles')
        );
    }

    public function editProject($project)
    {
        $status = Status::Type('Progress')->get();
        $companys = Client::select('name', 'id')
            ->currentuserteam()->where('team_id', $project->team_id)->get();
        return view('project.edit_project', compact('project', 'companys', 'status'));
    }

    public function addProject()
    {
        $client = Client::select('name', 'id')
            ->currentuserteam()->get();
        $status = Status::where('type', 'Progress')->select('name', 'id')->get();
        $teams = Auth::user()->teams();
        return view('project.add_project_form', compact('teams', 'client', 'status'));
    }

    public function updateProject($project, ProjectValidator $request)
    {
        $project->name = $request->project_name;
        $client = $project->company;
        if (!empty($request->new_client)) {
            $client = Client::firstOrCreate(['name' => $request->new_client]);
            $client->name = $request->new_client;
            $client->team_id = Auth::user()->currentTeam()->id;
            $client->path = strtolower(str_replace(" ", "-", $client->name));
            $client->save();
            $project->company_id = $client->id;
        } else {
            $project->company_id = $request->company;
        }
        $project->status = $request->status;
        $project->description = $request->description;
        if (!empty($request->deadline)) {
            $project->deadline = date("Y-m-d", strtotime($request->deadline));
        }
        $project->save();

        $project = $project->path;
        $client = $client->path;

        return redirect()->route('projectdetails', compact('client', 'project'));
    }

    public function deleteProject($client, $project)
    {
        $project->delete();
        return redirect()->route('overviewproject');
    }

    public function updateAssignees($project, Request $request)
    {
        $client = $project->company;

        if (empty($request->assignee)) {
            $request->assignee = array();
        }
        $ids = [];
        $keys = [];
        foreach ($request->assignee as $key => $val) {
            $keys[] = $key;
            foreach ($val as $as) {
                $ids[] = $as;
            }
        }
        $assignee = $request->assignee;

        foreach (Role::all() as $role) {
            if (!in_array($role->name, $keys)) {
                $assignee[$role->name] = array();
            }
        }

        $assignees = Assignee::where('uuid', $project->id)->get();
        foreach ($assignees as $a) {
            AssigneeRole::where('assignee_id', $a->id)->delete();
            if (!in_array($a->userid, $ids)) {
                $a->delete();
            }
        }

        foreach ($assignee as $key => $val) {
            foreach ($val as $as) {
                $assignees = Assignee::where([['uuid', $project->id], ['userid', $as]])->first();
                if (empty($assignees)) {
                    $assignees = new Assignee();
                    $assignees->userid = $as;
                    $assignees->uuid = $project->id;
                    $assignees->save();
                }
                $assignee_role = new AssigneeRole();
                $assignee_role->assignee_id = $assignees->id;
                $assignee_role->role_id = Role::name($key)->id;
                $assignee_role->save();
            }
        }

        $client = $client->path;
        $project = $project->path;
        return redirect()->route('projectdetails', compact('client', 'project'));
    }
}
