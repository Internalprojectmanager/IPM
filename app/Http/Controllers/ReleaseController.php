<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Company;
use App\Project;
use App\Release;

class ReleaseController extends Controller
{
    public function addRelease($company_id,$name)
    {
        $projects = Project::where(['name' => $name, 'company_id' => $company_id])->first();
        $companys = Company::where('id', $company_id)->first();


        return view('release.add_release', compact('projects', 'companys'));
    }

    public function storeRelease(Request $request)
    {
        $release_name = strtoupper(substr($request->release_name,0 ,5));
        $company_id = strtoupper(substr($request->company_id,0 ,5));
        $releasecount = Release::where('id', 'like', $release_name.'%')->count();
        $release_id = NULL;
        if($release_id == NULL && $releasecount == 0){
            $release_id = $release_name;
        }else{
            $release_id = $release_name.$releasecount;
        }
        $release_id = strtoupper(substr($release_id,0 ,6));

        $release = new Release();
        $release->id =$release_id;
        $release->project_id = strtoupper(substr($request->project,0 ,5));
        $release->name = $request->release_name;
        $release->description = $request->description;
        $release->version = $request->version;
        $release->author = $request->author;
        $release->specificationtype = $request->specification;

        $release->save();
        return redirect()->route('projectdetails',['name' => $request->project, 'company_id ' => $company_id]);
    }
}