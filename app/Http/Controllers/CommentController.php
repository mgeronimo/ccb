<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Input;
use Image;
use Validator;
use App\Ticket;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Comment;
use App\User;
use App\Ticket;

class CommentController extends Controller
{
    /**
     * Fetch all comments
     *
     * @param  int  $id
     * @return Response
     */
    public function index($id)
    {
        $comments = Comment::where('ticket_id', $id)->where('is_comment', 1)->orderBy('created_at', 'DESC')->get();
        foreach ($comments as $key => $comment) {
            $commenter = User::where('id', $comment->user_id)->first();
            $comment->commenter = $commenter->first_name." ".$commenter->last_name;
        }

        return response()->json(['data' => $this->transform($comments)], 200);        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request, $id)
    {
        $user = Auth::user();
        $validator = Validator::make($request->all(), [
            'ticket_comment'     => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }

        if(Input::file('attachment') != NULL){
            if(Input::file('attachment')->getSize()<2097152){
                $quality = 60;  
                $file=Input::file('attachment');
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

        $comment = Comment::create([
            'is_comment'        => 1,
            'comment'           => $request->input('ticket_comment'),
            'user_id'           => $user->id,
            'commenter_role'    => $user->role,
            'ticket_id'         => $id,
            'attachment'        => $fphoto
        ]);

        $log = Comment::create([
            'is_comment'        => 0,
            'comment'           => ' commented on this ticket.',
            'user_id'           => $user->id,
            'commenter_role'    => $user->role,
            'ticket_id'         => $id,
            'class'             => 'fa-comment'
        ]);
        $ticket = Ticket::where('id',$id)->first();
        if($ticket->status==3)
        {
            $ticket->status = 2;
            $ticket->save();
            $log = Comment::create([
                    'is_comment'        => 0,
                    'comment'           => $user->name.' is now processing the ticket.',
                    'user_id'           => $user->id,
                    'commenter_role'    => $user->role,
                    'ticket_id'         => $id,
                    'class'             => 'fa-ticket'
                ]);


        }
        return redirect()->back()->with('message', 'Comment successfully sent!');
    }

    /**
     * Store comment submitted through the mobile app
     *
     * @param  int  $id
     * @return Response
     */
    public function storeFromApp(Request $request, $id)
    {
        $userid = Input::get('user_id');
        $user = User::where('id', $userid)->first();

        $validator = Validator::make($request->all(), [
            'ticket_comment'     => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 200);
        }

        if(Input::file('attachment') != NULL){
            if(Input::file('attachment')->getSize()<2097152){
                $quality = 60;  
                $file=Input::file('attachment');
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

        $comment = Comment::create([
            'is_comment'        => 1,
            'comment'           => $request->input('ticket_comment'),
            'user_id'           => $user->id,
            'commenter_role'    => $user->role,
            'ticket_id'         => $id,
            'attachment'        => $fphoto
        ]);

        $log = Comment::create([
            'is_comment'        => 0,
            'comment'           => ' commented on this ticket.',
            'user_id'           => $user->id,
            'commenter_role'    => $user->role,
            'ticket_id'         => $id,
            'class'             => 'fa-comment'
        ]);

        $ticket = Ticket::where('id', $id)->first();
        if($ticket->status ==3){
            $ticket->status = 2;
            $ticket->save();

            $log = Comment::create([
                'is_comment'        => 0,
                'comment'           => ' has responded so the ticket status was brought back to "In Process".',
                'user_id'           => $user->id,
                'commenter_role'    => $user->role,
                'ticket_id'         => $id,
                'class'             => 'fa-ticket'
            ]);
        }

        return response()->json(['msg' => 'Comment was successfully submitted!'], 200);
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
     * Transforms comment list
     *
     * @param  int  $id
     * @return Response
     */
    private function transform($comments)
    {
        return array_map(function($comments){
            return [
                'id'                => $comments['id'],
                'is_comment'        => $comments['is_comment'],
                'comment'           => $comments['comment'],
                'user_id'           => $comments['user_id'],
                'commenter_role'    => $comments['commenter_role'],
                'created_at'        => $comments['created_at'],
                'ticket_id'         => $comments['ticket_id'],
                'attachment'        => $comments['attachment']
            ];
        }, $comments->toArray());
    } 
}
