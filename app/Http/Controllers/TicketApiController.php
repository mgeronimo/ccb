<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Department;
use App\Ticket;
use App\User;
use App\Mailers\AppMailer;
use Input;
use Image;
use Validator;
use App\Mailers\AppTicketSubmitted;
class TicketApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $id = Input::get('id');
        $tickets = Ticket::where('created_by', $id)->orderBy('created_at', 'DESC')->get();

        foreach ($tickets as $key => $ticket) {
            $ticket->agency = Department::where('id', $ticket->dept_id)->pluck('dept_name');
            $assignee = User::where('id', $ticket->assignee)->first();
            $ticket->assignee = $assignee['first_name']." ".$assignee['last_name'];
        }
        
        return response()->json(['data' => $this->transform($tickets)], 200);        
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
    public function store(Request $request, AppTicketSubmitted $mailer)
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
            'status'         => 1,
            'created_by'     => $request->input('user_id'),
            'complainee'     => $request->input('complainee')
        ]);

        $prev_ticket = Ticket::orderBy('id', 'DESC')->first();

        $prev_ticket->ticket_id = 'M'.date('Y').date('m').'-'.str_pad($prev_ticket->id, 5, 0, STR_PAD_LEFT);

        if(Input::file('file') != NULL){
            if(Input::file('file')->getSize()<2097152){
                $quality = 60;  
                $file=Input::file('file');
                $rand = rand(0, 1000);
                $orFile = $file->getClientOriginalName(); 
                $filename = $rand.$orFile;
                $img=Image::make($file);
                $path = 'uploads/' . $filename;
                //$img->resize(300, null, function ($constraint){$constraint->aspectRatio();});
                $img->save($path, $quality);
                $fphoto = 'uploads/'.$filename;

                //return 'uploaded';
            }
        }
        else $fphoto = '';

        $prev_ticket->attachments = $fphoto;

        $prev_ticket->save();
        $user = User::where('id',$request->input('user_id'))->first();
        //$mailer->sendSubmittedEmail($user);

        //Must send email to public user an email as notification regarding the ticket submitted
        
    
        return response()->json(['msg' => 'Ticket was successfully created!'], 200);
    }

    /**
     * Cancels the ticket
     *
     * @param  int  $id
     * @return Response
     */
    public function cancelTicket($id)
    {
        $userid = Input::get('user_id');
        $user = User::where('id', $userid)->first();
        $ticket = Ticket::where('id', $id)->first();

        if($user->role == 3 && $user->id == $ticket->created_by){
            $ticket->status = 4;
            $ticket->save();

            return response()->json(['msg' => 'Ticket was successfully cancelled!'], 200);
        }
        else return response()->json(['error' => 'You have no permission to cancel this ticket!'], 200);
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

    /**
     * Transforms department list
     *
     * @param  int  $id
     * @return Response
     */
    private function transform($tickets)
    {
        return array_map(function($tickets){
            return [
                'id'                    => $tickets['id'],
                'ticket_id'             => $tickets['ticket_id'],
                'incident_date_time'    => $tickets['incident_date_time'],
                'agency'                => $tickets['agency'],
                'complainee'            => $tickets['complainee'],
                'subject'               => $tickets['subject'],
                'incident_details'      => $tickets['message'],
                'status'                => $tickets['status'],
                'date'                  => $tickets['created_at'],
                'assignee'              => $tickets['assignee'],
                'attachment'            => $tickets['attachments'],
                'resolution'            => $tickets['resolution'],
                'updated_at'            => $tickets['updated_at']
            ];
        }, $tickets->toArray());
    }    
}
