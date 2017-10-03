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
    public function addCompany()
    {
        return view('company.add_company');
    }

    public function storeCompany(Request $request)
    {

        $company = new Company();
        $company->id =strtoupper(substr($request->company_name,0 ,5));
        $company->name = $request->company_name;

        $company->save();

        return redirect()->route('overviewcompany');
    }

    public function overviewCompany()
    {
        $companys = Company::all();

        return view('company.company', compact('companys'));
    }

    public function deleteCompany($id)
    {


        return view('company.company');
    }
}