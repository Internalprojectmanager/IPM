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
    public function createPDF($company_id,$name,$release_name, $version){
        $company = Client::where('path' ,$company_id)->first();
        $project = Project::with(['assignee.users.jobtitles','assignee' => function ($q){
            $q->orderby('userid');
        }])->where(['path' => $name, 'company_id' => $company->id])->first();

        $release = Release::where([['project_id', $project->id],['name', $release_name],['version', $version]])->first();
        $release_id = $release->release_uuid;
        if(!$release){
            abort(404);
        }
        $features = Feature::with('requirements.rstatus')->where([['release_id', $release->release_uuid], ['type', 'Feature']])->get();
        $pdf = PDF::loadView('release.pdf', compact('release', 'project', 'features', 'company', 'requirements', 'assignees'));
        return $pdf->stream('Release.pdf');
    }
}