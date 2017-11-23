<?php

namespace App\Http\Controllers;

use App\Status;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Client;

class CompanyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function addCompany()
    {
        $status = Status::where('type', 'Client')->get();
        return view('client.add_client', compact('status'));
    }

    public function storeCompany(Request $request)
    {
        $client = new Client();
        $client->name = $request->client_name;
        $client->description = $request->description;
        $client->status = $request->status;
        $client->contactname = $request->contact_name;
        $client->contactnumber = $request->contact_number;
        $client->contactemail = $request->contact_mail;
        $client->save();

        return redirect()->route('overviewclient');
    }

    public function overviewCompany()
    {
        $clients = Client::all();
        $clientcount = $clients->count();

        return view('client.client', compact('clients', 'clientcount'));
    }

    public function detailsCompany($name)
    {
        $clients = Client::where('name', $name)->first();
        if(!$clients){
            abort(404);
        }
        return view('client.details_client', compact('clients'));
    }

    public function editCompany($name)
    {
        $clients = Client::where('name', $name)->first();
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

        $client = Client::all()->where('name', $name)->first();
        $client->name = $request->client_name;
        $client->description = $request->description;

        $client->save();

        return redirect()->route('overviewclient');
    }

    public function deleteCompany($name)
    {
        $client = Client::where('name', $name);
        $client->delete();

        return redirect()->route('overviewclient');
    }
}