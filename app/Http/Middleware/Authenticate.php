<?php

namespace App\Http\Middleware;

use Closure;
use DB;
use Illuminate\Contracts\Auth\Guard;
use Auth;
use App\Group;
use App\User;
use App\Department;
use App\Ticket;

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
        


            if($user->role==3){
                Auth::logout();
                return redirect('/login');
            }
            else{
                return redirect('/dashboard');
            }
        }

        return $next($request);
    }
}