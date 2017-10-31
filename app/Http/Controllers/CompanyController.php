<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Company;

class CompanyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function addCompany()
    {
        return view('company.add_company');
    }

    public function storeCompany(Request $request)
    {
        $request->validate([
           'company_name' => 'required|unique:company,name'
        ]);

        $company = new Company();
        $company->id =strtoupper(substr($request->company_name,0 ,5));
        $company->name = $request->company_name;
        $company->description = $request->description;

        $company->save();

        return redirect()->route('overviewcompany');
    }

    public function overviewCompany()
    {
        $companys = Company::all();

        return view('company.company', compact('companys'));
    }

    public function detailsCompany($name)
    {
        $companys = Company::where('name', $name)->first();
        if(!$companys){
            abort(404);
        }
        return view('company.details_company', compact('companys'));
    }

    public function editCompany($name)
    {
        $companys = Company::where('name', $name)->first();
        if(!$companys){
            abort(404);
        }

        return view('company.edit_company', compact('companys'));
    }

    public function updateCompany($name, Request $request)
    {
        $request->validate([
            'company_name' => 'required|unique:company,name'
        ]);

        $company = Company::all()->where('name', $name)->first();
        $company->name = $request->company_name;
        $company->description = $request->description;

        $company->save();

        return redirect()->route('overviewcompany');
    }

    public function deleteCompany($name)
    {
        $company = Company::where('name', $name);
        $company->delete();

        return redirect()->route('overviewcompany');
    }
}