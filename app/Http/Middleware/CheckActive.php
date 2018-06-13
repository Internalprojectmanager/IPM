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


        if(Auth::check() && Auth::user()->active !==  1){
            Auth::logout();
            flash()->error('Your Account is not active, Please contact an admin');

            return redirect('/login');
        }

        return $response;
    }
}
