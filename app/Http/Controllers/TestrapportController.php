<?php

namespace App\Http\Controllers;

use App\Testrapport;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Company;

class TestrapportController extends Controller
{
    public function addTestrapport()
    {
        return view('testrapport.add_testrapport');
    }

    public function storeTestrapport(Request $request)
    {
        $request->validate([
            'testrapport_name' => 'required|unique:testrapport,title'
        ]);

        $testrapport = new Testrapport();
        $testrapport->id = $request->id;
        $testrapport->title = $request->testrapport_title;
        $testrapport->description = $request->description;

        $testrapport->save();

        return redirect()->route('overviewtestrapport');
    }

    public function overviewTestrapport()
    {
        $testrapports = Testrapport::all();

        return view('testrapport.testrapport', compact('testrapports'));
    }

    public function detailsTestrapport($title)
    {
        $testrapports = Testrapport::where('title', $title)->first();
        return view('testrapport.details_testrapport', compact('testrapports'));
    }

    public function editTestrapport($title)
    {
        $testrapports = Testrapport::where('title', $title)->first();

        return view('testrapport.edit_testrapport', compact('testrapports'));
    }

    public function updateTestrapport($title, Request $request)
    {
        $request->validate([
            'testrapport_title' => 'required|unique:testrapport,title'
        ]);

        $testrapport = Testrapport::all()->where('title', $title)->first();
        $testrapport->id = $request->id;
        $testrapport->title = $request->testrapport_title;
        $testrapport->description = $request->description;

        $testrapport->save();

        return redirect()->route('overviewtestrapport');
    }

    public function deleteTestrapport($title)
    {
        $testrapport = Testrapport::where('title', $title);
        $testrapport->delete();

        return redirect()->route('overviewtestrapport');
    }
}