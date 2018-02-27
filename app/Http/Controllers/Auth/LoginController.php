<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Laravel\Socialite\Facades\Socialite;
use App\User;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/project/overview';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['guest', 'checkactive'])->except('logout');
    }


    public function redirectToProvider($provider = "google")
    {
        return Socialite::driver($provider)->with(['prompt' =>  'select_account'])->redirect();
    }

    /**
     * Obtain the user information from Google.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback($provider = 'google')
    {
        $user = Socialite::driver($provider)->user();
        $domain = preg_replace('/.+@/', '', $user->getEmail());

        if ($domain == 'itsavirus.com') {
            // Here, check if the user already exists in your records
            $authuser = $this->firstOrCreateOauth($user, $provider);
            Auth::login($authuser);
        }
        return redirect()->intended('overviewprojects');
    }

    public function firstOrCreateOauth($user, $provider){
        $authuser = User::where('email', $user->email)->first();

        if($authuser){
            $authuser->provider_id = $user->provider_id;
            $authuser->save();
            return $authuser;
        }
        return User::create([
            'provider_id' => $user->id,
            'first_name' => $user->user['name']['givenName'],
            'last_name' => $user->user['name']['familyName'],
            'email' => $user->getEmail(),
            'provider' => $provider,
            'active' => 1,
        ]);
    }
}
