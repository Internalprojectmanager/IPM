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

class ReleaseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function addRelease($company_id,$name)
    {
        $projects = Project::where(['name' => $name, 'company_id' => $company_id])->first();
        $companys = Client::where('id', $company_id)->first();


        return view('release.add_release', compact('projects', 'companys'));
    }

    public function storeRelease(ReleaseValidator $request)
    {
        $project_name = strtoupper(substr($request->project,0 ,5));
        $company_id = strtoupper(substr($request->company_id,0 ,5));
        $releasecount = Release::where([['project_id', $company_id.''.$project_name]])->count();
        $release_name = Release::select('name')->where([['project_id', $company_id.''.$project_name], ['version', 1]])->first();
        $release = new Release();
        if($releasecount >= 0){
            $releasecount++;
        }

        $release->release_uuid = Uuid::generate(4);
        $release->project_id = strtoupper(substr($request->company_id,0 ,5)).strtoupper(substr($request->project,0 ,5));
        $release->name = $request->release_name;
        $release->description = $request->description;
        $release->version = $releasecount;
        $release->author = $request->author;
        $release->specificationtype = $request->specification;

        $release->save();
        return redirect()->route('projectdetails',['name' => $request->project, 'company_id ' => $company_id]);
    }

    public function showRelease($company_id,$name,$release_name, $version){
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

        return view('release.details_release', compact('release', 'project', 'features', 'company', 'requirements', 'testreport'));
    }
}