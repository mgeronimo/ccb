<?php

namespace App\Http\Middleware;

use Closure;
use App\Auth;

class CheckIfPublicUser
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

        if($user->role == 3)
            return $next($request);
    }
}
