<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Mailers\AppMailer;
use Mail;

use App\Group;
use App\User;
use App\Departments;
use App\Http\Requests;
use App\Http\Controllers\Controller;
class DashboardAdminController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth');
     /*   $this->middleware('login');*/
        $this->middleware('admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        /*$users = User::all();
        foreach ($users as $key => $user) {
            var_dump($user);
        }
        dd(count($users));*/

        $user = Auth::user();
        $groups = Group::orderBy('group_name')->get();
        //return $groups;
                foreach ($groups as $key => $group) {
                   $supervisor = User::where('group_number', $group->id)
                                ->where('role', 1)->first();
                   $group->supervisor = $supervisor->first_name." ".$supervisor->last_name;
                   }
        return view('admin.dashboard-admin')->with('user', $user)->with('groups', $groups);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function addgroup()
    {
        //
        $user = Auth::user();
        return view('admin.addgroup')->with('user', $user);
    }
    public function storegroup(Request $request)
    {
        //
        $group = new Group;
        $user = new User;
        $group->group_name = $request->input('groupname');
        $group->save();
        $input = $request->all();
        $user->first_name = $input['sfirstname'];
        $user->last_name = $input['slastname'];
        $user->email = $input['sEmail'];
        $groups = Group::where('group_name', $group->group_name)->firstOrFail();
        $groups->users()->save($user);
        //$user->save();
       // $agentuser = new User;

        $agent = count($input['agentfname']);
        for($i=0; $agent > $i; $i++)
        {  
            $agentuser = new User;
            $agentuser->first_name = $input['agentfname'][$i];
            $agentuser->last_name =$input['agentlname'][$i];
            $agentuser->email = $input['agentemail'][$i];
            $groups = Group::where('group_name', $group->group_name)->firstOrFail();
            $groups->users()->save($agentuser);
          
        }

      
        return redirect('/admin');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function show()
    {
        //
        $user = Auth::user();
        return view('admin.adddept')->with('user', $user);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function addDept(Request $request,  AppMailer $mailer)

    {
        //
        $user = new User;
        $department = new Departments;

        $input = $request->all();
        $user->first_name = $input['firstname'];
        $user->last_name = $input['lastname'];
        $user->email = $input['email'];
        $user->role = 4;
        $user->save();
        $department->dept_name = $input['dept_name'];
        $department->is_national = $input['is_national'];
        $department->description = $input['description'];
        $dep_id = User::where('email', $user->email)->firstorFail();
        $dep_id->departments()->save($department);
        $mailer->sendEmailConfirmationTo($user);
        return redirect('/')->with('message', 'Department Successfully added.');
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
