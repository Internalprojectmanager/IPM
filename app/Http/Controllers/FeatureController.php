<?php

namespace App\Http\Controllers;

use App\FeatureRevision;
use App\Http\Requests\FeatureRequest;
use App\Project;
use App\Release;
use Illuminate\Http\Request;
use App\Feature;
use Illuminate\Support\Facades\Auth;
use Webpatser\Uuid\Uuid;

class FeatureController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    function createRevision($feature)
    {
        $feature_revision = new FeatureRevision();
        $feature_revision->feature_id = $feature->feature_uuid;
        $feature_revision->release_id = $feature->release_id;
        $feature_revision->name = $feature->name;
        $feature_revision->description = $feature->description;
        $feature_revision->status = $feature->status;
        $feature_revision->deadline = $feature->deadline;
        $feature_revision->creator_id = $feature->author;
        $feature_revision->original_created_at = $feature->created_at;
        $saved = $feature_revision->save();

        if (!$saved) {
            App:
            abort('500', 'Error');
        }
        return true;
    }


    public function add($company_id, $name, $release_name)
    {
        $project = Project::where(['name' => $name, 'company_id' => $company_id])->first();
        $release = Release::where(['project_id' => $project->id, 'name' => $release_name])->first();


        return view('features.add_feature', compact('release', 'project'));
    }

    public function store($company_id, $name, $release_name, Request $request)
    {
        $project = Project::where(['name' => $name, 'company_id' => $company_id])->first();
        $release = Release::where(['project_id' => $project->id, 'name' => $release_name])->first();
        foreach ($request->feature_name as $k => $value) {

            if ($request->feature_name[$k] !== NULL) {
                $feature = new Feature();
                $feature->release_id = $release->release_uuid;
                $feature->feature_uuid = Uuid::generate(4);
                $feature->name = $request->feature_name[$k];
                $feature->author = Auth::user()->first_name . ' ' . Auth::user()->last_name;
                $feature->description = $request->description[$k];
                $feature->status = "Open";
                $feature->save();
            }
        }
        return redirect(route('showrelease', ['name' => $project->name, 'company_id' => $project->company_id,
            'release_name' => $release->name, 'version' => $release->version]));
    }

    public function editFeature($company_id, $name, $release_name, $feature_id)
    {
        $feature = Feature::with('releases.projects.company')->where('id', $feature_id)->first();
        $revisions = FeatureRevision::where('feature_id', $feature->feature_uuid)->orderby('created_at', 'desc')->get();
        return view('features.edit_feature', compact('feature', 'name', 'release_name', 'company_id', 'revisions'));
    }

    public function updateFeature($company_id, $name, $release_name, $feature_id, FeatureRequest $request)
    {
        $feature = Feature::where('id', $feature_id)->first();

        if ($request) {
            $this->createRevision($feature);

            $feature->status = $request->status;

            if (empty($feature->feature_uuid) || $feature->feature_uuid == "") {
                $feature->feature_uuid = Uuid::generate(4);
            }
            $feature->author = Auth::user()->first_name . ' ' . Auth::user()->last_name;
            $feature->name = $request->feature_title;
            $feature->description = $request->description;

            $feature->save();

            return redirect(route('showrelease', ['name' => $feature->releases->projects->name,
                'company_id' => $feature->releases->projects->company_id, 'release_name' => $feature->releases->name,
                'version' => $feature->releases->version]));
        }
    }

}
