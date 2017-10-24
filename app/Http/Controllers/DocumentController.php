<?php
namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Project;
use App\Document;
use App\Company;

class DocumentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function addDocument($name, $company_id){
        $projects = Project::where('name', $name)->first();
        $companys = Company::where('id', $company_id)->first();

        return view('document.add_document', compact('projects', 'companys'));
    }

    public function storeDocument(Request $request){
        $document = new Document();
        $document->project_id = strtoupper(substr($request->company_id,0 ,5)).strtoupper(substr($request->project,0 ,5));
        $document->title = $request->document_title;
        $document->description = $request->description;
        $document->author = $request->author;

        $document->save();

        return redirect()->route('overviewproject');
    }

    public function showDocument($company_id,$name, $letter_id, $letter_name){
        $document = Document::with('projects.company')->where([['title', '=', $letter_name], ['id', '=' , $letter_id]])->first();
        if(!$document){
            abort(404);
        }
        return view('document.details_document', compact('document'));
    }

    public function editDocument($project_id,$document_id,$document_title){
        $documents = Document::with('projects')->where(['project_id' =>  $project_id, 'id' => $document_id,
            'title' => $document_title])->first();
        if(!$documents){
            abort(404);
        }
        $projects = Project::all();

        return view('document.edit_document', compact('documents', 'projects'));
    }

    public function updateDocument($document_id, $project_id, $document_title, Request $request){
        $document = Document::where(['id' => $document_id, 'project_id' => $project_id, 'title' => $document_title])->first();
        $document->project_id = $request->project_id;
        $document->title = $request->document_title;
        $document->description = $request->description;
        $document->author = $request->author;

        $document->save();

        return redirect()->route('overviewproject');
    }
}