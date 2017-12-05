<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Session\Flash;

class ProfileController extends Controller
{
    public function viewProfile(){

        $profile = User::where('id', Auth::id())->select('id','first_name', 'last_name', 'email')->first();
        return view('profile.overview', compact('profile'));
    }

    public function updateProfile(Request $request){
        $profile = Auth::user();

        $profile->first_name = $request->first_name;
        $profile->last_name = $request->last_name;


        if(!$request->email == ''){
            $profile->email = $request->email;
        }

        if( !$request->password == ''){
            $profile->password = bcrypt($request->password);
        }
        Flash::message('Your account has been updated!');
        $profile->save();
        return redirect('/profile');

    }
}
