<?php
namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Project;

class LetterController extends Controller
{
    public function addLetter($name){
        $projects = Project::where('name', $name)->first();

        return view('letter.add_letter', compact('projects'));
    }

    public function storeLetter(Request $request){
        $letter = new Letter();
        $letter->id = strtoupper(substr($request->letter_title,0 ,5));
        $letter->project_id = strtoupper(substr($request->project,0 ,5));
        $letter->title = $request->letter_title;
        $letter->content = $request->letter_content;
        $letter->author = $request->author;
        $letter->contactperson = $request->contact_person;

        $letter->save();

        return redirect()->route('overviewproject');
    }
}