<?php

namespace App\Http\Controllers;

use App\Project;
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
        $status = Status::where('name', $request->status)->first();
        $client = new Client();
        $client->name = $request->client_name;
        $client->description = $request->description;
        $client->status = $status->id;
        $client->contactname = $request->contact_name;
        $client->contactnumber = $request->contact_number;
        $client->contactemail = $request->contact_mail;
        $client->link = serialize(array('title' => $request->link_title, 'link' => $request->link_url));
        $client->save();

        return redirect()->route('overviewclient');
    }

    public function overviewCompany()
    {
        $clients = Client::sortable()->withCount('projects')->with('cstatus')->paginate(8);
        $clientcount = $clients->count();
        $status = Status::where('type', 'Client')->get();
        return view('client.client', compact('clients', 'clientcount', 'status'));
    }

    public function searchCompany(Request $request){
        $clie = array();
        $search = $request->search;
        $status = $request->status;
        $sort = $request->sort;
        $order = $request->order;
        $page = $request->page;

        if($sort == NULL){
            $sort = "name";
            $order = "asc";
        }

        $clients = Client::search($search);
        if(isset($status)){
            $clients->where('status', $status);
        }
        $clientcount = $clients->get()->count();

        if($clientcount <= 8){
            $page = 1;
        }
        $clients = $clients->get();

        foreach ($clients as $c){
            $clie[] = $c->id;
        }

        $clients = Client::with('cstatus')->sortable([$sort => $order])->withcount('projects')->whereIn('client.id', $clie)->paginate(8, ['*'], 'page', $page);
        $clientcount = $clients->count();
        $status = Status::where('type', 'Client')->get();
        return view('client.client_table', compact('clients', 'clientcount', 'status'));

    }

    public function detailsCompany($name)
    {
            $clients = Client::with('cstatus', 'projects.assignee')->sortable('created_at', 'desc')->where('name', $name)->first();
            $projects = Project::sortable()->where('company_id' , $clients->id)->paginate(8);
            $projectcount = $projects->count();
            $status = Status::where('type', 'Client')->get();
            $link = unserialize($clients->link);
            $clients->link_title =$link['title'];
            $clients->link_url=$link['link'];
            return view('client.details_client', compact('clients', 'projects', 'projectcount', 'status'));
    }

    public function detailsSort($name , Request $request)
    {
        $sort = $request->sort;
        $page = $request->page;
        $order = $request->order;
        $clients = Client::with('cstatus', 'projects.assignee')->where('name', $name)->first();
        $projects = Project::sortable([$sort => $order])->where('company_id', $clients->id)->paginate(8);
        $projectcount = $projects->count();
        return view('project.project_table', compact('clients', 'projects', 'projectcount'));
    }

    public function updateCompany($name, Request $request)
    {
        $clients = Client::where('name', $name)->first();
        $request->validate([
            'client_name' => 'required|unique:client,name,' . $clients->id,
        ]);
        $clients->name = $request->client_name;
        $clients->description = $request->description;
        $clients->status = $request->status;
        $clients->contactname = $request->contact_name;
        $clients->contactnumber = $request->contact_number;
        $clients->contactemail = $request->contact_mail;
        if(!empty($request->linktext) && !empty($request->link)){
            $clients->link = serialize(array('text' => $request->linktext, 'link' => $request->link));
        }
        $clients->save();

        return redirect()->route('clientdetails', $clients->name);
    }

    public function deleteCompany($name)
    {
        $client = Client::where('name', $name);
        $client->delete();

        return redirect()->route('overviewclient');
    }
}