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
            if (Auth::user()->active == 1) {
                return redirect()->intended('terms');
            } elseif (Auth::user()->active == 0) {
                Auth::logout();
                flash()->error('Your Account is not active, Please contact an admin');
                return redirect('/login');
            }
        } else {
            Auth::logout();
            return redirect('login');
        }

        return $response;
    }
}
