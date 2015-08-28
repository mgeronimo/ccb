<?php

namespace App\Http\Middleware;
use Auth;
use Closure;

class IfNotAgentOrSupervisor
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
        $user = Auth::user();
        if(!Auth::check())
        {
            return redirect('/login');
        }
        else if($user->role != 1 && $user->role !=2 && $user->role != 0)
        {
            return redirect ('errors.503');
        }

        return $next($request);
    }
}
