<?php

namespace App\Http\Controllers;

use App\Assignee;
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
        $releaseuuid = $release->release_uuid;

        if(!$release){
            abort(404);
        }
        $features = Feature::with('requirements.assignees.users')->where([['release_id', $releaseuuid],[ 'type', 'Feature']])->get();
        $nfr = Feature::with('requirements.rstatus')->where([['release_id', $release->release_uuid],[ 'type', 'NFR']])->get();
        $techspecs = Feature::with('requirements.rstatus')->where([['release_id', $release->release_uuid],[ 'type', 'TS']])->get();
        $scope = Feature::with('requirements.rstatus')->where([['release_id', $release->release_uuid],[ 'type', 'Scope']])->get();
        return view('release.details_release', compact('release', 'project', 'features', 'company', 'nfr', 'scope', 'techspecs', 'featurecount'));
    }

    public function  editRelease($company_id, $name, $release_name, $version){
        $project = Project::where(['name' => $name, 'company_id' => $company_id])->first();
        $company = Client::where('id' ,$company_id)->first();
        $release = Release::where([['project_id', $project->id],['name', $release_name],['version', $version]])->first();
        $status = Status::where('type', 'Progress')->get();

        return view('release.edit_release', compact('project', 'company', 'release', 'status'));
    }

    public function updateRelease($company_id, $name, $release_name, $version, Request $request){
        $release = Release::where(['name' => $release_name, 'version' => $version])->first();
        $company = Client::where('id', $company_id)->first();
        $project = Project::where('name', $name)->first();

        $status_string = array('"Open"', '"In Progress"', '"Testing"', '"Closed"');
        $status = array('Open', 'In Progress', 'Testing', 'Closed');
        $ids_ordered = implode(",", $status_string);
        $features = Feature::where([['release_id', $release->release_uuid]])->whereIn('status', $status)->orderByRaw(DB::raw("FIELD(status, $ids_ordered)"))->get();

        $release->name = $request->release_name;
        $release->description = $request->release_description;
        $release->version = $request->release_version;
        $release->status = $request->release_status;
        $release->extra_content = $request->extra_content;

        $release->save();

        return view('release.details_release', compact('release', 'company', 'project', 'features'));
    }
}