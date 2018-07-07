<?php

namespace App\Http\Controllers\Admin;

use App\Project;
use App\Team;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\User;


class UserController extends Controller
{

    public function index()
    {
        $users = User::orderBy('last_name', 'asc')->get();

        return view('admin.users.index', compact('users'));
    }

    public function dashboard()
    {
        $users = User::orderBy('created_at', 'desc')->get();
        $projects = Project::orderBy('created_at', 'desc')->get();
        $teams = Team::with('project', 'client')->orderBy('id', 'desc')->get();

        return view('admin.index', compact('users', 'projects', 'teams'));
    }
}
