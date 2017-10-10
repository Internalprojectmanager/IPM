<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Feature;

class FeatureController extends Controller
{
    public function store(Request $request){
        $feature = new Feature();

        $feature->id = $request->id;
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
