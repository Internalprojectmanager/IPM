<?php

namespace App\Http\Middleware;

use App\UserMail;
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
            if (Auth::user()->toc == false && Auth::user()->verified == false) {
                return redirect()->intended('terms');
            } elseif(Auth::user()->toc == true && Auth::user()->verified == false){
                $usermail = UserMail::where('email', Auth::user()->email)->first();

                if(!$usermail){
                    $usermail = new UserMail();
                    $usermail->user_id = Auth::id();
                    $usermail->email = Auth::user()->email;
                    $usermail->provider = Auth::user()->provider;
                    $usermail->verificationcode = str_random(32);
                    $usermail->active = 0;
                    $usermail->save();
                }
                return redirect()->intended('activateEmail');
            } elseif (Auth::user()->active == false && Auth::user()->toc == true && Auth::user()->verified == true) {
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
