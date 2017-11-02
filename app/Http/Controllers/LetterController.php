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
use App\Company;
use App\Document;
use App\Release;
use Webpatser\Uuid\Uuid;

class LetterController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function addLetter($name, $company_id){
        $projects = Project::where('name', $name)->first();
        $companys = Company::where('id', $company_id)->first();

        return view('letter.add_letter', compact('projects', 'companys'));
    }

    public function storeLetter(Request $request){
        $letter = new Letter();
        $letter->project_id = strtoupper(substr($request->company_id,0 ,5)).strtoupper(substr($request->project,0 ,5));
        $letter->letter_id = Uuid::generate(4);
        $letter->title = $request->letter_title;
        $letter->content = $request->letter_content;
        $letter->author = $request->author;
        $letter->contact_person = $request->contact_person;

        $letter->save();

        return redirect()->route('overviewproject');
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

        $letter_revision = new LetterRevision();
        $letter_revision->letter_id = $letter->letter_id;
        $letter_revision->project_id = $letter->project_id;
        $letter_revision->title = $letter->title;
        $letter_revision->content = $letter->content;
        $letter_revision->contact_person = $letter->contact_person;
        $letter_revision->creator = $letter->author;
        $letter_revision->original_created_at = $letter->created_at;
        $letter_revision->save();

        $letter->title = $request->letter_title;
        $letter->content = $request->content;
        $letter->author = $request->author;
        $letter->contact_person = $request->contact_person;
        $letter->save();

        $projects = Project::where(['name' => $name, 'company_id' =>$company_id])->first();
        $companys = Company::where('id', $company_id)->first();
        $releases = Release::where('project_id', $projects->id)->get();
        $documents = Document::where('project_id', $projects->id)->get();
        $letters = Letter::where('project_id', $projects->id)->get();

        return view('project.details_project', compact('projects', 'companys', 'releases', 'documents', 'letters'));
    }

    public function deleteLetter($id)
    {
        $letter = Letter::where('id', $id)->first;
        $letter_revision = new LetterRevision();
        $letter_revision->letter_id = $letter->letter_id;
        $letter_revision->project_id = $letter->project_id;
        $letter_revision->title = $letter->title;
        $letter_revision->content = $letter->content;
        $letter_revision->contact_person = $letter->contact_person;
        $letter_revision->creator = $letter->author;
        $letter_revision->original_created_at = $letter->created_at;
        $letter_revision->save();
        $letter->delete();

        return redirect()->route('overviewproject');
    }
}