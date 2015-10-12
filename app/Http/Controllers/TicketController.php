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
use App\Comment;
use Auth;
use App\Mailers\AppStatus;
use App\Mailers\AppAssigned;

class TicketController extends Controller
{
    public function __construct()
    {
        $this->middleware('notassign_agent', ['only' => 'show']);
        $this->middleware('auth');
    }
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
                $closed_tickets = Ticket::where('status', 5)->paginate(10);
            }
            else if($user->role == 1){
                $subs = User::where('role', 2)->where('agency_id', $user->agency_id)->lists('id');
                $inprocess_tickets = Ticket::where('status', 2)->whereIn('assignee', $subs)->paginate(10);
                $pending_tickets = Ticket::where('status', 3)->whereIn('assignee', $subs)->paginate(10);
                $closed_tickets = Ticket::where('status', 5)->whereIn('assignee', $subs)->paginate(10);
            }
            else if($user->role == 2){
                $inprocess_tickets = Ticket::where('status', 2)->where('assignee', $user->id)->paginate(10);
                $pending_tickets = Ticket::where('status', 3)->where('assignee', $user->id)->paginate(10);
                $closed_tickets = Ticket::where('status', 5)->where('assignee', $user->id)->paginate(10);
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
                ->with('closed_tickets', $closed_tickets)
                ->with('user', $user);
        }
    }

    /**
     * Displays list of all unassigned tickets.
     *
     * @return Response
     */
    public function unassignedTickets()
    {
        $user = Auth::user();

        if($user->role > 3)
            return redirect('/');
        else{
            $unassigned_tickets = Ticket::where('assignee', NULL)->where('status', 1)->orderBy('created_at', 'DESC')->paginate(20);
        }

        return view('tickets.unassigned')->with('user', $user)->with('unassigned_tickets', $unassigned_tickets);
    }

    /**
     * Displays list of all tickets in process.
     *
     * @return Response
     */
    public function inProcessTickets()
    {
        $user = Auth::user();

        if($user->role > 3)
            return redirect('/');
        else{
            $in_process_tickets = Ticket::where('status', 2)->orderBy('created_at', 'DESC')->paginate(20);
        }

        return view('tickets.in-process')->with('user', $user)->with('in_process_tickets', $in_process_tickets);
    }

    /**
     * Displays list of all pending tickets.
     *
     * @return Response
     */
    public function pendingTickets()
    {
        $user = Auth::user();

        if($user->role > 3)
            return redirect('/');
        else{
            $pending_tickets = Ticket::where('status', 3)->orderBy('created_at', 'DESC')->paginate(20);
        }

        return view('tickets.pending')->with('user', $user)->with('pending_tickets', $pending_tickets);
    }

    /**
     * Displays list of all closed tickets.
     *
     * @return Response
     */
    public function closedTickets()
    {
        $user = Auth::user();

        if($user->role > 3)
            return redirect('/');
        else{
            $closed_tickets = Ticket::where('status', 5)->orderBy('created_at', 'DESC')->paginate(20);
        }

        return view('tickets.closed')->with('user', $user)->with('closed_tickets', $closed_tickets);
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

        $log = Comment::create([
            'is_comment'        => 0,
            'comment'           => ' viewed this ticket.',
            'user_id'           => $user->id,
            'commenter_role'    => $user->role,
            'ticket_id'         => $id,
            'class'             => 'fa-search'
        ]);

        if($ticket->assignee==NULL){
            $agents = User::where('is_verified', 1)->where('role', 2)->get();
            $logs = Comment::where('ticket_id', $ticket->id)->where('is_comment', 0)->get();

            foreach($agents as $agent){
                $assigned_tix = Ticket::where('assignee', $agent->id)->get();
                $agent->assigned_tix = count($assigned_tix);
            }

            foreach ($logs as $key => $log) {
                $logger = User::where('id', $log->user_id)->first();
                $log->logger = $logger->first_name." ".$logger->last_name;
            }

            return view('tickets.show-ticket')
                ->with('user', $user)
                ->with('ticket', $ticket)
                ->with('dept', $dept)
                ->with('agents', $agents)
                ->with('statuses', $statuses)
                ->with('logs', $logs);
        }
        else{
            if($user->role == 2 && $ticket->assignee != $user->id)
                return redirect('tickets');
            $agent = User::where('id', $ticket->assignee)->first();
            $agency = Department::where('id', $agent->agency_id)->first();
            $comments = Comment::where('ticket_id', $ticket->id)->where('is_comment', 1)->orderBy('created_at', 'DESC')->get();
            $logs = Comment::where('ticket_id', $ticket->id)->where('is_comment', 0)->get();

            foreach ($comments as $key => $comment) {
                $commenter = User::where('id', $comment->user_id)->first();
                $comment->commenter = $commenter->first_name." ".$commenter->last_name;
            }

            foreach ($logs as $key => $log) {
                $logger = User::where('id', $log->user_id)->first();
                $log->logger = $logger->first_name." ".$logger->last_name;
            }

            return view('tickets.show-ticket')
                ->with('user', $user)
                ->with('ticket', $ticket)
                ->with('dept', $dept)
                ->with('agent', $agent)
                ->with('agency', $agency)
                ->with('statuses', $statuses)
                ->with('comments', $comments)
                ->with('logs', $logs);
        }
    }

    /**
     * Assigns an agent to ticket
     *
     * @param  int  $id, int  $agentid
     * @return Response
     */
    public function assign($id, $agentid, AppAssigned $mailer)
    {
        $user = Auth::user();
        $ticket = Ticket::where('id', $id)->first();
        $ticket->status = 2;
        $ticket->assignee = $agentid;
        $ticket->save();


        $created_by = User::where('id', $ticket->created_by)->first();
        //$mailer->sendStatus($created_by);

        if($user->id==$agentid) $assigned = 'self';
        else{
            $assigned = User::where('id', $agentid)->first();
            $assigned = $assigned->first_name.' '.$assigned->last_name;
        }

        $log = Comment::create([
            'is_comment'        => 0,
            'comment'           => ' assigned '.$assigned.' to this ticket.',
            'user_id'           => $user->id,
            'commenter_role'    => $user->role,
            'ticket_id'         => $id,
            'class'             => 'fa-user-plus'
        ]);
        
        $created_by = User::where('id', $ticket->created_by)->first();
        $mailer->sendStatus($created_by);


        return redirect()->back()->with('message', 'Successfully assigned agent to ticket!');
    } 

    /**
     * Assigns an agent to ticket
     *
     * @param  int  $id, int  $agentid
     * @return Response
     */
    public function changeStatus($id, $statid, AppAssigned $mailer)
    {
        $user = Auth::user();
        $ticket = Ticket::where('id', $id)->first();
        $assignee = User::where('id', $ticket->assignee)->first();
        $created_by = User::where('id', $ticket->created_by)->first();
        //$mailer->sendStatusChanged($created_by);
        $supervisor = User::where('role', 1)->where('agency_id', $assignee->agency_id)->first();

        /*
         * In Process
         */
        if($statid == 2){
            if($ticket->status == 5 && ($user->role == 0 || $user->id == $supervisor->id)){
                $ticket->status = $statid;
                $ticket->save();
                //email
                $status = 'Reopened ticket';
                //$mailer->sendStatusChanged($created_by);

                $log = Comment::create([
                    'is_comment'        => 0,
                    'comment'           => ' reopened ticket.',
                    'user_id'           => $user->id,
                    'commenter_role'    => $user->role,
                    'ticket_id'         => $id,
                    'class'             => 'fa-ticket'
                ]);

                //email
                $status = 'Reopened ticket';
                $mailer->sendStatusChanged($created_by);
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

                //email
                //$mailer->sendStatusChanged($created_by);

                $log = Comment::create([
                    'is_comment'        => 0,
                    'comment'           => ' of '.$dept->dept_name.' is now processing the ticket.',
                    'user_id'           => $user->id,
                    'commenter_role'    => $user->role,
                    'ticket_id'         => $id,
                    'class'             => 'fa-ticket'
                ]);


                //email
                $mailer->sendStatusChanged($created_by);
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
                    //email
                    //$mailer->sendStatusChanged($created_by);

                    $dept = Department::where('id', $ticket->dept_id)->first();

                    $log = Comment::create([
                        'is_comment'        => 0,
                        'comment'           => ' escalated the ticket to '.$dept->dept_name.'.',
                        'user_id'           => $user->id,
                        'commenter_role'    => $user->role,
                        'ticket_id'         => $id,
                        'class'             => 'fa-ticket'
                    ]);

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
                //email
                //$mailer->sendStatusChanged($created_by);

                $log = Comment::create([
                    'is_comment'        => 0,
                    'comment'           => ' cancelled the ticket.',
                    'user_id'           => $user->id,
                    'commenter_role'    => $user->role,
                    'ticket_id'         => $id,
                    'class'             => 'fa-ticket'
                ]);

                return redirect('tickets')->with('message', 'Successfully cancelled ticket!');
            }
            else return redirect('tickets')->with('error', "You have no permission to cancel this ticket!");
        }

        /*
         * Close
         */
        else if($statid==5){
            if($user->id == $ticket->assignee || $user->role < 2){
                $ticket->status = $statid;
                $ticket->save();
                //$mailer->sendStatusChanged($created_by);

                $log = Comment::create([
                    'is_comment'        => 0,
                    'comment'           => ' closed the ticket.',
                    'user_id'           => $user->id,
                    'commenter_role'    => $user->role,
                    'ticket_id'         => $id,
                    'class'             => 'fa-ticket'
                ]);

                return redirect('tickets')->with('message', 'Successfully closed ticket!');
            }
            else return redirect('tickets')->with('error', 'You have no permission to close this ticket!');
        }
        /*
         * Pending (Waiting for concerned agency)
         */
           else if($statid == 6){
            if($user->id == $ticket->assignee || $user->id == $supervisor->id){
                if($ticket->status == 2){
                    $ticket->status = 3;
                    $ticket->save();
                    //email
                    //$mailer->sendStatusChanged($created_by);
                     $log = Comment::create([
                    'is_comment'        => 0,
                    'comment'           => 'changed the status to waiting for concerned agency',
                    'user_id'           => $user->id,
                    'commenter_role'    => $user->role,
                    'ticket_id'         => $id,
                    'class'             => 'fa-ticket'
                ]);

                    return redirect('tickets')->with('message', 'Tickect is now waiting for the concerned agency');
                }
                return redirect('tickets')->with('error', 'Only tickets in process can be changed to this status .');
            }
            else return redirect()->back()->with('error', "You don't have the permission to changed this ticket status!");
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
