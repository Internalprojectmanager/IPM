<?php
namespace App\Http\Controllers;

use App\LetterRevision;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Project;
use App\Letter;
use App\Client;
use App\Document;
use App\Release;
use Webpatser\Uuid\Uuid;

class LetterController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    function createRevision($letter){
        $letter_revision = new LetterRevision();
        $letter_revision->letter_id = $letter->letter_id;
        $letter_revision->project_id = $letter->project_id;
        $letter_revision->title = $letter->title;
        $letter_revision->content = $letter->content;
        $letter_revision->contact_person = $letter->contact_person;
        $letter_revision->creator = $letter->author;
        $letter_revision->original_created_at = $letter->created_at;
        $saved = $letter_revision->save();

        if(!$saved){
            App:abort('500', 'Error');
        }
        return true;
    }

    public function addLetter($name, $company_id){
        $projects = Project::where('name', $name)->first();
        $companys = Client::where('id', $company_id)->first();

        return view('letter.add_letter', compact('projects', 'companys'));
    }

    public function storeLetter(Request $request){
        $project = Project::where('id', $request->project_id)->first();
        $letter = new Letter();
        $letter->project_id = $request->project_id;
        $letter->letter_id = Uuid::generate(4);
        $letter->title = $request->letter_title;
        $letter->content = $request->letter_content;
        $letter->author = $request->author;
        $letter->contact_person = $request->contact_person;

        $letter->save();

        return redirect()->route('projectdetails',['name' => $project->name, 'company_id ' => $project->company_id]);
    }

    public function showLetter($company_id,$name, $letter_id){
        $letter = Letter::with('projects.company')->where('id', '=' , $letter_id)->first();
        $project = Project::where(['name' => $name, 'company_id' => $company_id])->first();
        if(!$letter){
            abort(404);
        }

        return view('letter.details_letter', compact('letter', 'project'));
    }

    public function editLetter($company_id,$name,$letter_id){
        $letters = Letter::with('projects')->where( 'id' ,$letter_id)->first();
        $project = Project::where(['name' => $name, 'company_id' => $company_id])->first();

        return view('letter.edit_letter', compact('letters', 'project'));
    }

    public function updateLetter($company_id, $name, $letter_id, Request $request){
        $letter = Letter::where('id' , $letter_id)->first();
        $this->createRevision($letter);

        $letter->title = $request->letter_title;
        $letter->content = $request->content;
        $letter->author = $request->author;
        $letter->contact_person = $request->contact_person;
        $letter->save();

        $projects = Project::where(['name' => $name, 'company_id' =>$company_id])->first();
        $companys = Client::where('id', $company_id)->first();
        $releases = Release::where('project_id', $projects->id)->get();
        $documents = Document::where('project_id', $projects->id)->get();
        $letters = Letter::where('project_id', $projects->id)->get();

        return view('project.details_project', compact('projects', 'companys', 'releases', 'documents', 'letters'));
    }

    public function deleteLetter($id)
    {
        $letter = Letter::where('id', $id)->first();
        $project = Project::where('id', $letter->project_id)->first();
        $this->createRevision($letter);
        $letter->delete();

        return redirect()->route('projectdetails',['name' => $project->name, 'company_id ' => $project->company_id]);

    }
}