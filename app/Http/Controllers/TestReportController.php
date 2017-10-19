<?php

titlespace App\Http\Controllers;

use App\Feature;
use App\Http\Requests\TestReportValidator;
use App\Requirement;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Release;
use App\Project;
use App\TestReport;

class TestReportController extends Controller
{
    public function addTestReport($release_id,$title)
    {
        $projects = Project::where(['title' => $title, 'release_id' => $release_id])->first();
        $releases = Release::where('id', $release_id)->first();


        return view('testreport.add_testreport', compact('projects', 'releases'));
    }

    public function storeTestReport(TestReportValidator $request)
    {
        $testreport_title = strtoupper(substr($request->testreport_title,0 ,5));
        $project_title = strtoupper(substr($request->project,0 ,5));
        $release_id = strtoupper(substr($request->release_id,0 ,5));
        $testreportcount = TestReport::where('id', 'like', $project_title.$testreport_title.'%')->count();
        $version = TestReport::where('id', 'like', $project_title.$testreport_title.'%')->orderBy('version', 'desc')->first();
        $testreport = new TestReport();
        $versioncount = $testreportcount;
        if($testreportcount >= 0){
            $testreportcount++;
        }

        $testreport->id = strtoupper(substr($request->project,0 ,5)).$testreport_title.$testreportcount;
        $testreport->project_id = strtoupper(substr($request->release_id,0 ,5)).strtoupper(substr($request->project,0 ,5));
        $testreport->title = $request->testreport_title;
        $testreport->description = $request->description;

        if(isset($version->version)){
            if($version->version >= $request->version) {
                $testreport->version = $version->version + 0.01;
            }
        }else{
            $testreport->version = $request->version;
        }
        $testreport->author = $request->author;
        $testreport->specificationtype = $request->specification;

        $testreport->save();
        return redirect()->route('projectdetails',['title' => $request->project, 'release_id ' => $release_id]);
    }

    public function showTestReport($release_id,$title,$testreport_title, $version){
        $title = strtoupper(substr($title,0 ,5));
        $release_id = strtoupper(substr($release_id,0 ,5));


        $project = Project::where(['id' => $release_id.$title, 'release_id' => $release_id])->first();
        $release = Release::where('id' ,$release_id)->first();
        $testreport = TestReport::where([['project_id', $release_id.$title],['title', $testreport_title],['version', $version]])->first();

        $features = Feature::where('testreport_id', $testreport->id)->get();
        $requirements = Requirement::where('testreport_id', $testreport->id)->get();

        return view('testreport.details_testreport', compact('testreport', 'project', 'features', 'release', 'requirements'));
    }
}