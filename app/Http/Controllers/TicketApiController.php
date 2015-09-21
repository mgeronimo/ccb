<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Ticket;
use App\Mailers\AppMailer;
use Validator;

class TicketApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
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
    public function store(Request $request, AppMailer $mailer)
    {
        $validator = Validator::make($request->all(), [
            'date_time'     => 'required',
            'agency'        => 'required',
            'subject'       => 'required|max:160',
            'incident_details'  =>  'required|max:255'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 200);
        }

        $ticket = Ticket::create([
            //'created_at'     => $request->input('date_time'),
            'incident_date_time'     => $request->input('date_time'),
            'subject'        => $request->input('subject'),
            'dept_id'        => $request->input('agency'),
            'message'        => $request->input('incident_details'),
            'status'         => 0,
            'created_by'     => $request->input('user_id'),
            'complainee'     => $request->input('complainee')
        ]);

        $prev_ticket = Ticket::orderBy('id', 'DESC')->first();

        $prev_ticket->ticket_id = 'M'.date('Y').date('m').'-'.str_pad($prev_ticket->id, 5, 0, STR_PAD_LEFT);
        $prev_ticket->save();

        //Must send email to public user an email as notification regarding the ticket submitted
    
        return response()->json(['msg' => 'Ticket was successfully created!'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
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
