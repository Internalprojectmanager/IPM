<?php

namespace App\Http\Controllers;

use App\Assignee;
use App\AssigneeRole;
use App\Http\Requests\ProfileValidator;
use App\Project;
use App\User;
use App\Status;
use App\UserTeam;
use App\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Session\Flash;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function viewProfile(){
        $profile = User::where('id', Auth::id())->select('id','first_name', 'last_name', 'email', 'job_title', 'provider')->first();
        $status = Status::Where('type' , 'Job')->select('id', 'name')->get();
        return view('profile.overview', compact('profile', 'status'));
    }

    public function updateProfile(ProfileValidator $request){
        $profile = Auth::user();

        if($profile->provider == "normal"){
            if(!$request->email == '' && !$request->email == ''){
                $profile->email = $request->email;
            }

            if( !$request->password == '' && !$request->password == NULL){
                $profile->password = $request->password;
            }
            if(!$request->first_name == '' && !$request->first_name == NULL && !$request->last_name == '' && !$request->last_name == NULL){
                $profile->first_name = $request->first_name;
                $profile->last_name = $request->last_name;
            }
        }
        $profile->job_title = $request->job_title;
        $profile->save();
        return redirect('/profile')->with('status', 'Profile updated!');

    }

    public function terms(){
        return view('profile.terms');
    }

    public function acceptedterms(Request $request){
        if($request->submit == "Decline"){
            $this->declinedterms($request);
        }else{
            $user = User::find(Auth::id());
            $user->active = 2;
            $user->save();
        }
        return redirect()->intended('dashboard');

    }

    public function declinedterms(Request $request){
        $user = User::find(Auth::id());
        $assignee = Assignee::where('userid', $user->id)->get();
        foreach($assignee as $a){
            foreach (AssigneeRole::where('assignee_id',$a->id)->get() as $role){
                $role->delete();
            }
            $a->delete();
        }
        $teams = Team::where('owner_id', $user->id)->select('id')->get();
        foreach ($teams as $team){
            UserTeam::where('team_id', $team->id)->delete();
        }
        UserTeam::where('user_id', $user->id)->delete();
        Auth::logout();
        $user->delete();

        return redirect()->intended('dashboard');

    }
}
