<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckActive
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);


        if (Auth::check()) {
            if(Auth::user()->active == 2){
                Auth::user()->active = true;
                Auth::user()->save();
            }

            if (Auth::user()->toc == false) {
                return redirect()->intended('terms');
            } elseif (Auth::user()->active == 0) {
                Auth::logout();
                flash()->error('Your Account is not actived or blocked, Please contact an admin of IPM');
                return redirect('/login');
            }
        } else {
            Auth::logout();
            return redirect('login');
        }

        return $response;
    }
}
