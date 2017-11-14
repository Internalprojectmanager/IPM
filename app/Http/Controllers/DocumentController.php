<?php
namespace App\Http\Controllers;

use App\DocumentRevision;
use App\User;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Project;
use App\Document;
use App\Company;
use App\Release;
use App\Letter;
use Webpatser\Uuid\Uuid;

class DocumentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    function createRevision($document){
        $document_revision = new DocumentRevision();
        $document_revision->document_id = $document->document_id;
        $document_revision->project_id = $document->project_id;
        $document_revision->title = $document->title;
        $document_revision->description = $document->description;
        $document_revision->creator = $document->author;
        $document_revision->original_created_at = $document->created_at;
        $saved = $document_revision->save();

        if(!$saved){
            App:abort('500', 'Error');
        }
        return true;
    }

    public function addDocument($name, $company_id){
        $projects = Project::where('name', $name)->first();
        $companys = Company::where('id', $company_id)->first();

        return view('document.add_document', compact('projects', 'companys'));
    }

    public function storeDocument(Request $request){
        $document = new Document();
        $document->document_id = Uuid::generate(4);
        $document->project_id = strtoupper(substr($request->company_id,0 ,5)).strtoupper(substr($request->project,0 ,5));
        $document->title = $request->document_title;
        $document->description = $request->description;
        $document->author = $request->author;

        $document->save();

        return redirect()->route('overviewproject');
    }

    public function showDocument($company_id,$name, $document_id, $document_name){
        $document = Document::with('projects.company')->where([['title', '=', $document_name], ['id', '=' , $document_id]])->first();
        $project = Project::where(['name' => $name, 'company_id' => $company_id])->first();
        if(!$document){
            abort(404);
        }

        return view('document.details_document', compact('document', 'project'));
    }

    public function editDocument($company_id,$name,$project_id,$document_id,$document_title){
        $documents = Document::with('projects')->where(['project_id' =>  $project_id, 'id' => $document_id,
            'title' => $document_title])->first();
        if(!$documents){
            abort(404);
        }
        $project = Project::where(['name' => $name, 'company_id' => $company_id])->first();

        return view('document.edit_document', compact('documents', 'project'));
    }

    public function updateDocument($company_id, $name, $project_id, $document_id, $document_title, Request $request){
        $document = Document::where(['id' => $document_id, 'project_id' => $project_id, 'title' => $document_title])->first();
        $this->createRevision($document);

        $document->title = $request->document_title;
        $document->description = $request->description;
        $document->author = $request->author;
        $document->created_at = date('Y-m-d H:i:s');
        $document->save();

        $projects = Project::where(['name' => $name, 'company_id' =>$company_id])->first();
        $companys = Company::where('id', $company_id)->first();
        $releases = Release::where('project_id', $projects->id)->get();
        $documents = Document::where('project_id', $projects->id)->get();
        $letters = Letter::where('project_id', $projects->id)->get();

        return view('project.details_project', compact('projects', 'companys', 'releases', 'documents', 'letters'));
    }

    public function deleteDocument($id)
    {
        $document = Document::where('id', $id)->first();
        $this->createRevision($document);
        $document->delete();

        return redirect()->route('overviewproject');
    }
}