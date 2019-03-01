<?php

namespace App\Http\Controllers;

use App\Assignee;
use App\Status;
use App\User;
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
use Ramsey\Uuid\Uuid;

class RequirementController extends Controller
{
    //add  Requirement
    public function addRequirement($company_id, $name, $release_name)
    {
        $project = Project::where(['name' => $name, 'company_id' => $company_id])->first();
        $release = Release::where(['project_id' => $project->id, 'name' => $release_name])->first();
        return view('requirement.add_requirement', compact('release', 'project'));
    }

    public function storeRequirement(Request $request, $project, $release, $feature)
    {
        $client = $project->company;
        $requirement = new Requirement();
        $requirement->requirement_uuid = \Webpatser\Uuid\Uuid::generate(4);
        $requirement->feature_uuid = $feature->feature_uuid;
        $requirement->release_id = $release->release_uuid;
        $requirement->name = $request->requirement_name;
        $requirement->description = $request->requirement_description;
        $requirement->author = \Auth::id();
        $requirement->status = Status::name('draft')->id;
        $requirement->save();

        if (isset($request->assignee)) {
            foreach ($request->assignee as $a) {
                $assignee = new Assignee();
                $assignee->userid = $a;
                $assignee->uuid = $requirement->requirement_uuid;
                $assignee->status = Status::name('Draft')->id;
                $assignee->save();
            }
        }


        $project = $project->path;
        $release = $release->path;
        return redirect()->route('showfeature', compact('client', 'project', 'release', 'feature'));
    }

    public function saveStatus(Request $request, $client, $project, $release, $feature)
    {

        foreach ($request->data as $key => $value) {
            if (\Auth::id() == $value['assignee']) {
                $assignee = Assignee::where('userid', $value['assignee'])->where('uuid', $value['uuid'])->first();
                $assignee->status = $value['status'];
                $assignee->save();
            }
        }

        $requirements = Requirement::with('features.releases.projects', 'assignees')->where('feature_uuid', $feature->feature_uuid)->get();

        foreach ($requirements as $r) {
            Requirement::updateStatus($r);
        }

        $completed = Requirement::where('feature_uuid', $feature->feature_uuid)->where('status', Status::name('Completed')->id)->count();

        Feature::updateStatus($feature);
        Release::updateStatus($release);
        Project::updateStatus($project);
        $feature = Feature::with('requirements.assignees.users', 'releases.projects', 'fstatus')->where('id', $feature->id)->first();
        $requirementcount = $completed;
        $status = Status::type('Progress')->get();

        return view('requirement.requirement_table', compact('client', 'project', 'release', 'feature', 'requirementcount', 'status'));
    }

    public function saveAuthStatus(Request $request)
    {
        foreach ($request->data as $key => $value) {
            $assignee = Assignee::where('userid', $value['assignee'])->where('uuid', $value['uuid'])->first();
            $assignee->status = $value['status'];
            $assignee->save();
            $requirement = Requirement::with('features.releases.projects')->where('requirement_uuid', $value['uuid'])->first();
            Requirement::updateStatus($requirement);
            Feature::updateStatus($requirement->features);
            Release::updateStatus($requirement->features->releases);
            Project::updateStatus($requirement->features->releases->projects);
        }

        return app('App\Http\Controllers\HomeController')->dashboard($request);
    }


    public function overviewRequirement()
    {
        $requirements = Requirement::all();
    }

    public function detailsRequirement($requirement)
    {
        return view('requirement.details_requirement', compact('requirement'));
    }

    public function editRequirement($project, $release, $feature, $requirement)
    {
        $client = $project->company;
        $user = Assignee::where('uuid', $project->id)->select('userid')->distinct()->get();
        $users = User::all();
        return view('requirement.edit_requirement', compact('client', 'project', 'release', 'feature', 'requirement', 'users', 'user'));
    }

    public function updateRequirement($project, $release, $feature, $requirement, Request $request)
    {
        $client = $project->company;
        $requirement->name = $request->requirement_name;
        $requirement->description = $request->requirement_description;
        $requirement->author = \Auth::id();
        $requirement->save();


        if (!empty($request->assignee)) {
            $assignee = Assignee::where('uuid', $requirement->requirement_uuid)->get();
            $assigneeusers = array();
            foreach ($assignee as $a) {
                if (!in_array($a->userid, $request->assignee)) {
                    Assignee::where([['uuid', $requirement->requirement_uuid], ['userid', $a->userid]])->delete();
                } else {
                    $assigneeusers[] = $a->userid;
                }
            }

            foreach ($request->assignee as $a) {
                if (!in_array($a, $assigneeusers)) {
                    $assignee = new Assignee();
                    $assignee->userid = $a;
                    $assignee->uuid = $requirement->requirement_uuid;
                    $assignee->status = Status::name('Draft')->id;
                    $assignee->save();
                }
            }
        } else {
            Assignee::where('uuid', $requirement->requirement_uuid)->delete();
        }

        $project = $project->path;
        $release = $release->path;
        return redirect()->route('showfeature', compact('client', 'project', 'release', 'feature'));
    }

    public function deleteRequirement($requirement_name)
    {
    }
}
