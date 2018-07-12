<?php

namespace App\Http\Middleware;

use App\TeamPlan;
use Closure;

use App\Team;
use App\Plan;
use App\UserTeam;
use Illuminate\Support\Facades\Auth;

class CheckPlanStatus
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
        //If the Plan is not approved Change team to No Plan
        if (!Auth::guest()) {
            foreach (Auth::user()->teams() as $team) {
                if ($team->plan() == null) {
                    $teamplan = new TeamPlan();
                    $teamplan->plan_id = Plan::name('No Plan')->id;
                    $teamplan->team_id = $team->id;
                    $teamplan->start = \Carbon\Carbon::now('Europe/Amsterdam')->toDateTimeString();
                    $teamplan->end =  \Carbon\Carbon::now('Europe/Amsterdam')->addYears(10)->toDateTimeString();
                    $teamplan->save();
                } elseif ($team->plan()->name == Plan::name('No Plan')->name) {
                    UserTeam::where('team_id', $team->id)->where('user_id', '!=', $team->owner_id)->update(['active' => false]);
                }
            }
        }
        return $response;
    }
}
