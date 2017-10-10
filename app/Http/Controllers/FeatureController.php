<?php

namespace App\Http\Controllers;

use App\Project;
use App\Release;
use Illuminate\Http\Request;
use App\Feature;

class FeatureController extends Controller
{
    public function add($company_id, $name, $release_name){
        $project = Project::where(['name' => $name, 'company_id' => $company_id])->first();
        $release = Release::where(['project_id' => $project->id, 'name' => $release_name])->first();


        return view('features.add_feature', compact('release', 'project'));
    }

    public function store($company_id, $name, $release_name, Request $request){
        $feature = new Feature();

        $feature->id = $request->feature_id;
        $feature->release_id = $request->release_id;
        $feature->name = $request->name;
        $feature->description = $request->description;
        $feature->status = $request->status;

        $feature->save();

        return redirect(route('releaseDetails', $request->release_id));
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
