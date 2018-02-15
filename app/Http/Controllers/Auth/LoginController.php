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
        return Socialite::driver($provider)->redirect();
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
            // storing data to our use table and logging them in
            $data = [
                'first_name' => $user->user['name']['givenName'],
                'last_name' => $user->user['name']['familyName'],
                'email' => $user->getEmail(),
                'provider' => $provider,
                'active' => 1,
                'password' => bcrypt('avocad0'),
            ];

            // Here, check if the user already exists in your records
            $my_user = User::where('email', '=', $user->getEmail())->first();
            if ($my_user === NULL) {
                Auth::login(User::firstOrCreate($data));
            } else {
                Auth::login($my_user);
            }
        }
        return redirect($this->redirectPath());
    }
}
