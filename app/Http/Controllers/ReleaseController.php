<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Company;
use App\Project;
use App\Release;

class ReleaseController extends Controller
{
    public function addRelease()
    {
        $projects = Project::all();

        return view('release.add_release', compact('projects'));
    }

    public function storeRelease(Request $request)
    {
        $release = new Release();
        $release->id =strtoupper(substr($request->release_name,0 ,5));
        $release->project_id = strtoupper(substr($request->project,0 ,5));
        $release->name = $request->release_name;
        $release->description = $request->description;
        $release->version = $request->version;
        $release->author = $request->author;
        $release->specificationtype = $request->specification;

        $release->save();

        return redirect()->route('projectdetails');
    }
}