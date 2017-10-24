<?php
namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Project;
use App\Letter;
use App\Company;

class LetterController extends Controller
{
    public function addLetter($name, $company_id){
        $projects = Project::where('name', $name)->first();
        $companys = Company::where('id', $company_id)->first();

        return view('letter.add_letter', compact('projects', 'companys'));
    }

    public function storeLetter(Request $request){
        $letter = new Letter();
        $letter->project_id = strtoupper(substr($request->company_id,0 ,5)).strtoupper(substr($request->project,0 ,5));
        $letter->title = $request->letter_title;
        $letter->content = $request->letter_content;
        $letter->author = $request->author;
        $letter->contact_person = $request->contact_person;

        $letter->save();

        return redirect()->route('overviewproject');
    }

    public function showLetter($company_id,$name, $document_id, $document_name){
        $letter = Letter::with('projects.company')->where([['title', '=', $document_name], ['id', '=' , $document_id]])->first();

        return view('letter.details_letter', compact('letter'));
    }

    public function editLetter($project_id,$letter_id,$letter_title){
        $letters = Letter::with('projects')->where(['project_id' =>  $project_id, 'id' => $letter_id,
            'title' => $letter_title])->first();
        $projects = Project::all();

        return view('letter.edit_letter', compact('letters', 'projects'));
    }

    public function updateLetter($project_id, $letter_id, $letter_title, Request $request){
        $letter = Letter::where(['id' => $letter_id, 'project_id' => $project_id, 'title' => $letter_title])->first();
        $letter->title = $request->letter_title;
        $letter->content = $request->content;
        $letter->author = $request->author;
        $letter->contact_person = $request->contact_person;

        $letter->save();

        return redirect()->route('overviewproject');
    }

    public function deleteLetter($id)
    {
        $letter = Letter::where('id', $id);
        $letter->delete();

        return redirect()->route('overviewproject');
    }
}