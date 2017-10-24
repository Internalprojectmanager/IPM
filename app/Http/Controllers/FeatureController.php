<?php

namespace App\Http\Controllers;

use App\Project;
use App\Release;
use Illuminate\Http\Request;
use App\Feature;
use Illuminate\Support\Facades\Auth;

class FeatureController extends Controller
{
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

    public function update($id, Request $request){
        $feature = Feature::where('id', $id)->first();

        $feature->status = $request->status;
        $feature->name = $request->name;
        $feature->description = $request->description;
        $feature->release_id = $request->$request->release_id;

        $feature->save();

        return redirect(route('releaseDetails', $request->release_id));
    }
}
