<?php
namespace App\Http\Controllers;
use App\Http\Requests\DocumentValidator;
use Illuminate\Support\Facades\Storage;


use App\DocumentRevision;
use App\User;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Project;
use App\Document;
use App\Client;
use App\Release;
use App\Status;
use Webpatser\Uuid\Uuid;
use Illuminate\Support\Facades\Auth;

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

    public function addDocument($company_id, $name){
        $projects = Project::where('name', $name)->first();
        $companys = Client::where('id', $company_id)->first();
        $release = Release::where('project_id', $projects->id)->get();
        $status = Status::where('type', 'Progress')->orWhere('type', 'Document')->get();

        return view('document.add_document', compact('projects', 'companys', 'release', 'status'));
    }

    public function storeDocument(DocumentValidator $request)
    {
        $document = new Document();
        if($request->hasFile('upload')) {
            Storage::makeDirectory("public/documents/" . $request->project_id);
            $path = $request->file('upload')->storeAs("public/documents/" . $request->project_id, $request->document_title . "-" . $request->upload->getClientOriginalName());
            $document->link = $path;
            $document->filename = $request->upload->getClientOriginalName();
        }

        $document->document_id = Uuid::generate(4);
        $document->project_id = $request->project_id;
        $document->release_id = $request->release_id;
        $document->title = $request->document_title;
        $document->description = $request->description;
        $document->author = Auth::id();
        $document->category = $request->category;
        $document->status = $request->status;
        $document->save();

        $project = Project::where('id', $request->project_id)->first();
        return redirect()->route('projectdetails', ['name' => $project->name, 'company_id ' => $project->company_id]);
    }

    public function showDocument($company_id, $name, $document_id){
        $document = Document::with('projects.company')->where('id',$document_id)->first();
        $project = Project::where(['name' => $name, 'company_id' => $company_id])->first();
        if(!$document){
            abort(404);
        }

        //dd($document);

        return view('document.details_document', compact('document', 'project'));
    }

    public function downloadFile($company_id, $name, $document_id){
        $document = Document::with('projects.company')->where('id',$document_id)->first();
        if(!$document){
            abort(404);
        }


        return response()->download('storage/documents/'. $document->project_id. '/' . $document->title.'-'.$document->filename, $document->filename);
    }

    public function overviewDocuments($company_id, $name){
        $project = Project::where(['name' => $name, 'company_id' => $company_id])->first();
        $document = Document::with('projects.company')->where('project_id', $project->id)->get();
        if(!$document){
            abort(404);
        }

        return view('document.document', compact('document', 'project'));
    }


    public function editDocument($company_id, $name, $document_id){
        $document = Document::with('projects')->where('id', $document_id)->first();
        $project = Project::where(['name' => $name, 'company_id' => $company_id])->first();
        $status = Status::where('type', 'Progress')->orWhere('type', 'Document')->get();
        $release = Release::where('project_id', $project->id)->get();
        if(!$document){
            abort(404);
        }

        return view('document.edit_document', compact('document', 'project', 'status', 'release'));
    }

    public function updateDocument($company_id, $name, $document_id, Request $request){
        $document = Document::where('id', $document_id)->first();
        $this->createRevision($document);

        if($request->hasFile('upload')){
            $this->deleteFile($document_id);
            $path = $request->file('upload')->storeAs("public/documents/".$document->project_id , $request->document_title."-".$request->upload->getClientOriginalName());
            $document->link = $path;
            $document->filename = $request->upload->getClientOriginalName();
        }

        $document->title = $request->document_title;
        $document->description = $request->description;
        $document->author = Auth::id();
        $document->created_at = date('Y-m-d H:i:s');
        $document->category = $request->category;
        $document->status = $request->status;

        $document->save();
        return redirect()->route('showdocument', ['name' => $name, 'company_id' => $company_id, 'document_id' => $document_id]);
    }

    public function deleteFile($document_id)
    {
        $document = Document::where('id', $document_id)->first();
        $this->createRevision($document);
        $file = Storage::delete($document->link);
        if($file == true){
            $document->filename = NULL;
            $document->link = NULL;
            $document->save();
        }
        return redirect()->action('DocumentController@editDocument', [$document->projects->company_id,$document->projects->name, $document->id]);
    }

    public function deletedocument($company_id, $name, $document_id)
    {
        $document = Document::where('id', $document_id)->first();
        $this->createRevision($document);
        $this->deleteFile($document_id);
        $document->delete();
        return redirect()->action('DocumentController@overviewDocuments', [$document->projects->company_id,$document->projects->name]);
    }
}