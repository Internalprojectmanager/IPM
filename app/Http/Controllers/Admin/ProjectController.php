<?php

namespace App\Http\Controllers\Admin;

use App\Feature;
use App\Http\Controllers\HomeController;
use App\Plan;
use App\Project;
use App\Release;
use App\Requirement;
use App\Team;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\User;

class ProjectController extends Controller
{

    public function index()
    {
        if (Auth::id() == 1) {
            $projects = Project::orderBy('name', 'asc')->get();

            return view('admin.projects.index', compact('projects'));
        }
        abort(404);
    }

}
