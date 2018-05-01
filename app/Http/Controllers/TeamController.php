<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Team;
use App\User;

class TeamController extends Controller
{
    public function show($team){
        $team = Team::name($team);

        $users = User::all();

        dd($team);

        return view('team.show_team', compact('team', 'users'));
    }
}
