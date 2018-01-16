<?php

namespace App\Http\Controllers;

use App\Assignee;
use App\Requirement;
use App\FeatureRevision;
use App\Http\Requests\FeatureRequest;
use App\Project;
use App\Release;
use Illuminate\Http\Request;
use App\Feature;
use App\Status;
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
            App:abort('500', 'Error');
        }
        return true;
    }

    public function showfeature($company_id, $name, $release_name, $feature_id){
        $feature = Feature::with('requirements.assignees.users', 'releases.projects', 'fstatus')->where('id', $feature_id)->first();
        $featureid = $feature->feature_uuid;
        $requirementcount = Status::withCount(['requirements' => function ($q) use ($featureid){
            $q->where('feature_uuid', '=', $featureid);
        }])->where('name', 'Completed')->first();
        $requirementcount = $requirementcount->requirements_count;
        return view('features.details_feature', compact('feature', 'requirementcount'));
    }



    public function add($company_id, $name, $release_name)
    {
        $project = Project::where(['name' => $name, 'company_id' => $company_id])->first();
        $release = Release::where(['project_id' => $project->id, 'name' => $release_name])->first();


        return view('features.add_feature', compact('release', 'project'));
    }

    public function store($company_id, $name, $release_name, Request $request)
    {
        //dd($request);
        $project = Project::where(['name' => $name, 'company_id' => $company_id])->first();
        $release = Release::where(['project_id' => $project->id, 'name' => $release_name])->first();
        $status = Status::where('name', 'draft')->first();
        $feature = new Feature();
        $feature->feature_uuid = Uuid::generate(4);
        $feature->name = $request->feature_name;
        $feature->release_id = $release->release_uuid;
        $feature->description = $request->feature_description;
        $feature->type = $request->type;
        $feature->author = Auth::id();
        $feature->status = $status->id;
        $feature->save();

        foreach ($request->requirement_name as $k => $value) {
            if ($request->requirement_name[$k] !== NULL) {
                $requirement = new Requirement;
                $requirement->feature_uuid = $feature->feature_uuid;
                $requirement->release_id = $release->release_uuid;
                $requirement->name = $request->requirement_name[$k];
                $requirement->requirement_uuid = Uuid::generate(4);
                if(!empty($request->requirement_description[$k])){
                    $requirement->description = $request->requirement_description[$k];
                }
                $requirement->status = $status->id;
                $requirement->author = Auth::id();
                $requirement->save();
                foreach ($request->assignee[$k] as $as){
                    $assignee = new Assignee();
                    $assignee->userid = $as;
                    $assignee->uuid = $requirement->requirement_uuid;
                    $assignee->save();
                }
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
