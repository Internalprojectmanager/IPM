<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Team;
use App\UserMail;
use App\UserTeam;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Mail;
use Laravel\Socialite\Facades\Socialite;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Jenssegers\Agent\Agent;

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
    protected $redirectTo = '/home';
    protected $redirectLogoutTo = '/login';


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => ['logout', 'getLogout']]);
    }

    public function showLoginForm()
    {
        $agent = new Agent();
        return view('auth.login', compact('agent'));
    }

    public function login(Request $request)
    {
        $email = $request->email;
        $authUserMail = UserMail::with('user')->where('email', $request->email)->first();

        if ($authUserMail) {
            $email = $authUserMail->User->email;
        }

        $credentials = ['email' => $email, 'password' => $request->password, 'blocked' => false];

        if (Auth::attempt($credentials)) {
            // Authentication passed...
            return redirect()->intended('dashboard');
        } else {
            //Auth failed
            flash()->error('Email and Password does not exists in our system, Please Try again');
            return redirect(route('login'));
        }
    }


    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information from Google.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback($provider)
    {
        try {
            $user = \Socialite::with($provider)->user();
        } catch (\Exception $e) {
            return redirect('/login');
        }
        $authuser = $this->firstOrCreateOauth($user, $provider);
        if ($authuser !== null) {
            $this->firstOrCreatePersonal($authuser);
            Auth::login($authuser, false);
            flash()->success('Succesfully Logged in');
            return redirect()->intended('dashboard');
        } else {
            flash('User and password does not match with our data')->error();
            return redirect('/login');
        }
    }

    public function firstOrCreateOauth($user, $provider)
    {
        $authUser = User::where('email', $user->email)->first();
        $authUserMail = UserMail::where('email', $user->email)->first();

        if (!$authUser && !$authUserMail) {
            $code = str_random(32);
            switch ($provider) {
                case "google":
                    $authUser = User::create([
                        'first_name' => $user->user['given_name'],
                        'last_name' => $user->user['family_name'],
                        'email' => $user->email,
                        'provider' => $provider,
                        'provider_id' => $user->id
                    ]);

                    UserMail::create([
                        'user_id' => $authUser->id,
                        'provider' => $provider,
                        'provider_id' => $user->id,
                        'email' => $user->email,
                        'active' => false,
                        'verificationcode' => $code
                    ]);
                    return $authUser;
                    break;
                case "github":
                    $authUser = User::create([
                        'first_name' => $user->name,
                        'last_name' => " ",
                        'email' => $user->email,
                        'provider' => $provider,
                        'provider_id' => $user->id
                    ]);

                    UserMail::create([
                        'user_id' => $authUser->id,
                        'provider' => $provider,
                        'provider_id' => $user->id,
                        'email' => $user->email,
                        'active' => false,
                        'verificationcode' => $code,
                    ]);
                    return $authUser;
                    break;
                default:
                    break;
            }
        } else {
            $authUser = User::where('email', $user->email)->where('provider', $provider)->first();
            $authUserMail = UserMail::where('email', $user->email)->where('provider', $provider)
                ->orWhere('provider', '')
                ->first();
            if ($authUserMail && !$authUser) {
                $authUserMail->provider_id = $user->id;
                if ($authUserMail->provider == '') {
                    $authUserMail->provider = $provider;
                }
                $authUserMail->save();
                $authUser = User::find($authUserMail->user_id);
            }
        }

        return $authUser;
    }

    public function firstOrCreatePersonal($user)
    {
        $dataspace = [
            'name' => $user->fullName(),
            'owner_id' => $user->id
        ];

        $space = Team::firstOrCreate(['name' => $user->fullName()], $dataspace);

        if ($space->wasRecentlyCreated) {
            $datalink = [
                'user_id' => $user->id,
                'team_id' => $space->id,
                'current' => true,
                'active' => true
            ];

            UserTeam::create($datalink);
        }
    }
}
