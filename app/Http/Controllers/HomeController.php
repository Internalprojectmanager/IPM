<?php

namespace App\Http\Controllers;

use App\Assignee;
use App\Mail\newAccount;
use App\Requirement;
use App\UserMail;
use Illuminate\Http\Request;
use App\Status;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use PragmaRX\Version\Package\Version;
use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public static function getVersion()
    {
        $internal = file_get_contents(public_path('../VERSION'), 'r');

        $ch = curl_init("https://gitlab.com/internalprojectmanager/IPM/raw/master/VERSION");
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Authorization' => env('AUTH_GITLBAB_KEY')
        ));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $external = curl_exec($ch);
        curl_close($ch);

        $ch = curl_init("https://gitlab.com/api/v4/projects/" . env('GITLAB_PROJECT_ID') . "/repository/tags/");
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Authorization' => env('AUTH_GITLBAB_KEY'),
            'sort' => 'ASC'
        ));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($ch);
        curl_close($ch);

        if (strpos($internal, 'RC') === false) {
            $external = $internal;
            $major = $internal;
            if (isset($result) && $result !== null && $result !== "") {
                foreach (json_decode($result) as $tag) {
                    if ($tag->name == floatval($internal) && version_compare($tag->name, $internal) == true) {
                        $external = $tag->name;
                    }
                    if (version_compare($tag->name, $major) > 0 && strpos($tag->name, 'RC') === false) {
                        $major = $tag->name;
                    }
                }
            }
        }
        $color = 'black';
        $color_major = "blue";


        if(version_compare($external, $internal) == 0)
        {
            $response = "Latest Version";
            $color = "green";
        }

        else{
            $response = "Update ASAP - V$external";
            $color = "red";
        }

        if(isset($major) && version_compare($major, $internal) == true){
            $major = "New Major - V$major Available";
            $color_major = "blue";
        } else{
            $major = null;
        }
        return collect(array(['response' => $response, 'color' => $color, 'major_color' => $color_major, 'major' => $major]));

    }


    public function index()
    {
        return redirect()->route('dashboard');
    }

    public function calcDeadline($data)
    {
        $now = Carbon::now()->endOfDay();
        foreach ($data as $d) {
            $deadline = Carbon::parse($d->features->releases->deadline)->endOfDay();
            $d->features->releases->daysleft = $now->diffInDays($deadline, false);
            if ($d->features->releases->daysleft >= 30 && $d->features->releases->daysleft < 365 ||
                $d->features->releases->daysleft <= -30 && $d->features->releases->daysleft > -365) {
                $d->features->releases->monthsleft = $now->diffInMonths($deadline, false);
            }
        }

        return $data;
    }

    public function dashboard(Request $request)
    {
        $requirements = [];
        $status = Status::wherein('name', ['Draft', 'In Progress', 'Testing'])->select('name');
        $assinged = Assignee::where('userid', \Auth::id())
            ->where('status', '!=', Status::name('Completed')->id)
            ->select('uuid')
            ->get();

        if ($assinged) {
            foreach ($assinged as $a) {
                $validator = \Validator::make(['uuid' => $a->uuid], ['uuid' => 'uuid']);
                if ($validator->passes()) :
                    $requirements[] = $a->uuid;
                endif;
            }
        }
        $requirements = Requirement::with('features.releases.projects.company', 'rstatus', 'assignees')
            ->whereHas('rstatus', function ($query) use ($status) {
                $query->wherein('name', $status);
            })->whereHas('features.releases', function ($q2) {
                $q2->orderbyraw('-deadline desc');
            })->whereHas('assignees', function ($q3) {
                $q3->where('userid', \Auth::id());
            })->whereIn('requirement_uuid', $requirements);

        $requirementscount = $requirements->get()->count();
        $requirements = $requirements->paginate(10);

        $requirements = $this->calcDeadline($requirements);
        $status = Status::type('Progress')->get();


        if ($request->method() == 'POST') {
            return view('profile.dashboard_table', compact('requirements', 'requirementscount', 'status'));
        }

        return view('profile.dashboard', compact('requirements', 'requirementscount', 'status'));
    }

    public function dashboardSearch(Request $request)
    {
        if (isset($request->data)) {
            return app('App\Http\Controllers\RequirementController')->saveAuthStatus($request);
        }

        $pro = array();
        $page = $request->page;
        $search = $request->search;

        $requirements = [];
        $features = [];
        $status = Status::wherein('name', ['Draft', 'In Progress', 'Testing'])->select('name');
        $assinged = Assignee::where('userid', \Auth::id())
            ->where('status', '!=', Status::name('Completed')->id)
            ->select('uuid')
            ->get();
        $feature = Requirement::search($search)->get();

        if ($assinged) {
            foreach ($assinged as $a) {
                $validator = \Validator::make(['uuid' => $a->uuid], ['uuid' => 'uuid']);
                if ($validator->passes()) :
                    $requirements[] = $a->uuid;
                endif;
            }
        }

        if ($feature) {
            foreach ($feature as $f) {
                if (in_array($f->requirement_uuid, $requirements)) {
                    $features[] = $f->requirement_uuid;
                }
            }
        }

        $feature = Requirement::with('features.releases.projects.company', 'rstatus')
            ->whereHas('rstatus', function ($query) use ($status) {
                $query->wherein('name', $status);
            })->whereHas('features.releases', function ($q2) {
                $q2->orderbyraw('-deadline desc');
            })->whereIn('requirement_uuid', $features);

        $requirementscount = $feature->get()->count();

        if ($requirementscount <= 10) {
            $page = 1;
        }
        $feature = $feature->paginate(10, ['*'], 'page', $page);

        $requirements = $this->calcDeadline($feature);
        $status = Status::type('Progress')->get();
        return view('profile.dashboard_table', compact('requirements', 'requirementscount', 'status'));
    }

    public function help()
    {
        $version = $this->getVersion();
        return view('profile.help', compact('version'));
    }

    public function activateEmailForm(){
        return view('auth.activate');
    }

    public function sendActivationMail(){
        $user = User::find(Auth::id());
        $usermail = UserMail::where('email', $user->email)->first();

        Mail::to($usermail->email)->send(new newAccount($user, $usermail->email , $usermail->code));
        \flash('Activation mail has been send to your email')->success();
        return redirect()->intended('activateEmailForm');
    }

    public function activateEmail($email, $code){
        $usermail = UserMail::where('email', $email)->where('verificationcode', $code)->get();
        if($usermail->count() > 0){
            foreach ($usermail as $um){
                $user = User::where('email', $um->email)->first();
                if(isset($user)){
                    if($um->email == $user->email) {
                        $user->verified = 1;
                        $user->save();
                        $um->delete();
                    } else{
                        $um->active = true;
                        $um->verificationcode = null;
                        $um->save();
                    }
                } else{
                    $um->active = true;
                    $um->verificationcode = null;
                    $um->save();
                }
            }
            flash($email. ' has been activated');
            return redirect()->intended('profile');
        } else{
            abort(404);
        }


    }
}
