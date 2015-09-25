<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Input;
use Validator;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Comment;
use App\User;

class CommentController extends Controller
{
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

        $comment = Comment::create([
            'comment'           => $request->input('ticket_comment'),
            'user_id'           => $user->id,
            'commenter_role'    => $user->role,
            'ticket_id'         => $id
        ]);

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

        $comment = Comment::create([
            'comment'           => $request->input('ticket_comment'),
            'user_id'           => $user->id,
            'commenter_role'    => $user->role,
            'ticket_id'         => $id
        ]);

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
}
