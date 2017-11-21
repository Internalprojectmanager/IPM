<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Client;
use App\Project;
use App\Release;
use App\Feature;
use App\Requirement;

class RequirementController extends Controller
{
   //add  Requirement
    public function addRequirement($company_id, $name, $release_name)
    {

        $project = Project::where(['name' => $name, 'company_id' => $company_id])->first();
        $release = Release::where(['project_id' => $project->id, 'name' => $release_name])->first();
        return view('requirement.add_requirement' , compact('release', 'project'));
    }

    public function storeRequirement($release_id, $feature_id, $company_id, $name, Request $request){
        $project = Project::where(['name' => $name, 'company_id' => $company_id ])->first();
        $release = Release::where(['project_id' => $project->id, 'name' => $release_id])->first();
        foreach($request-> requirement_name as $r => $value){

            if ($request->requirement_name[$r] !== NULL){

                $requirement = new Requirement();
                $requirement-> feature_id =$request ->feature_id;
                $requirement-> release_id =$request -> release_id;
                $requirement-> name = $request->requirement_name;
                $requirement-> description = $request -> requirement_description;
                $requirement-> status = $request -> requirement_status;
                $requirement-> author = $request -> requirement_author;
                $requirement->save();
            }
        }
        return redirect(route('showrelease', ['name' => $project->name, 'company_id' => $project->company_id,
            'release_name' => $release->name, 'version' => $release->version]));
    }

   public function overviewRequirement()
    {
        $requirements = Requirement::all();
        return view('requirement.requirement', compact('requirements'));
    }

    public function detailsRequirement($requirement_name)
    {
       $requirements = Requirement::where('name', $requirement_name)->first();
       return view('requirement.details_requirement' , compact('requirements'));
    }

    public function editRequirement($requirement_name)
    {
        $requirements = Requirement::where('name', $requirement_name)->first();
        return view('requirement.edit_requirement', compact($requirements));
    }

    public function updateRequirement ($requirement_name, Request $request)
    {
        $request->validate(['requirement_name' => 'required']);

        $requirement = Requirement::all()->where('name', $requirement_name)->first();
        $requirement->id = strtoupper(substr($request->requirement_name,  0,  5));
        $requirement-> feature_id =$request ->feature_id;
        $requirement-> release_id =$request -> release_id;
        $requirement-> name = $request->requirement_name;
        $requirement-> description = $request -> requirement_description;
        $requirement-> status = $request -> requirement_status;
        $requirement-> author = $request -> requirement_author;

        $requirement->save();

        return redirect()->route('overviewRequirement');


    }

    public function deleteRequirement($requirement_name)
{

}

}

