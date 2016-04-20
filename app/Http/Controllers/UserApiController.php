<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\Mailers\AppMailer;
use App\OauthAccessToken;
use App\OauthSession;
use Auth;
use Validator;
use Input;

class UserApiController extends Controller
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
            'email'         => 'required|email|unique:users,email',
            'password'      => 'required|min:6'
        ]);

        if ($validator->fails()) {
            return response()->json(['msg' => 'The email has already been taken'], 200);
        }

        $user = User::create([
            'first_name'     => $request->input('first_name'),
            'last_name'      => $request->input('last_name'),
            'email'          => $request->input('email'),
            'password'       => bcrypt($request->input('password')),
            'contact_number' => $request->input('contact_number'),
            'role'           => '3',
            'is_verified'    => '0',
            'gender'         => $request->input('gender'),
            'remember_token' => str_random(60)
        ]);

        /*
         * Sends email to user to confirm
         */
        $mailer->sendEmailConfirmationTo($user);
    
        return response()->json(['msg' => 'Success! You have been registered!'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show()
    {
        //$userId = Authorizer::getResourceOwnerId();
        $token = Input::get('token');
        $AccessToken = OauthAccessToken::find($token);
        if ( !$AccessToken) return 'none';

        $OauthSession = OauthSession::find($AccessToken->session_id);

        return response()->json(['id' => $OauthSession->owner_id], 200);
        //return $OauthSession->owner_id;
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
