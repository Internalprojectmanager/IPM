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
    public function storeTestReport(Request $request)
    {
        $testreport = new TestReport();
        $testreport->id = $request->id
        $testreport->release_id = $request->release_id;
        $testreport->title = $request->title;
        $testreport->description = $request->description;
        $testreport->version = $request->version;
        $testreport->author = $request->author;
        $testreport->status = $request->status;

        $testreport->save();

        return redirect()->route('overviewtestreport');
    }

    public function overviewTestReport()
    {
        $testreports = TestReport::all();

        return view('testreport.testreport', compact('testreports'));
    }
}