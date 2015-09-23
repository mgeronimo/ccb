<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Department;
use App\Ticket;
use App\User;
use App\Group;
use App\Status;
use Auth;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $user = Auth::user();

        if($user->role > 3)
            return redirect('/');
        else{
            $unassigned_tickets = Ticket::where('assignee', NULL)->where('status', 1)->orderBy('created_at', 'DESC')->paginate(20);
            
            if($user->role == 0){
                $inprocess_tickets = Ticket::where('status', 2)->paginate(10);
                $pending_tickets = Ticket::where('status', 3)->paginate(10);    
            }
            else if($user->role == 1){
                $subs = User::where('role', 2)->where('group_number', $user->group_number)->lists('id');
                $inprocess_tickets = Ticket::where('status', 2)->whereIn('assignee', $subs)->paginate(10);
                $pending_tickets = Ticket::where('status', 3)->whereIn('assignee', $subs)->paginate(10);
            }
            else if($user->role == 2){
                $inprocess_tickets = Ticket::where('status', 2)->where('assignee', $user->id)->paginate(10);
                $pending_tickets = Ticket::where('status', 3)->where('assignee', $user->id)->paginate(10);
            }

            foreach ($unassigned_tickets as $key => $uticket) {
                $deptname = Department::find($uticket->dept_id)->pluck('dept_name');
                $uticket->dept_name = $deptname;
            }

            foreach ($inprocess_tickets as $key => $iticket) {
                $deptname = Department::find($iticket->dept_id)->pluck('dept_name');
                $iticket->dept_name = $deptname;
            }

            foreach ($pending_tickets as $key => $pticket) {
                $deptname = Department::find($pticket->dept_id)->pluck('dept_name');
                $pticket->dept_name = $deptname;
            }

            return view('tickets.all-tickets')->with('unassigned_tickets', $unassigned_tickets)
                ->with('inprocess_tickets', $inprocess_tickets)
                ->with('pending_tickets', $pending_tickets)
                ->with('user', $user);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $user = Auth::user();
        $ticket = Ticket::where('id', $id)->first();
        $dept = Department::find($ticket->dept_id)->first();
        $ticket->status_name = Status::where('id', $ticket->status)->pluck('status');
        $ticket->class = Status::where('id', $ticket->status)->pluck('class');

        $statuses = Status::where('id', '!=', $ticket->status)->get();

        if($ticket->assignee==NULL){
            $agents = User::where('is_verified', 1)->where('role', 2)->get();
            foreach($agents as $agent){
                $assigned_tix = Ticket::where('assignee', $agent->id)->get();
                $agent->assigned_tix = count($assigned_tix);
            }
            return view('tickets.show-ticket')
                ->with('user', $user)
                ->with('ticket', $ticket)
                ->with('dept', $dept)
                ->with('agents', $agents)
                ->with('statuses', $statuses);
        }
        else{
            if($user->role == 2 && $ticket->assignee != $user->id)
                return redirect('tickets');
            $agent = User::where('id', $ticket->assignee)->first();
            $group = Group::where('id', $agent->group_number)->first();
            return view('tickets.show-ticket')
                ->with('user', $user)
                ->with('ticket', $ticket)
                ->with('dept', $dept)
                ->with('agent', $agent)
                ->with('group', $group)
                ->with('statuses', $statuses);
        }
    }

    /**
     * Assigns an agent to ticket
     *
     * @param  int  $id, int  $agentid
     * @return Response
     */
    public function assign($id, $agentid)
    {
        $user = Auth::user();
        $ticket = Ticket::where('id', $id)->first();
        $ticket->status = 2;
        $ticket->assignee = $agentid;
        $ticket->save();
        
        return redirect()->back()->with('message', 'Successfully assigned agent to ticket!');
    } 

    /**
     * Assigns an agent to ticket
     *
     * @param  int  $id, int  $agentid
     * @return Response
     */
    public function changeStatus($id, $statid)
    {
        $user = Auth::user();
        $ticket = Ticket::where('id', $id)->first();
        $assignee = User::where('id', $ticket->assignee)->first();

        $supervisor = User::where('role', 1)->where('group_number', $assignee->group_number)->first();

        /*
         * In Process
         */
        if($statid == 2){
            if($ticket->status == 5 && ($user->role == 0 || $user->id == $supervisor->id)){
                $ticket->status = $statid;
                $ticket->save();

                return redirect('tickets')->with('message', 'Successfully reopened ticket!');
            }
            else if($ticket->status != 5 && ($user->role == 0 || $user->id == $supervisor->id)){
                return redirect()->back()->with('error', 'The ticket you are reopening is not closed in the first place!');
            }
            else if($ticket->status == 3 && $user->role == 4){
                $ticket->status = $statid;

                $dept = Department::where('id', $ticket->dept_id)->first();
                $deptrep = User::where('id', $dept->dept_rep)->first();
                $ticket->assignee = $deptrep->id;

                $ticket->save();

                return redirect()->back()->with('message', 'Ticket now in process.');                
            }
            else return redirect()->back()->with('error', "You don't have the permission to reopen a ticket!");
        }

        /*
         * Pending (Escalated)
         */
        else if($statid == 3){
            if($user->id == $ticket->assignee || $user->id == $supervisor->id){
                if($ticket->status == 2){
                    $ticket->status = $statid;
                    $ticket->save();

                    return redirect('tickets')->with('message', 'Successfully escalated ticket to department representative!');
                }
                return redirect('tickets')->with('error', 'This ticket cannot be escalated. Only tickets in process can be escalated.');
            }
            else return redirect()->back()->with('error', "You don't have the permission to escalate this ticket!");
        }

        /*
         * Cancel
         */
        else if($statid==4){
            if($user->role == 0){
                $ticket->status = $statid;
                $ticket->save();

                return redirect('tickets')->with('message', 'Successfully cancelled ticket!');
            }
            else return redirect('tickets')->with('error', "You have no permission to cancel this ticket!");
        }

        /*
         * Close
         */
        else if($statid==5){
            if($user->id == $ticket->assignee){
                $ticket->status = $statid;
                $ticket->save();

                return redirect('tickets')->with('message', 'Successfully closed ticket!');
            }
            else return redirect('tickets')->with('error', 'You have no permission to close this ticket!');
        }

    }    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
