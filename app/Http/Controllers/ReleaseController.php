<?php

namespace App\Http\Controllers;

use App\Feature;
use App\Http\Requests\ReleaseValidator;
use App\Requirement;
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

    public function storeRelease(ReleaseValidator $request)
    {
        $release_name = strtoupper(substr($request->release_name,0 ,5));
        $project_name = strtoupper(substr($request->project,0 ,5));
        $company_id = strtoupper(substr($request->company_id,0 ,5));
        $releasecount = Release::where('id', 'like', $project_name.$release_name.'%')->count();
        $version = Release::where('id', 'like', $project_name.$release_name.'%')->orderBy('version', 'desc')->first();
        $release = new Release();
        $versioncount = $releasecount;
        if($releasecount >= 0){
            $releasecount++;
        }

        $release->id = strtoupper(substr($request->project,0 ,5)).$release_name.$releasecount;
        $release->project_id = strtoupper(substr($request->company_id,0 ,5)).strtoupper(substr($request->project,0 ,5));
        $release->name = $request->release_name;
        $release->description = $request->description;

        if(isset($version->version)){
            if($version->version >= $request->version) {
                $release->version = $version->version + 0.01;
            }
        }else{
            $release->version = $request->version;
        }
        $release->author = $request->author;
        $release->specificationtype = $request->specification;

        $release->save();
        return redirect()->route('projectdetails',['name' => $request->project, 'company_id ' => $company_id]);
    }

    public function showRelease($company_id,$name,$release_name, $version){
        $name = strtoupper(substr($name,0 ,5));
        $company_id = strtoupper(substr($company_id,0 ,5));


        $project = Project::where(['id' => $company_id.$name, 'company_id' => $company_id])->first();
        $company = Company::where('id' ,$company_id)->first();
        $release = Release::where([['project_id', $company_id.$name],['name', $release_name],['version', $version]])->first();

        $features = Feature::where('release_id', $release->id)->get();
        $requirements = Requirement::where('release_id', $release->id)->get();

        return view('release.details_release', compact('release', 'project', 'features', 'company', 'requirements'));
    }
}