<?php

namespace App\Http\Controllers;

use App\Assignee;
use App\Requirement;
use App\FeatureRevision;
use App\Http\Requests\FeatureRequest;
use App\Project;
use App\Release;
use App\User;
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
        $status = Status::where('type', "Progress")->get();
        $user = Assignee::where('uuid', $feature->releases->projects->id)->select('userid')->distinct()->get();
        return view('features.details_feature', compact('feature', 'requirementcount', 'status', 'user'));
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
        $status = Status::where('name', 'draft')->first();
        $feature = new Feature();
        $feature->feature_uuid = Uuid::generate(4);
        $feature->name = $request->feature_name;
        $feature->release_id = $release->release_uuid;
        $feature->description = $request->feature_description;
        if(!empty($request->category)){
            $feature->category = $request->category;
        }
        $feature->type = $request->type;
        $feature->author = Auth::id();
        if($request->type == "Scope"){
            $feature->status = Status::where('name', 'Paused')->first()->id;
        }else{
            $feature->status = $request->feature_status;
        }
        if(!empty($request->feature_category)){
            $feature->category = $request->feature_category;
        }
        $feature->save();

        if(!empty($request->requirement_name)){
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
                    if(!empty($request->assignee[$k])){
                        foreach ($request->assignee[$k] as $as){
                            $assignee = new Assignee();
                            $assignee->userid = $as;
                            $assignee->uuid = $requirement->requirement_uuid;
                            $assignee->save();
                        }
                    }

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
            $feature->name = $request->feature_name;
            $feature->description = $request->feature_description;
            if(!empty($request->category)){
                $feature->category = $request->category;
            }
            $feature->type = $request->type;
            $feature->author = Auth::id();
            if($request->type == "Scope"){
                $feature->status = Status::where('name', 'Paused')->first()->id;
            }else{
                $feature->status = $request->feature_status;
            }
            if(!empty($request->feature_category)){
                $feature->category = $request->feature_category;
            }
            $feature->save();

            $status = Status::where('name', 'draft')->select('id')->first();
            $requirement = Requirement::where('feature_uuid', $feature->feature_uuid)->get();
            foreach ($requirement as $r){
                if(!in_array($r->requirement_uuid, $request->requirement_uuid)){
                    Requirement::where('id', $r->id)->delete();
                }
            }

            foreach($request->requirement_name as $k => $v){
                if(!empty($request->requirement_uuid[$k])){
                    $requirement = Requirement::where('requirement_uuid', $request->requirement_uuid[$k])->first();
                    $requirement->name = $request->requirement_name[$k];
                    $requirement->description = $request->requirement_description[$k];
                    $requirement->author = Auth::id();
                    //dd($requirement);
                    $requirement->save();
                    if(!empty($request->assignee[$k])){
                        $assignee = Assignee::where('uuid', $requirement->requirement_uuid)->get();
                        $assigneeusers  = array();
                        foreach ($assignee as $a){
                            if(!in_array($a->userid, $request->assignee[$k])){
                                Assignee::where([['uuid', $requirement->requirement_uuid],['userid', $a->userid]])->delete();
                            }else{
                                $assigneeusers[] = $a->userid;
                            }
                        }

                        foreach ($request->assignee[$k] as $a){
                            if(!in_array($a, $assigneeusers)){
                                $assignee = new Assignee();
                                $assignee->userid = $a;
                                $assignee->uuid = $requirement->requirement_uuid;
                                $assignee->save();
                            }
                        }
                    }else{
                        Assignee::where('uuid', $requirement->requirement_uuid)->delete();
                    }

                }else{
                    if ($request->requirement_name[$k] !== NULL) {
                        $requirement = new Requirement;
                        $requirement->feature_uuid = $feature->feature_uuid;
                        $requirement->release_id = $feature->release_id;
                        $requirement->name = $request->requirement_name[$k];
                        $requirement->requirement_uuid = Uuid::generate(4);
                        if(!empty($request->requirement_description[$k])){
                            $requirement->description = $request->requirement_description[$k];
                        }
                        $requirement->status = $status->id;
                        $requirement->author = Auth::id();
                        $requirement->save();
                        if(!empty($request->assignee[$k])){
                            foreach ($request->assignee[$k] as $as){
                                $assignee = new Assignee();
                                $assignee->userid = $as;
                                $assignee->uuid = $requirement->requirement_uuid;
                                $assignee->save();
                            }
                        }

                    }
                }
            }


            return redirect(route('showrelease', ['name' => $feature->releases->projects->name,
                'company_id' => $feature->releases->projects->company_id, 'release_name' => $feature->releases->name,
                'version' => $feature->releases->version]));
        }
    }

}
