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
        $letter->id = strtoupper(substr($request->letter_title,0 ,5));
        $letter->project_id = strtoupper(substr($request->company_id,0 ,5)).strtoupper(substr($request->project,0 ,5));
        $letter->title = $request->letter_title;
        $letter->content = $request->letter_content;
        $letter->author = $request->author;
        $letter->contact_person = $request->contact_person;

        $letter->save();

        return redirect()->route('overviewproject');
    }
}