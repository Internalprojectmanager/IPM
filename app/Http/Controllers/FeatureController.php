<?php

namespace App\Http\Controllers;

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


    public function add($company_id, $name, $release_name){
        $project = Project::where(['name' => $name, 'company_id' => $company_id])->first();
        $release = Release::where(['project_id' => $project->id, 'name' => $release_name])->first();


        return view('features.add_feature', compact('release', 'project'));
    }

    public function store($company_id, $name, $release_name, Request $request){
        $project = Project::where(['name' => $name, 'company_id' => $company_id])->first();
        $release = Release::where(['project_id' => $project->id, 'name' => $release_name])->first();
        foreach($request->feature_name as $k => $value){

            if($request->feature_name[$k] !== NULL){
                $feature = new Feature();
                $feature->release_id = $request->release_id[$k];
                $feature->feature_uuid = Uuid::generate(4);
                $feature->name = $request->feature_name[$k];
                $feature->author = Auth::user()->first_name.' '.Auth::user()->last_name;
                $feature->description = $request->description[$k];
                $feature->status = "Open";
                $feature->save();
            }
        }
        return redirect(route('showrelease', ['name' => $project->name, 'company_id' => $project->company_id,
            'release_name' => $release->name, 'version' => $release->version]));
    }

    public function editFeature($company_id, $name, $release_name, $feature_id){
        $feature = Feature::with('releases.projects.company')->where('id', $feature_id)->first();
        $revisions = Feature::where([['feature_uuid', $feature->feature_uuid], ['revision_log', '!=', NULL]])->orderby('revision_log', 'desc')->get();
        return view('features.edit_feature', compact( 'feature','name', 'release_name', 'company_id', 'revisions'));
    }

    public function updateFeature($company_id, $name, $release_name, $feature_id, Request $request){
        $feature = Feature::where('id', $feature_id)->first();

        $features = new Feature();
        $features->status = $request->status;

        if(!empty($feature->feature_uuid) && $feature->feature_uuid !== ""){
            $features->feature_uuid = $feature->feature_uuid;

        }else{
            $features->feature_uuid = Uuid::generate(4);
        }
        $features->release_id = $feature->release_id;
        $features->author = Auth::user()->first_name.' '.Auth::user()->last_name;
        $features->name = $request->feature_title;
        $features->description = $request->description;

        $feature->revision_log = date("Y-m-d H:i:s");
        $feature->save();
        $features->save();

        return redirect(route('showrelease', ['name' => $feature->releases->projects->name,
            'company_id' => $feature->releases->projects->company_id, 'release_name' => $feature->releases->name,
            'version' => $feature->releases->version]));
    }
}
