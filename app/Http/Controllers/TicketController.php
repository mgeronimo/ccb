<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Department;
use App\Ticket;
use App\User;
use App\Group;
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
        $unassigned_tickets = Ticket::where('assignee', NULL)->where('status', 0)->orderBy('created_at', 'DESC')->paginate(20);
        $inprocess_tickets = Ticket::where('status', 1)->paginate(10);

        foreach ($unassigned_tickets as $key => $uticket) {
            $deptname = Department::find($uticket->dept_id)->pluck('dept_name');
            $uticket->dept_name = $deptname;
        }

        foreach ($inprocess_tickets as $key => $iticket) {
            $deptname = Department::find($iticket->dept_id)->pluck('dept_name');
            $iticket->dept_name = $deptname;
        }


        return view('tickets.all-tickets')->with('unassigned_tickets', $unassigned_tickets)->with('inprocess_tickets', $inprocess_tickets)->with('user', $user);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
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
        if($ticket->assignee==NULL){
            $agents = User::where('is_verified', 1)->where('role', 2)->get();
            return view('tickets.show-ticket')
                ->with('user', $user)
                ->with('ticket', $ticket)
                ->with('dept', $dept)
                ->with('agents', $agents);
        }
        else{
            $agent = User::where('id', $ticket->assignee)->firstOrFail();
            $group = Group::where('id', $agent->group_number)->firstOrFail();
            return view('tickets.show-ticket')
                ->with('user', $user)
                ->with('ticket', $ticket)
                ->with('dept', $dept)
                ->with('agent', $agent)
                ->with('group', $group);
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
        $ticket->assignee = $agentid;
        $ticket->save();
        
        return redirect()->back()->with('message', 'Successfully assigned agent to ticket!');
    }    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
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