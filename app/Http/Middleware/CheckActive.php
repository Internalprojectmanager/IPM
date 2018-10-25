<?php

namespace App\Http\Middleware;

use App\UserMail;
use Closure;
use Illuminate\Support\Facades\Auth;
use Jenssegers\Agent\Agent;



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
        $agent = new Agent();

        if (Auth::check()) {
            if ($agent->isMobile() || $agent->isTablet()) {
                Auth::logout();
                flash()->error('' .$agent->browser() .'Please use a desktop/ Laptop computer to use IPM, <br> Mobile devices not supported');
                return redirect('/non-supported');
            }
            if (Auth::user()->blocked == true) {
                Auth::logout();
                flash()->error('Your Account is not actived or blocked, Please contact an admin of IPM');
                return redirect('/login');
            }
            if (Auth::user()->toc == false && Auth::user()->verified == false) {
                return redirect()->intended('terms');
            } elseif (Auth::user()->toc == true && Auth::user()->verified == false || Auth::user()->active == false) {
                $usermail = UserMail::where('email', Auth::user()->email)->first();

                if (!$usermail) {
                    $usermail = new UserMail();
                    $usermail->user_id = Auth::id();
                    $usermail->email = Auth::user()->email;
                    $usermail->provider = Auth::user()->provider;
                    $usermail->verificationcode = str_random(32);
                    $usermail->active = 0;
                    $usermail->save();
                }
                flash()->info('Your Account is not verified, Please activate your email');
                return redirect()->intended('activateEmail');
            } else if (Auth::user()->password == null) {
                \flash('Please enter a password for your account')->error();
                return redirect()->intended('profile');
            }
        } else {
            Auth::logout();
            return redirect('login');
        }

        return $response;
    }
}
