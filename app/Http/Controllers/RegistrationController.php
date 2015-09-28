<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Mailers\AppMailer;
use App\User;


class RegistrationController extends Controller
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

    /**
     * Process account confirmation through link clicked from the email
     *
     * @param  int  $token
     * @return Response
     */
    public function confirmEmail($token)
    {
        $user = User::where('token', $token)->firstOrFail();
        return view('registration.registerconfirm')->with('user', $user);     
    }
     public function confirmRegister($token, Request $request)
    {
        $input = $request->all();
        $user = User::where('token', $token)->firstOrFail();
        $user->username = $input['username'];
        $user->password = bcrypt($input['password']);
        $user->contact_number = $input['contact_number'];
        $user->is_verified = 1;
        $user->token = null;
        $user->update();
        return redirect('/login');     
    }
     public function confirmPublic($token)
    {
        $user = User::where('token', $token)->firstOrFail();
        $user->is_verified = true;
        $user->token = null;
        $user->save();
        return redirect()->away('http://contactcenterngbayan.gov.ph');     
    }



        
}
