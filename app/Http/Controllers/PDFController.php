<?php

namespace App\Http\Controllers;

use App\Feature;
use App\Http\Requests\ReleaseValidator;
use App\Requirement;
use App\TestReport;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Client;
use App\Project;
use App\Release;
use DB;
use Webpatser\Uuid\Uuid;
use PDF;

class PDFController extends Controller
{
    public function createPDF($company_id,$name,$release_name, $version){
        $name = strtoupper(substr($name,0 ,5));
        $company_id = strtoupper(substr($company_id,0 ,5));


        $project = Project::where(['id' => $company_id.$name, 'company_id' => $company_id])->first();
        $company = Client::where('id' ,$company_id)->first();
        $release = Release::where([['project_id', $company_id.$name],['name', $release_name],['version', $version]])->first();

        if(!$release){
            abort(404);
        }
        $status_string = array('"Open"', '"In Progress"', '"Testing"', '"Closed"');
        $status = array('Open', 'In Progress', 'Testing', 'Closed');
        $ids_ordered = implode(",", $status_string);
        $testreport = TestReport::where('release_id', $release->release_id)->get();
        $features = Feature::where([['release_id', $release->release_uuid]])->whereIn('status', $status)->orderByRaw(DB::raw("FIELD(status, $ids_ordered)"))->get();
        $requirements = Requirement::where('release_id', $release->release_uuid)->get();

        $pdf = PDF::loadView('release.pdf', compact('release', 'project', 'features', 'company', 'requirements', 'testreport'));
        return $pdf->stream('Release.pdf');
    }
}