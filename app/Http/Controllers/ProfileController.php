<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileValidator;
use App\User;
use App\Status;
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
        }
        $profile->first_name = $request->first_name;
        $profile->last_name = $request->last_name;

        $profile->job_title = $request->job_title;

        $profile->save();
        return redirect('/profile')->with('status', 'Profile updated!');

    }
}
