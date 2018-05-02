<?php

namespace App\Http\Controllers;

use App\UserTeam;
use Illuminate\Http\Request;
use App\Team;
use App\User;

class TeamController extends Controller
{
    public function show($team){
        $team = Team::name($team);

        $users = User::all();

        return view('team.show_team', compact('team', 'users'));
    }

    public function storeMember(Request $request, $team){
        if($request->member > 0){
            foreach ($request->member as $member) {
                if (!UserTeam::where('user_id', $member)->where('team_id', $team)->first()) {
                $teammember = New UserTeam();
                $teammember->user_id = $member;
                $teammember->team_id = Team::name($team)->id;
                $teammember->roleid = 1;
                }

                if( User::find($member)->currentTeam() == null){
                    $teammember->current = true;
                } else{
                    $teammember->current = false;
                }
                $teammember->save();
            }
        }

        return redirect()->route('team.show', compact('team'));

    }


    public function deleteMember(Request $request, $team, $member){
            Team::name()->users()->detach($member);
            return redirect()->route('team.show', compact('team'));
    }

    public function changeblockingMember(Request $request, $team, $member){
        $teammember = UserTeam::teammember(Team::name($team)->id, $member);

        $teammember->toggleBlock();
        $teammember->save();

        return redirect()->route('team.show', compact('team'));
    }
}
