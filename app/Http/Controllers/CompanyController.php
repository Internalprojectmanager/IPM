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
        return view('client.add_client');
    }

    public function storeCompany(Request $request)
    {
        $request->validate([
           'client_name' => 'required|unique:client,name'
        ]);

        $client = new Company();
        $client->id =strtoupper(substr($request->client_name,0 ,5));
        $client->name = $request->client_name;
        $client->description = $request->description;

        $client->save();

        return redirect()->route('overviewclient');
    }

    public function overviewCompany()
    {
        $clients = Company::all();
        $clientcount = $clients->count();

        return view('client.client', compact('clients', 'clientcount'));
    }

    public function detailsCompany($name)
    {
        $clients = Company::where('name', $name)->first();
        if(!$clients){
            abort(404);
        }
        return view('client.details_client', compact('clients'));
    }

    public function editCompany($name)
    {
        $clients = Company::where('name', $name)->first();
        if(!$clients){
            abort(404);
        }

        return view('client.edit_client', compact('clients'));
    }

    public function updateCompany($name, Request $request)
    {
        $request->validate([
            'client_name' => 'required|unique:client,name'
        ]);

        $client = Company::all()->where('name', $name)->first();
        $client->name = $request->client_name;
        $client->description = $request->description;

        $client->save();

        return redirect()->route('overviewclient');
    }

    public function deleteCompany($name)
    {
        $client = Company::where('name', $name);
        $client->delete();

        return redirect()->route('overviewclient');
    }
}