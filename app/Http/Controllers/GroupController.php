<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

use App\Mailers\AppMailer;

use Mail;
use App\Group;
use App\User;
use App\Ticket;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Input;
use Validator;
use App\Http\Requests\CreateUserRequest;


class GroupController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');

    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $user = Auth::user();
        $groups = Group::all();
        foreach ($groups as $key => $group) {
            $supervisor = User::where('role', 1)->where('is_verified', 1)->where('group_number', $group->id)->first();
            $group->supervisor = $supervisor->first_name." ".$supervisor->last_name;
        }
        return view('admin.group.groups')->with('user', $user)
            ->with('groups', $groups);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function addGroup()
    {
        $user = Auth::user();
        return view('admin.addgroup')->with('user', $user);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    
    public function storeGroup(Request $request, AppMailer $mailer)
    {
        //return $request->all();

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
        $user = Auth::user();
        $group = Group::find($id);

        return view('admin.group.edit-group')->with('user', $user)->with('group', $group);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($request->all(), [
            'group_name'     => 'required|max:45|unique:groups,group_name',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
            //dd($validator->errors());
        }

        $group = Group::where('id', $input['group'])->first();
        $group->group_name = $input['group_name'];
        $group->save();

        return redirect('/groups')->with('message', 'Successfully changed group name.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $to_delete = 0;
        $group = Group::where('id', $id)->first();
        $members = User::where('group_number', $group->id)->get();

        if($group==NULL)
            return redirect()->back()->with('error', 'Group not existing!');

        foreach($members as $member){
            $assigned = Ticket::where('assignee', $member->id)->get();
            if(count($assigned)>0){
                $to_delete = 1;
                break;
            }
        }

        if($to_delete==0){
            $group->delete();
            return redirect()->back()->with('message', 'Group successfully deleted.');
        }
        else return redirect()->back()->with('error', 'Group cannot be deleted. There are tickets associated with this group.');

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

    /**
     * Save additional agent to group
     *
     * @param  int  $id
     * @return Response
     */
    public function saveAddedAgent(Request $request, $id, AppMailer $mailer)
    {
        $group = Group::find($id);
        $user = Auth::user();

        $input = $request->all();
        /*$validator = Validator::make($request->all(), [
            'email'         => 'required|email|unique:users,email',
        ]);
        //dd($agents);
        if ($validator->fails()) {
            return $validator->errors()->all();
        }

        $validator = Validator::make($request->all(), [
            'email'         => 'required|email|unique:users,email',
        ]);
        //dd($agents);*
        if ($validator->fails()) {
            return $validator->errors()->all();
        }*/
/*
        $agent = new User;
        $agent->first_name = $agents['first_name'];
        $agent->last_name = $agents['last_name'];
        $agent->email = $agents['email'];
        $agent->group_number = $id;
        $agent->role = 2;
        $agent->save();
*/
            $agentlimit = count($input['first_name']);
            for($i=0; $i<$agentlimit; $i++){
           /* $duplicate = User::where('email', $input['email'][$i])->get();

            if(count($duplicate)) return back()->withInput()->with('message', 'Email not unique');*/

            $agent = new User;
            $agent->first_name = $input['first_name'][$i];
            $agent->last_name = $input['last_name'][$i];
            $agent->email = $input['email'][$i];
            $agent->group_number = $id;
            $agent->role = 2;
            $agent->save();
            $mailer->sendEmailConfirmationTo($agent);    

        }
      
        return redirect('/group/'.$id)->with('message', 'Agent successfully added!');

        //return view('admin.group.add-agent')->with('group', $group)->with('user', $user);
    }

    /**
     * Validates group name
     *
     * @param  int  $id
     * @return Response
     */
    public function validateGroup()
    {
        $validate = null;
        $input = trim(Input::get('groupname'));

        $validate = Group::where('group_name', $input)->get();
        
        if(count($validate)) return 'failed';
        else if($input=="") return 'whitespace';
        else return 'passed';
    }

    /**
     * Validates supervisor details
     *
     * @param  int  $id
     * @return Response
     */
    public function validateSupervisorAgent($counter)
    {
        $validate = null;
        /*
            $sfirstname = trim(Input::get('sfirstname'));
            $slastname = trim(Input::get('slastname'));
            $sEmail = trim(Input::get('sEmail'));


            if($sfirstname=="")return 'spacefirst';
            if($slastname=="") return 'spacelast';
            if($sEmail=="") return 'spaceemail';
        */
        if($counter==1) $email = trim(Input::get('sEmail'));
        else $email = trim(Input::get('agentemail'));
        $validate = User::where('email', $email)->get();
        
        if(count($validate)) return 'failed';
        else return 'passed';
    }
}
