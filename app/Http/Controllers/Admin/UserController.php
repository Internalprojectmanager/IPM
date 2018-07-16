<?php

namespace App\Http\Controllers\Admin;

use App\Feature;
use App\Plan;
use App\Project;
use App\Release;
use App\Requirement;
use App\Team;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\User;

class UserController extends Controller
{

    public function index()
    {
        if (Auth::id() == 1){
            $users = User::orderBy('last_name', 'asc')->get();

        return view('admin.users.index', compact('users'));
        }
        abort(404);
    }

    public function dashboard()
    {

        if(Auth::id() == 1){
        $users = User::orderBy('created_at', 'desc')->get();
        $projects = Project::orderBy('created_at', 'desc')->get();
        $teams = Team::with('project', 'client', 'owner')->orderBy('id', 'desc')->get();
        $plans = Plan::orderBy('id', 'desc')->get();
        $releases = Release::get()->count();
        $features = Feature::get()->count();
        $requirements = Requirement::get()->count();

        return view('admin.index',
            compact('users', 'projects', 'teams', 'plans', 'releases', 'features', 'requirements'));
        }
        abort(404);
    }

}
