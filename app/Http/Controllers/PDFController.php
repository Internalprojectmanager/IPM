<?php

namespace App\Http\Controllers;

use App\Assignee;
use App\Feature;
use App\Http\Requests\ReleaseValidator;
use App\Requirement;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Client;
use App\Project;
use App\Release;
use App\Requirements;
use DB;
use Webpatser\Uuid\Uuid;
use PDF;
use Illuminate\Support\Facades\Storage;
class PDFController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function createPDF($client,$project,$release, $version){
        $project = Project::with(['assignee.users.jobtitles','team','assignee' => function ($q){
            $q->orderby('userid');
        }])->path($project->path)->where('company_id' , $client->id)->firstorfail();


        $features = Feature::with('requirements.rstatus')->where([['release_id', $release->release_uuid]])->orderByRaw(DB::raw("FIELD(type, 'Feature', 'NFR', 'TS', 'Scope')"))->get();
        $pdf = PDF::setOptions(['images' => true])->loadView('release.pdf', compact('release', 'project', 'features', 'client', 'requirements', 'assignees', 'image'))->setPaper('a4', 'portrait');
        return $pdf->stream('Release.pdf');
    }
}