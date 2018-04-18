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

class PDFController extends Controller
{
    public function createPDF($client,$project,$release, $version){
        $project = Project::with(['assignee.users.jobtitles','assignee' => function ($q){
            $q->orderby('userid');
        }])->path($project->path)->where('company_id' , $client->id)->firstorfail();

        $features = Feature::with('requirements.rstatus')->where([['release_id', $release->release_uuid], ['type', 'Feature']])->get();
        $pdf = PDF::setOptions(['images' => true])->loadView('release.pdf', compact('release', 'project', 'features', 'company', 'requirements', 'assignees'))->setPaper('a4', 'portrait');

        return $pdf->stream('Release.pdf');
    }
}