<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\User;

class UserController extends Controller
{
    public function index(){
        if(Auth::user()->id == 1){
            $users = User::orderBy('last_name', 'asc')->get();

            return view('admin.users.index', compact('users'));
        }
        abort(404);
    }
}
