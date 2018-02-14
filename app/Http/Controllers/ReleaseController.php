<?php

namespace App\Http\Controllers;

use App\Assignee;
use App\Feature;
use App\Http\Requests\ReleaseValidator;
use App\Requirement;
use App\Status;
use App\User;
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
        $companys = Client::where('id', $company_id)->first();
        $projects = Project::where(['name' => $name, 'company_id' => $companys->id])->first();
        $status = Status::where('type', 'Progress')->get();
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
        $release->path = strtolower(str_replace(" ","-", $release->name));
        $release->description = $request->description;
        $release->status = $request->status;
        $release->document_status = $request->document_status;
        $release->version = $releasecount;
        $release->author = Auth::id();
        $release->deadline = $request->deadline;
        $release->specificationtype = $request->specification;
        $release->save();
        return redirect()->route('projectdetails',['name' => $project->path, 'company_id ' => $project->company->path]);
    }

    public function showRelease($company_id,$name,$release_name, $version){
        $company = Client::where('path' ,$company_id)->first();
        $project = Project::where(['path' => $name, 'company_id' => $company->id])->first();
        $release = Release::where([['project_id', $project->id],['path', $release_name],['version', $version]])->first();
        $releaseuuid = $release->release_uuid;
        $user = Assignee::where('uuid', $project->id)->get();

        if(!$release){
            abort(404);
        }
        $features = Feature::with('requirements.assignees.users')->where([['release_id', $releaseuuid],[ 'type', 'Feature']])->get();
        $nfr = Feature::with('requirements.rstatus')->where([['release_id', $release->release_uuid],[ 'type', 'NFR']])->get();
        $techspecs = Feature::with('requirements.rstatus')->where([['release_id', $release->release_uuid],[ 'type', 'TS']])->get();
        $scope = Feature::with('requirements.rstatus')->where([['release_id', $release->release_uuid],[ 'type', 'Scope']])->get();

        $status = Status::where('type', 'Progress')->get();
        $category = Status::where('type', 'category')->get();
        return view('release.details_release', compact('release', 'project', 'features', 'company', 'nfr', 'scope', 'techspecs', 'featurecount', 'user', 'status', 'category'));
    }

    public function editRelease($company_id, $name, $release_name, $version){
        $company = Client::where('path' ,$company_id)->first();
        $project = Project::where(['path' => $name, 'company_id' => $company->id])->first();
        $release = Release::where([['project_id', $project->id],['path', $release_name],['version', $version]])->first();
        $status = Status::where('type', 'Progress')->get();
        return view('release.edit_release', compact('project', 'company', 'release', 'status'));
    }

    public function updateRelease($company_id, $name, $release_name, $version, Request $request){
        $company = Client::where('path', $company_id)->first();
        $project = Project::where('path', $name)->first();
        $release = Release::where(['path' => $release_name, 'version' => $version])->first();
        $status = Status::where('type', 'Progress')->get();

        $release->name = $request->release_name;
        $release->name = $request->release_name;
        $release->description = $request->release_description;
        $release->version = $request->release_version;
        $release->status = $request->release_status;
        $release->extra_content = $request->extra_content;

        $release->save();
        return redirect()->route('showrelease',['name' => $project->path, 'company_id ' => $project->company->path, 'release_name' => $release->path, 'version' => $release->version]);
    }
}