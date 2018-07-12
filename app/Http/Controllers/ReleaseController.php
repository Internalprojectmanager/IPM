<?php

namespace App\Http\Controllers;

use App\Assignee;
use App\Feature;
use App\Http\Requests\ReleaseValidator;
use App\Requirement;
use App\Status;
use App\User;
use Carbon\Carbon;
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

    public function addRelease($client, $project)
    {
        $status = Status::type('Progress')->get();
        return view('release.add_release', compact('project', 'client', 'status'));
    }

    public function storeRelease(ReleaseValidator $request)
    {
        $project = Project::where('id', $request->project_id)->first();
        $releasecount = Release::where([['project_id', $request->project_id]])->count();
        $release = new Release();
        if ($releasecount >= 0) {
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
        $release->deadline = Carbon::parse($request->deadline)->endOfDay();
        $release->specificationtype = $request->specification;
        $release->save();
        return redirect()->route('projectdetails', [$project->company->path, $project->path]);
    }

    public function showRelease($client, $project, $release, $version)
    {
        $release = Release::where([['project_id', $project->id],['path', $release->path],['version', $version]])->firstorfail();
        $user = Assignee::where('uuid', $project->id)->get();

        $features = Feature::with('requirements.assignees.users')->where([['release_id', $release->release_uuid],[ 'type', 'Feature']])->get();
        $nfr = Feature::with('requirements.rstatus')->where([['release_id', $release->release_uuid],[ 'type', 'NFR']])->get();
        $techspecs = Feature::with('requirements.rstatus')->where([['release_id', $release->release_uuid],[ 'type', 'TS']])->get();
        $scope = Feature::with('requirements.rstatus')->where([['release_id', $release->release_uuid],[ 'type', 'Scope']])->get();

        $status = Status::type('Progress')->get();
        $category = Status::type('category')->get();
        return view('release.details_release', compact('release', 'project', 'features', 'client', 'nfr', 'scope', 'techspecs', 'featurecount', 'user', 'status', 'category'));
    }

    public function editRelease($client, $project, $release, $version)
    {
        $release = Release::where([['project_id', $project->id],['path', $release->path],['version', $version]])->first();
        $status = Status::where('type', 'Progress')->get();
        return view('release.edit_release', compact('project', 'client', 'release', 'status'));
    }

    public function updateRelease($client, $project, $release, $version, ReleaseValidator $request)
    {

        $release = Release::where(['path' => $release->path, 'version' => $version])->first();

        $release->name = $request->release_name;
        $release->description = $request->description;
        $release->deadline = Carbon::parse($request->deadline)->endOfDay();
        $release->version = $request->version;
        $release->status = $request->status;
        $release->document_status = $request->document_status;
        $release->extra_content = $request->extra_content;
        $release->author = Auth::id();
        $release->specificationtype = $request->specification;
        $release->save();

        Project::updateDeadline($project);
        Project::updateStatus($project);

        return redirect()->route('showrelease', [$client->path, $project->path, $release->path,$release->version]);
    }

    public function deleteRelease($client, $project, $release, $version)
    {
        $release = Release::where([['project_id', $project->id],['path', $release->path],['version', $version]])->first();
        $release->delete();
        return redirect()->route('projectdetails', [$client->path, $project->path]);
    }
}
