<?php

namespace App\Http\Controllers;

use App\Requirement;
use App\TeamPlan;
use App\UserTeam;
use Illuminate\Http\Request;
use App\Team;
use App\User;
use App\Project;
use App\Assignee;
use Auth;
use App\Plan;

class TeamController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function show($team)
    {

        $teamcheck = \Auth::user()->team()
            ->wherePivot('team_id', $team->id)
            ->first();


        if ($teamcheck == null) {
            abort(403, "No Access, Please contact a Team Administrator for access");
        }

        $users = User::all();

        return view('team.show_team', compact('team', 'users'));
    }

    public function new()
    {
        return view('team.team_add');
    }

    public function store(Request $request)
    {
        $team = new Team();
        $team->name = $request->team_name;
        $team->owner_id = Auth::id();
        $team->slogan = $request->team_slogan;
        if ($request->hasFile('upload')) {
            \Storage::makeDirectory("public/team/" . str_slug($team->name));
            $path = $request->file('upload')->storeAs("public/team/" . str_slug($team->name), $request->upload->getClientOriginalName());
            $team->logo = '/team/'. str_slug($team->name). '/'. $request->upload->getClientOriginalName();
        }
        $team->save();

        //Auto add SystemAdmin to Team
        $teamuser = new UserTeam();
        $teamuser->user_id = User::first()->id;
        $teamuser->team_id = $team->id;
        $teamuser->current = false;
        $teamuser->active = true;
        $teamuser->save();

        $teamuser = new UserTeam();
        $teamuser->user_id = Auth::id();
        $teamuser->team_id = $team->id;
        $teamuser->current = false;
        $teamuser->active = true;
        $teamuser->save();

        $teamplan = new TeamPlan();
        $teamplan->plan_id = Plan::name('No Plan')->id;
        $teamplan->team_id = $team->id;
        $teamplan->start = \Carbon\Carbon::now('Europe/Amsterdam')->toDateTimeString();
        $teamplan->end =  \Carbon\Carbon::now('Europe/Amsterdam')->addYears(10)->toDateTimeString();
        $teamplan->save();

        return redirect()->route('team.show', $team->slug);
    }
    public function edit($team)
    {
        return view('team.team_edit', compact('team'));
    }

    public function update(Request $request, $team)
    {
        $team->name = $request->team_name;
        $team->owner_id = Auth::id();
        $team->slogan = $request->team_slogan;
        if ($request->hasFile('upload')) {
            \Storage::makeDirectory("public/team/" . str_slug($team->name));
            $path = $request->file('upload')->storeAs("public/team/" . str_slug($team->name), $request->upload->getClientOriginalName());
            $team->logo ='/team/'. str_slug($team->name). '/'. $request->upload->getClientOriginalName();
        }
        $team->save();

        return redirect()->route('team.show', $team->slug);
    }

    public function storeMember(Request $request, $team)
    {
        if ($request->member > 0) {
            foreach ($request->member as $member) {
                $teammember = UserTeam::where('user_id', $member)->where('team_id', $team->id)->first();
                if (empty($teammember)) {
                    $teammember = new UserTeam();
                    $teammember->user_id = $member;
                    $teammember->team_id = $team->id;
                }

                if (User::find($member)->currentTeam() == null) {
                    $teammember->current = true;
                } else {
                    $teammember->current = false;
                }
                $teammember->save();
            }
        }

        return redirect()->route('team.show', $team->slug);
    }


    public function deleteMember(Request $request, $team, $member)
    {
            Team::name($team->name)->users()->detach($member);

            $projects = Project::where('team_id', $team->id)->select('id')->get();
            $requirements = Requirement::with('releases.projects')->get();

            $project = [];
        foreach ($requirements as $r) {
            if ($r->releases) {
                if ($r->releases->projects) {
                    if ($r->releases->projects->team_id = $team->id) {
                        $project[] = $r->requirement_uuid;
                    }
                }
            }
        }
        foreach ($projects as $p) {
            $project[] = $p->id;
        }

            Assignee::where('userid', $member)->wherein('uuid', $project)->delete();
            return redirect()->route('team.show', $team->slug);
    }

    public function changeblockingMember(Request $request, $team, $member)
    {

        $teammember = UserTeam::where('team_id', $team->id)->where('user_id', $member)->first();
        $teammember->toggleBlock();
        $teammember->save();


        return redirect()->route('team.show', $team->slug);
    }
}
