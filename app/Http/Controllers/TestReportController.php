<?php

namespace App\Http\Controllers;

use App\TestReport;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Release;

class TestReportController extends Controller
{
    public function addTestReport($id)
    {
        $release = Release::where('id', $id)->first();


        return view('testreport.add_testreport', compact('release'));
    }

    public function storeTestReport(Request $request)
    {
        $testreport = new TestReport();
        $testreport->release_id = $request->release_id;
        $testreport->title = $request->title;
        $testreport->description = $request->description;
        $testreport->version = $request->version;
        $testreport->author = $request->author;
        $testreport->status = $request->status;

        $testreport->save();

        return redirect()->route('releaseoverview', ['name' => $projects->name, 'company_id' => $projects->company_id,
            'release_name' => $release->name, 'version' => $release->version]);
    }

    public function overviewTestReport($id)
    {
        $testreports = TestReport::where('id', $id);

        return view('release.details_release', compact('testreports'));
    }
}