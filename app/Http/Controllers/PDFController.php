<?php

namespace App\Http\Controllers;

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

        $project = Project::where(['name' => $name, 'company_id' => $company_id])->first();
        $company = Client::where('id' ,$company_id)->first();
        $release = Release::where([['project_id', $project->id],['name', $release_name],['version', $version]])->first();

        if(!$release){
            abort(404);
        }
        $status_string = array('"Open"', '"In Progress"', '"Testing"', '"Closed"');
        $status = array('Open', 'In Progress', 'Testing', 'Closed');
        $ids_ordered = implode(",", $status_string);
        $features = Feature::with('requirements')->where([['release_id', $release->release_uuid]])->whereIn('status', $status)->orderByRaw(DB::raw("FIELD(status, $ids_ordered)"))->get();

        $pdf = PDF::loadView('release.pdf', compact('release', 'project', 'features', 'company', 'requirements'));
        return $pdf->stream('Release.pdf');
    }
}