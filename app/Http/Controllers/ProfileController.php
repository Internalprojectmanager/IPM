<?php

namespace App\Http\Controllers;

use App\Assignee;
use App\AssigneeRole;
use App\Http\Requests\ProfileValidator;
use App\Project;
use App\User;
use App\Status;
use App\UserMail;
use App\UserTeam;
use App\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Session\Flash;
use Illuminate\Support\Facades\Mail;
use App\Mail\EmailUsed;

class ProfileController extends Controller
{
    public function __construct()
    {
    }


    public function viewProfile()
    {
        $profile = User::with('emails')->where('id', Auth::id())->select('id', 'first_name', 'last_name', 'email', 'job_title', 'provider', 'verified')->first();
        $status = Status::Where('type', 'Job')->select('id', 'name')->get();

        return view('profile.overview', compact('profile', 'status'));
    }

    public function updateProfile(ProfileValidator $request)
    {
        $profile = Auth::user();
        $profile->password = $request->password;

        if (!$request->first_name == '' && !$request->first_name == null && !$request->last_name == '' && !$request->last_name == null) {
            $profile->first_name = $request->first_name;
            $profile->last_name = $request->last_name;
        }

        $profile->job_title = $request->job_title;
        $profile->save();

        \flash('Profile updated')->success();
        return redirect()->intended('profile');
    }

    public function terms()
    {
        return view('profile.terms');
    }

    public function acceptedterms(Request $request)
    {
        if ($request->submit == "Decline") {
            $this->declinedterms($request);
        } else {
            $user = User::find(Auth::id());
            $user->toc = true;
            $user->save();
        }
        return redirect()->intended('dashboard');
    }

    public function declinedterms(Request $request)
    {
        $user = User::find(Auth::id());
        $assignee = Assignee::where('userid', $user->id)->get();
        foreach ($assignee as $a) {
            foreach (AssigneeRole::where('assignee_id', $a->id)->get() as $role) {
                $role->delete();
            }
            $a->delete();
        }
        $teams = Team::where('owner_id', $user->id)->select('id')->get();
        foreach ($teams as $team) {
            UserTeam::where('team_id', $team->id)->delete();
        }
        UserTeam::where('user_id', $user->id)->delete();
        Auth::logout();
        $user->delete();

        return redirect()->intended('login');
    }

    public function addEmail(Request $request){
        $user = User::find(Auth::id());

        $userEmail = Auth::user()->getEmails();
        $allEmails = User::where('email', $request->email)->first();
        $usermails = UserMail::where('email', $request->email)->first();

        foreach ($userEmail as $email => $providers){

            if($email == $request->email || $usermails || $allEmails){
                \flash('This email address already exists in our system, please choose a different email')->error();
                return redirect('profile');
            }
            if($request->email == null){
                \flash('Please fill in the required fields')->error();
                return redirect('profile');
            }
        }

        $code = str_random(32);
            $usermail = new UserMail();
            $usermail->user_id = Auth::user()->id;
            $usermail->provider = "";
            $usermail->provider_id = "";
            $usermail->email = $request->email;
            $usermail->verificationcode = $code;
            $usermail->active = 0;
            $usermail->save();


        Mail::to($request->email)->send(new EmailUsed($user,  $request->email, $code, 'newEmailExisting'));
        \flash('Activation email has been send to your email address')->info();
        return redirect()->intended('profile');
    }

    public function deleteEmail(Request $request, $email){
        $usermails = UserMail::where('email', $email)->where('user_id', Auth::id())->get();

        foreach ($usermails as $usermail){
            $usermail->delete();
        }

        \flash($email.' has succesfully been removed')->success();
        return redirect()->intended('profile');
    }

    public function changePrimaryEmail(Request $request, $email){
        $user = User::find(Auth::id());

        $usermail = new UserMail();
        $usermail->user_id = $user->id;
        $usermail->provider = $user->provider;
        $usermail->provider_id = $user->provider_id;
        $usermail->email = $user->email;
        $usermail->save();

        $usermail = UserMail::where('email', $email)->first();

        $user->email = $usermail->email;
        $user->provider = $usermail->provider;
        $user->provider_id = $usermail->provider_id;

        $user->save();
        $usermail->delete();

        \flash($email.' is now your primary email')->success();
        return redirect()->intended('profile');
    }
}
