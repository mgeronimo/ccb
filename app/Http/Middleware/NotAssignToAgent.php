<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use App\Ticket;
use App\User;
class NotAssignToAgent
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
        $ticket = $request->id;
        $ticket = Ticket::where('id',$request->id)->first();
        if($ticket!=null)
       { 
             $ticketGroup = User::where('id', $ticket->assignee)->first();
               if(!$ticketGroup==null)
               {   $supervisor = User::where('group_number', $ticketGroup->group_number)
                                        ->where('role',1)->first();
               }
                                      
               if($user->role == 2 &&( $ticket->assignee==$user->id || $ticket->asignee == null))
               { 
                       return $next($request);
               }
               else if($user->role == 1 && $ticket->assignee == null)
               {
                   return $next($request);
               }
               else if($user->role==1 &&  $supervisor->group_number == Auth::user()->group_number)
               {
                   // $supervisor->group_number;
                   return $next($request);
               }
               else if($user->role==0)
               {
                 return $next($request);
               }
           
        }
        return redirect('/tickets');
    }
}
