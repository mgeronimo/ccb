<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\Group;
use App\Ticket;
use App\Department;
use App\Status;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $user = Auth::user();
        if($user->role==0){
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
        else if($user->role==1){
            $group = Group::where('id', $user->group_number)->first();
            $members = User::where('role', 2)->where('group_number', $user->group_number)->take(5)->get();
            $tickets = Ticket::where('assignee', NULL)->orderBy('created_at', 'DESC')->take(10)->get();
            $all_unassigned = Ticket::where('assignee', NULL)->get();
            $all_members = User::where('role', 2)->where('group_number', $user->group_number)->get();
            $all_assigned = DB::table('users as a')->join('tickets as b', 'a.id', '=', 'b.assignee')
                            ->where('a.role', 2)->where('a.group_number', $user->group_number)
                            ->groupBy('b.ticket_id')->take(5)->get();
            $count_assigned = DB::table('users as a')->join('tickets as b', 'a.id', '=', 'b.assignee')
                            ->where('a.role', 2)->where('a.group_number', $user->group_number)
                            ->groupBy('b.ticket_id')->get();

            foreach ($tickets as $key => $ticket) {
                $deptname = Department::find($ticket->dept_id)->pluck('dept_name');
                $ticket->dept_name = $deptname;
                /*if($memtix->status==0){ $memtix->status_name = 'New'; $memtix->class="label-success"; }
                else if($memtix->status==1){ $memtix->status_name = 'In Process'; $memtix->class="bg-teal"; }
                else if($memtix->status==2){ $memtix->status_name = 'Pending'; $memtix->class="bg-gray"; }
                else if($memtix->status==3){ $memtix->status_name = 'Cancelled'; $memtix->class="label-danger"; }*/
                $status = Status::where('id', $ticket->status)->first();
                $ticket->status_name = $status->status;
                $ticket->class = $status->class;
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
                $status = Status::where('id', $assigned_ticket->status)->first();
                $assigned_ticket->status_name = $status->status;
                $assigned_ticket->class = $status->class;
            }

            return view('dashboard')->with('user', $user)
                ->with('tickets', $tickets)
                ->with('assigned_tickets', $assigned_tickets)
                ->with('all_assigned', count($all_assigned))
                ->with('all_unassigned', count($all_unassigned));
        }
        else if($user->role==4){
            $dept = Department::where('dept_rep', $user->id)->first();
            $new_tickets = Ticket::where('status', 3)->where('dept_id', $dept->id)->orderBy('created_at', 'DESC')->take(5)->get();
            $count_new_tickets = Ticket::where('status', 3)->where('dept_id', $dept->id)->get();
            $ongoing_tickets = Ticket::where('status', 2)->where('assignee', $user->id)->where('dept_id', $user->id)->take(5)->get();
            $count_ongoing_tickets = Ticket::where('status', 2)->where('assignee', $user->id)->where('dept_id', $user->id)->get();
            $closed_tickets = Ticket::where('status', 5)->where('assignee', $user->id)->where('dept_id', $user->id)->take(5)->get();
            $count_closed_tickets = Ticket::where('status', 5)->where('assignee', $user->id)->where('dept_id', $user->id)->get();
            return view('dashboard')->with('user', $user)
                ->with('new_tickets', $new_tickets)
                ->with('count_new_tickets', count($count_new_tickets))
                ->with('ongoing_tickets', $ongoing_tickets)
                ->with('count_ongoing_tickets', count($count_ongoing_tickets))
                ->with('closed_tickets', $closed_tickets)
                ->with('count_closed_tickets', count($count_closed_tickets));
        }
    }

}
