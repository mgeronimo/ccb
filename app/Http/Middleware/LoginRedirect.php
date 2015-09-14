<?php

namespace App\Http\Middleware;
use Auth;
use Closure;

class LoginRedirect
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
        if($user->role == 0)
        {
            return view('admin.index');
        }
        else if ($user->role == 1 || $user->role == 2)
        {
            return redirect('/welcome');
        }
        
    }
}
