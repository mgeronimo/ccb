<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

use App\Mailers\AppMailer;

use Mail;
use App\Group;
use App\User;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $user = Auth::user();
        return view('admin.addgroup')->with('user', $user);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    
    public function storegroup(Request $request, AppMailer $mailer)
    {
        $group = new Group;
        $user = new User;

        //Saves group name
        $group->group_name = $request->input('groupname');
        $group->save();

        //Saves supervisor
        $input = $request->all();
        $user->first_name = $input['sfirstname'];
        $user->last_name = $input['slastname'];
        $user->email = $input['sEmail'];
        $user->role = 1;
        $groups = Group::where('group_name', $group->group_name)->firstOrFail();
        $groups->users()->save($user);
        $mailer->sendEmailConfirmationTo($user);    
      
       

        //Saves agent
        $agent = count($input['agentfname']);
        for($i=0; $agent > $i; $i++)
        {  
            $agentuser = new User;
            $agentuser->first_name = $input['agentfname'][$i];
            $agentuser->last_name =$input['agentlname'][$i];
            $agentuser->email = $input['agentemail'][$i];
            $agentuser->role = 2;
            $groups = Group::where('group_name', $group->group_name)->firstOrFail();
            $groups->users()->save($agentuser);
            $mailer->sendEmailConfirmationTo($agentuser);    

          
        }
      
        return redirect('/')->with('message', 'Group successfully added.');
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
        $group = Group::find($id);
        $user = Auth::user();
        $supervisor = User::where('role', 1)->where('group_number', $group->id)->firstOrFail();
        $agents = User::where('role', 2)->where('group_number', $group->id)->get();

        return view('admin.group.show-group')->with('group', $group)->with('user', $user)->with('supervisor', $supervisor)->with('agents', $agents);
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
     * Add agent to group
     *
     * @param  int  $id
     * @return Response
     */
    public function addAgent($id)
    {
        $group = Group::find($id);
        $user = Auth::user();

        return view('admin.group.add-agent')->with('group', $group)->with('user', $user);
    }
}
