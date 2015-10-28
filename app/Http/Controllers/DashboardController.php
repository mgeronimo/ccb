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
            $tickets = Ticket::where('assignee', NULL)->orderBy('created_at', 'DESC')->take(10)->get();
            $depts = Department::orderby('dept_name')->take(5)->get();
            $unassigned_tickets = Ticket::where('assignee', NULL)->get();

            $closed_tickets = Ticket::where('status', 5)->get();
            $ongoing_tickets = Ticket::where('status', 2)->get();
            $pending_tickets = Ticket::where('status', 3)->orWhere('status', 7)->get();
            $cancelled_tickets = Ticket::where('status', 4)->get();
            $all_depts = Department::orderby('dept_name')->get();

            foreach ($depts as $key => $dept) {
                $deptrep = User::where('agency_id', $dept->id)->where('role', 4)->first();
                if($deptrep!=NULL)
                    $dept->deptrep_name = $deptrep->first_name." ".$deptrep->last_name;
                else $dept->deptrep_name = "None";
            }

            foreach ($tickets as $key => $ticket) {
                $deptname = Department::find($ticket->dept_id)->pluck('dept_name');
                $ticket->dept_name = $deptname;
            }

            return view('dashboard')->with('user', $user)
                ->with('tickets', $tickets)
                ->with('all_unassigned', count($unassigned_tickets))
                ->with('closed_tickets', count($closed_tickets))
                ->with('ongoing_tickets', count($ongoing_tickets))
                ->with('pending_tickets', count($pending_tickets))
                ->with('cancelled_tickets', count($cancelled_tickets))
                ->with('depts', $depts)
                ->with('all_depts', count($all_depts));
        }
        else if($user->role==1){
            $members = User::where('role', 2)->where('agency_id', $user->agency_id)->take(5)->get();
            //$all_members = User::where('role', 2)->where('agency_id', $user->agency_id)->get();

            if($user->agency_id==0){
                $tickets = Ticket::where('assignee', NULL)->where('status', 1)->orderBy('created_at', 'DESC')->take(10)->get();
                $all_unassigned = Ticket::where('assignee', NULL)->where('status', 1)->get();
            }
            else{
                $tickets = Ticket::where('assignee', NULL)->where('status', 2)->where('dept_id', $user->agency_id)->orderBy('created_at', 'DESC')->take(10)->get();
                $all_unassigned = Ticket::where('assignee', NULL)->where('status', 2)->where('dept_id', $user->agency_id)->get();
            }

            $all_assigned = DB::table('users as a')->join('tickets as b', 'a.id', '=', 'b.assignee')
                        ->where('a.role', 2)->where('a.agency_id', $user->agency_id)
                        ->groupBy('b.ticket_id')->take(5)->get();
            $count_assigned = DB::table('users as a')->join('tickets as b', 'a.id', '=', 'b.assignee')
                        ->where('a.role', 2)->where('a.agency_id', $user->agency_id)
                        ->groupBy('b.ticket_id')->get();

            $all_members = User::where('role', 2)->where('agency_id', $user->agency_id)->lists('id');
            $all_members[count($all_members)] = $user->id;

            $ongoing_tickets = Ticket::whereIn('assignee', $all_members)->where('status', 2)->get();
            $closed_tickets = Ticket::whereIn('assignee', $all_members)->where('status', 5)->get();
            $cancelled_tickets = Ticket::whereIn('assignee', $all_members)->where('status', 4)->get();
            $pending_tickets = Ticket::whereIn('assignee', $all_members)->where(function($query){
                $query->where('status', 3);
                $query->orWhere('status', 7);
            })->get();

            foreach ($tickets as $key => $ticket) {
                $deptname = Department::find($ticket->dept_id)->pluck('dept_name');
                $ticket->dept_name = $deptname;
                $status = Status::where('id', $ticket->status)->first();
                $ticket->status_name = $status->status;
                $ticket->class = $status->class;
            }

            foreach($members as $member){
                $assigned_tix = Ticket::where('assignee', $member->id)->get();
                $member->assigned_tix = count($assigned_tix);
            }

            return view('dashboard')->with('user', $user)
                //->with('group', $group)
                ->with('all_members', count($all_members))
                ->with('members', $members)
                ->with('all_assigned', $all_assigned)
                ->with('all_unassigned', count($all_unassigned))
                ->with('tickets', $tickets)
                ->with('count_assigned', count($count_assigned))
                ->with('closed_tickets', count($closed_tickets))
                ->with('ongoing_tickets', count($ongoing_tickets))
                ->with('pending_tickets', count($pending_tickets))
                ->with('cancelled_tickets', count($cancelled_tickets));
        }
        else if($user->role==2)
        {
            if($user->agency_id==0){
                $tickets = Ticket::where('assignee', NULL)->where('status', 1)->orderBy('created_at', 'DESC')->take(10)->get();
                $all_unassigned = Ticket::where('assignee', NULL)->where('status', 1)->get();
            }
            else{
                $tickets = Ticket::where('assignee', NULL)->where('status', 2)->orderBy('created_at', 'DESC')->take(10)->get();
                $all_unassigned = Ticket::where('assignee', NULL)->where('status', 2)->get();
            }

            $assigned_tickets = Ticket::where('assignee', $user->id)->orderBy('created_at', 'ASC')->take(10)->get();
            $all_assigned = Ticket::where('assignee', $user->id)->get();

            $ongoing_tickets = Ticket::where('status', 2)->where('assignee', $user->id)->get();
            $closed_tickets = Ticket::where('status', 5)->where('assignee', $user->id)->get();
            $pending_tickets = Ticket::where('status', 3)->orWhere('status', 7)->where('assignee', $user->id)->get();
            $cancelled_tickets = Ticket::where('status', 4)->where('assignee', $user->id)->get();

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
                ->with('all_unassigned', count($all_unassigned))
                ->with('closed_tickets', count($closed_tickets))
                ->with('ongoing_tickets', count($ongoing_tickets))
                ->with('pending_tickets', count($pending_tickets))
                ->with('cancelled_tickets', count($cancelled_tickets));
        }
        else if($user->role==4){
            $dept = Department::where('id', $user->agency_id)->first();
            $new_tickets = Ticket::where('status', 3)->where('dept_id', $dept->id)->orderBy('created_at', 'DESC')->take(5)->get();
            $count_new_tickets = Ticket::where('status', 3)->where('dept_id', $dept->id)->get();
            $ongoing_tickets = Ticket::where('status', 2)->where('assignee', $user->id)->where('dept_id', $dept->id)->take(5)->get();
            $count_ongoing_tickets = Ticket::where('status', 2)->where('assignee', $user->id)->where('dept_id', $dept->id)->get();
            $closed_tickets = Ticket::where('status', 5)->where('assignee', $user->id)->where('dept_id', $dept->id)->take(5)->get();
            $count_closed_tickets = Ticket::where('status', 5)->where('assignee', $user->id)->where('dept_id', $dept->id)->get();
            $count_pending_tickets = Ticket::where('status', 3)->orWhere('status', 7)->where('assignee', $user->id)->where('dept_id', $dept->id)->get();
            return view('dashboard')->with('user', $user)
                ->with('new_tickets', $new_tickets)
                ->with('all_unassigned', count($count_new_tickets))
                ->with('show_ongoing_tickets', $ongoing_tickets)
                ->with('ongoing_tickets', count($count_ongoing_tickets))
                ->with('show_closed_tickets', $closed_tickets)
                ->with('closed_tickets', count($count_closed_tickets))
                ->with('pending_tickets', count($count_pending_tickets));
        }
    }
}
