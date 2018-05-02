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
                $teammember->team_id = $team;
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
}
