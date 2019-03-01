<?php

namespace App\Http\Controllers;

use App\Feature;
use App\Role;
use App\Project;
use DB;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Storage;

class PDFController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function createPDF($project, $release, $version)
    {
        $client = $project->company;
        $roles = Role::all();
        $project = $project::path($project->path)->with('assignee', 'company', 'team', 'assignee.users', 'assignee.role')->first();
        $features = Feature::with('requirements.rstatus')->where([['release_id', $release->release_uuid]])->orderByRaw(DB::raw("FIELD(type, 'Feature', 'NFR', 'TS', 'Scope')"))->get();
        //return view('release.pdf', compact('release', 'project', 'features', 'roles'));
        return $pdf = PDF::loadView(
            'release.pdf',
            compact('release', 'project', 'features', 'roles')
        )
            ->stream();
        //->save(public_path().'/storage/team/'. $project->team->slug.'/'. $release->path . '.pdf');

        //return response()->file(public_path().'/storage/team/'. $project->team->slug.'/'. $release->path . '.pdf');
    }
}
