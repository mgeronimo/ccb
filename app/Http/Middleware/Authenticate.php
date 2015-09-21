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
        }
        else{
            $user = Auth::user();

            if($user->role==0){

                /*
                This will be termorarily placed here. Still to be optimized
                 */
                $groups = Group::orderBy('group_name')->take(5)->get();
                $tickets = Ticket::where('assignee', NULL)->orderBy('created_at', 'DESC')->take(10)->get();
                $depts = Department::orderby('dept_name')->take(5)->get();
                $unassigned_tickets = Ticket::where('assignee', NULL)->get();

                $closed_tickets = Ticket::where('status', 5)->get();
                $ongoing_tickets = Ticket::where('status', 2)->get();
                $cancelled_tickets = Ticket::where('status', 4)->get();
                $all_depts = Department::orderby('dept_name')->get();

                foreach ($groups as $key => $group) {
                   $supervisor = User::where('group_number', $group->id)
                                ->where('role', 1)->first();
                   $group->supervisor = $supervisor->first_name." ".$supervisor->last_name;
                }

                foreach ($tickets as $key => $ticket) {
                    $deptname = Department::find($ticket->dept_id)->pluck('dept_name');
                    $ticket->dept_name = $deptname;
                }

                return view('admin.index')->with('user', $user)
                    ->with('groups', $groups)
                    ->with('tickets', $tickets)
                    ->with('unassigned_tickets', count($unassigned_tickets))
                    ->with('closed_tickets', count($closed_tickets))
                    ->with('ongoing_tickets', count($ongoing_tickets))
                    ->with('cancelled_tickets', count($cancelled_tickets))
                    ->with('depts', $depts)
                    ->with('all_depts', count($all_depts));
            }
            else if($user->role==1)
            {
                $group = Group::where('id', $user->group_number)->first();
                $members = User::where('role', 2)->where('group_number', $user->group_number)->take(5)->get();
                $tickets = Ticket::where('assignee', NULL)->orderBy('created_at', 'DESC')->take(10)->get();
                $all_unassigned = Ticket::where('assignee', NULL)->get();
                $all_members = User::where('role', 2)->where('group_number', $user->group_number)->get();
                $all_assigned = DB::table('tickets as a')->join('users as b', 'a.assignee', '=', 'b.id')
                                ->where('b.role', 2)->where('b.group_number', 1)
                                ->groupBy('a.ticket_id')->take(5)->get();
                $count_assigned = DB::table('tickets as a')->join('users as b', 'a.assignee', '=', 'b.id')
                                ->where('b.role', 2)->where('b.group_number', 1)
                                ->groupBy('a.ticket_id')->get();

                foreach ($tickets as $key => $ticket) {
                    $deptname = Department::find($ticket->dept_id)->pluck('dept_name');
                    $ticket->dept_name = $deptname;
                }

                foreach ($all_assigned as $key => $memtix) {
                    if($memtix->status==0){ $memtix->status_name = 'New'; $memtix->class="label-success"; }
                    else if($memtix->status==1){ $memtix->status_name = 'In Process'; $memtix->class="bg-teal"; }
                    else if($memtix->status==2){ $memtix->status_name = 'Pending'; $memtix->class="bg-gray"; }
                    else if($memtix->status==3){ $memtix->status_name = 'Cancelled'; $memtix->class="label-danger"; }
                }

                foreach($members as $member){
                    $assigned_tix = Ticket::where('assignee', $member->id)->get();
                    $member->assigned_tix = count($assigned_tix);
                }

                return view('dashboard')->with('user', $user)
                    ->with('group', $group)
                    ->with('all_members', count($all_members))
                    ->with('members', $members)
                    ->with('all_assigned', $all_assigned)
                    ->with('all_unassigned', count($all_unassigned))
                    ->with('tickets', $tickets)
                    ->with('count_assigned', count($count_assigned));
            }
            else if($user->role==2)
            {
                $tickets = Ticket::where('assignee', NULL)->orderBy('created_at', 'DESC')->take(10)->get();
                $assigned_tickets = Ticket::where('assignee', $user->id)->orderBy('created_at', 'ASC')->take(10)->get();
                $all_unassigned = Ticket::where('assignee', NULL)->get();
                $all_assigned = Ticket::where('assignee', $user->id)->get();

                foreach ($tickets as $key => $ticket) {
                    $deptname = Department::find($ticket->dept_id)->pluck('dept_name');
                    $ticket->dept_name = $deptname;
                }

                foreach ($assigned_tickets as $key => $assigned_ticket) {
                    $deptname = Department::find($assigned_ticket->dept_id)->pluck('dept_name');
                    $assigned_ticket->dept_name = $deptname;
                    if($assigned_ticket->status==0){ $assigned_ticket->status_name = 'New'; $assigned_ticket->class="label-success"; }
                    else if($assigned_ticket->status==1){ $assigned_ticket->status_name = 'In Process'; $assigned_ticket->class="bg-teal"; }
                    else if($assigned_ticket->status==2){ $assigned_ticket->status_name = 'Pending'; $assigned_ticket->class="bg-gray"; }
                    else if($assigned_ticket->status==3){ $assigned_ticket->status_name = 'Cancelled'; $assigned_ticket->class="label-danger"; }
                }

                return view('dashboard')->with('user', $user)
                    ->with('tickets', $tickets)
                    ->with('assigned_tickets', $assigned_tickets)
                    ->with('all_assigned', count($all_assigned))
                    ->with('all_unassigned', count($all_unassigned));
            }
            else if($user->role==3)
            {
                Auth::logout();
                return redirect('/login');
            }
            else if($user->role==4)
            {
                $dept = Department::where('dept_rep', $user->id)->first();
                $new_tickets = Ticket::where('status', 0)->where('dept_id', $dept->id)->orderBy('created_at', 'DESC')->take(5)->get();
                $count_new_tickets = Ticket::where('status', 0)->where('dept_id', $dept->id)->get();
                $ongoing_tickets = Ticket::where('status', 1)->where('assignee', $user->id)->where('dept_id', $user->id)->take(5)->get();
                $count_ongoing_tickets = Ticket::where('status', 1)->where('assignee', $user->id)->where('dept_id', $user->id)->get();
                $closed_tickets = Ticket::where('status', 4)->where('assignee', $user->id)->where('dept_id', $user->id)->take(5)->get();
                $count_closed_tickets = Ticket::where('status', 4)->where('assignee', $user->id)->where('dept_id', $user->id)->get();
                return view('dashboard')->with('user', $user)
                    ->with('new_tickets', $new_tickets)
                    ->with('count_new_tickets', count($count_new_tickets))
                    ->with('ongoing_tickets', $ongoing_tickets)
                    ->with('count_ongoing_tickets', count($count_ongoing_tickets))
                    ->with('closed_tickets', $closed_tickets)
                    ->with('count_closed_tickets', count($count_closed_tickets));
            }
        }

        return $next($request);
    }
}
