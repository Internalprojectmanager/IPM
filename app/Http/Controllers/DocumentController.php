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

    public function createRevision($document)
    {
        $document_revision = new DocumentRevision();
        $document_revision->document_id = $document->document_id;
        $document_revision->project_id = $document->project_id;
        $document_revision->title = $document->title;
        $document_revision->description = $document->description;
        $document_revision->creator = $document->author;
        $document_revision->original_created_at = $document->created_at;
        $saved = $document_revision->save();

        if (!$saved) {
            App:abort('500', 'Error');
        }
        return true;
    }

    public function addDocument($client, $project)
    {
        $release = Release::where('project_id', $project->id)->get();
        $status = Status::type('Progress')->orWhere('type', 'Document')->get();
        return view('document.add_document', compact('projects', 'client', 'project', 'release', 'status'));
    }

    public function storeDocument(DocumentValidator $request)
    {
        $document = new Document();
        if ($request->hasFile('upload')) {
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

    public function showDocument($client, $project, $document)
    {
        return view('document.details_document', compact('document', 'client', 'project'));
    }

    public function downloadFile($client, $project, $document)
    {
        return response()->download('storage/documents/'. $project->id. '/' . $document->title.'-'.$document->filename, $document->filename);
    }

    public function overviewDocuments($client, $project)
    {
        $document = Document::with('projects.company')->where('project_id', $project->id)->get();
        if (!$document) {
            abort(404);
        }

        return view('document.document', compact('document', 'project', 'client'));
    }


    public function editDocument($client, $project, $document)
    {
        $status = Status::type('Progress')->orWhere('type', 'Document')->get();
        $release = Release::where('project_id', $project->id)->get();
        if (!$document) {
            abort(404);
        }

        return view('document.edit_document', compact('document', 'project', 'client', 'status', 'release'));
    }

    public function updateDocument($client, $project, $document, Request $request)
    {
        $this->createRevision($document);

        if ($request->hasFile('upload')) {
            $this->deleteFile($document->id);
            $path = $request->file('upload')->storeAs("public/documents/".$document->project_id, $request->document_title."-".$request->upload->getClientOriginalName());
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
        return redirect()->route('showdocument', [$client->path, $project->path, $document->id]);
    }

    public function deleteFile($document)
    {
        $this->createRevision($document);
        $file = Storage::delete($document->link);
        if ($file == true) {
            $document->filename = null;
            $document->link = null;
            $document->save();
        }
        return redirect()->action('DocumentController@editDocument', [$document->projects->company->path,$document->projects->path, $document->id]);
    }

    public function deletedocument($client, $project, $document)
    {
        $this->createRevision($document);
        $this->deleteFile($document->id);
        $document->delete();
        return redirect()->action('DocumentController@overviewDocuments', [$client->path,$project->path]);
    }
}
