<?php

namespace App\Http\Controllers;

use App\Feature;
use App\Http\Requests\ReleaseValidator;
use App\Requirement;
use App\Status;
use Illuminate\Support\Facades\Auth;
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
        $status = Status::where('type', 'Progress')->get();
        $companys = Client::where('id', $company_id)->first();


        return view('release.add_release', compact('projects', 'companys', 'status'));
    }

    public function storeRelease(ReleaseValidator $request)
    {
        $project = Project::where('id', $request->project_id)->first();
        $releasecount = Release::where([['project_id', $request->project_id]])->count();
        $release = new Release();
        if($releasecount >= 0){
            $releasecount++;
        }

        $release->release_uuid = Uuid::generate(4);
        $release->project_id = $request->project_id;
        $release->name = $request->release_name;
        $release->description = $request->description;
        $release->status = $request->status;
        $release->document_status = $request->document_status;
        $release->version = $releasecount;
        $release->author = Auth::id();
        $release->deadline = $request->deadline;
        $release->specificationtype = $request->specification;

        $release->save();
        return redirect()->route('projectdetails',['name' => $project->name, 'company_id ' => $project->company_id]);
    }

    public function showRelease($company_id,$name,$release_name, $version){
        $project = Project::where(['name' => $name, 'company_id' => $company_id])->first();
        $company = Client::where('id' ,$company_id)->first();
        $release = Release::where([['project_id', $project->id],['name', $release_name],['version', $version]])->first();

        if(!$release){
            abort(404);
        }
        $status_string = array('"Open"', '"In Progress"', '"Testing"', '"Closed"');
        $status = array('Open', 'In Progress', 'Testing', 'Closed');
        $ids_ordered = implode(",", $status_string);
        $features = Feature::where([['release_id', $release->release_uuid]])->whereIn('status', $status)->orderByRaw(DB::raw("FIELD(status, $ids_ordered)"))->get();
        $requirements = Requirement::where('release_id', $release->release_uuid)->get();

        return view('release.details_release', compact('release', 'project', 'features', 'company', 'requirements'));
    }
}