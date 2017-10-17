<?php
namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Project;

class DocumentController extends Controller
{
    public function addDocument($name){
        $projects = Project::where('name', $name)->first();

        return view('document.add_document', compact('projects'));
    }

    public function storeDocument(Request $request){
        $document = new Document();
        $document->id = strtoupper(substr($request->name,0 ,5));
        $document->project_id = strtoupper(substr($request->project,0 ,5));
        $document->title = $request->document_title;
        $document->description = $request->description;
        $document->author = $request->author;
    }
}