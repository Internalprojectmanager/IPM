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

    public function overviewCompany()
    {
        $companys = Company::all();

        return view('testrapport.testrapport', compact('testrapports'));
    }

    public function detailsCompany($name)
    {
        $testrapports = Testrapport::where('title', $title)->first();
        return view('testrapport.details_company', compact('testrapports'));
    }

    public function editTestrapport($name)
    {
        $testrapports = Testrapport::where('title', $title)->first();

        return view('testrapport.edit_testrapport', compact('testrapports'));
    }

    public function updateCompany($name, Request $request)
    {
        $request->validate([
            'testrapport_title' => 'required|unique:testrapport,title'
        ]);

        $testrapport = Testrapport::all()->where('title', $title)->first();
        $testrapport->id = $request->id;
        $testrapport->title = $request->testrapport_title;
        $testrapport->description = $request->description;

        $company->save();

        return redirect()->route('overviewtestrapport');
    }

    public function deleteTestrapport($name)
    {
        $testrapport = Testrapport::where('title', $title);
        $testrapport->delete();

        return redirect()->route('overviewtestrapport');
    }
}