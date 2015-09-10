<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Auth;
use App\Group;
use App\User;

class Authenticate
{
    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $auth;

    /**
     * Create a new filter instance.
     *
     * @param  Guard  $auth
     * @return void
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($this->auth->guest()) {
            if ($request->ajax()) {
                return response('Unauthorized.', 401);
            } else {
                return redirect()->guest('/login');
            }
        }
        else{
            $user = Auth::user();

            if($user->role==0){

                /*
                This will be termorarily placed here. Still to be optimized
                 */
                $groups = Group::orderBy('group_name')->get();
                foreach ($groups as $key => $group) {
                   $supervisor = User::where('group_number', $group->id)
                                ->where('role', 1)->first();
                   $group->supervisor = $supervisor->first_name." ".$supervisor->last_name;
                    //dd($supervisor);
                }

                return view('admin.index')->with('user', $user)->with('groups', $groups);
            }
            else if($user->role==2)
            {
                return view('dashboard')->with('user', $user);
            }
            else if($user->role==1)
            {
                return view('supervisor.dashboardsupervisor')->with('user', $user);
            }
            else if($user->role>2)
            {
                Auth::logout();
                return redirect('/login');
            }
        }

        return $next($request);
    }
}
