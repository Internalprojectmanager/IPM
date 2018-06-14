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
use App\User;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function addClient()
    {
        $teams = Auth::user()->teams();
        $status = Status::where('type', 'Client')->get();
        return view('client.add_client_form', compact('status', 'teams'));
    }

    public function storeClient(Request $request)
    {
        $request->validate([
            'client_name' => 'required|unique:client,name',
            'status' => 'exists:status,name',
            'team' => 'exists:teams,id|required',
        ]);

        $status = Status::name($request->status);
        $client = new Client();
        $client->name = $request->client_name;
        if($request->team){
            $client->team_id = Team::find(id)->id;
        }

        $client->path = str_slug($client->name);
        $client->description = $request->description;
        $client->status = $status->id;
        $client->contactname = $request->contact_name. ' ' .$request->contact_surname;
        $client->contactnumber = $request->contact_number;
        $client->contactemail = $request->contact_email;
        $client->link = serialize(array('text' => $request->link_title, 'link' => $request->link_url));

        $client->save();

        return redirect()->route('overviewclient');
    }

    public function overviewClient()
    {
        $clients = Client::sortable()->withCount('projects')->with('cstatus')->currentuserteam()->paginate(8);
        $clientcount = $clients->count();
        $status = Status::type('Client')->get();
        $teams = Auth::user()->teams();
        return view('client.client', compact('clients', 'clientcount', 'status', 'teams'));
    }

    public function searchClient(Request $request){
        $clie = [];
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
        $clients->where('team_id', Auth::user()->currentTeam()->id);
        $clients = $clients->get();

        if($clients->count() <= 8){
            $page = 1;
        }

        foreach ($clients as $c){
            $clie[] = $c->id;
        }

        $clients = Client::with('cstatus')->sortable([$sort => $order])->withCount('projects')->whereIn('client.id', $clie)->paginate(8, ['*'], 'page', $page);
        $clientcount = $clients->total();
        $status = Status::type('Client')->get();
        return view('client.client_table', compact('clients', 'clientcount', 'status'));

    }

    public function detailsClient($client)
    {
            $projects = Project::sortable()->where('company_id' , $client->id)->paginate(8);
            $projectcount = $projects->total();
            $status = Status::type('Client')->get();
            $link = unserialize($client->link);
            $client->link_title =$link['text'];
            $client->link_url=$link['link'];
            $user = User::all();
            $projectstatus = Status::type('Progress')->get();
            $teams = Auth::user()->teams();

            return view('client.details_client', compact('client', 'projects', 'projectcount', 'status', 'user', 'projectstatus', 'teams'));
    }

    public function detailsSort($client , Request $request)
    {
        $sort = $request->sort;
        $page = $request->page;
        $order = $request->order;
        $projects = Project::sortable([$sort => $order])->where('company_id', $client->id)->currentuserteam()->paginate(8, $page);
        $projectcount = $projects->count();
        return view('project.project_table', compact('client', 'projects', 'projectcount'));
    }

    public function updateClient($client, Request $request)
    {
        $request->validate([
            'client_name' => 'required|unique:client,name,' . $client->id,
            'status' => 'exists:status,name'
        ]);


        $client->name = $request->client_name;
        $client->path = str_slug($client->name);
        $client->description = $request->description;
        $client->status = status::name($request->status)->id;
        $client->contactname = $request->contact_name;
        $client->contactnumber = $request->contact_phonenumber;
        $client->contactemail = $request->contact_email;
        if(!empty($request->link_title) && !empty($request->link_url)){
            $client->link = serialize(array('text' => $request->link_title, 'link' => $request->link_url));
        }
        $client->save();

        return redirect()->route('clientdetails', $client->path);
    }

    public function deleteClient($client)
    {
        Client::path($client)->delete();

        return redirect()->route('overviewclient');
    }
}