<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Validator;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;
use App\Group;
use App\Department;
use App\Ticket;

class UserController extends Controller
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
        $supervisors = User::where('role', 1)->get();
        $agents = User::where('role', 2)->get();

        foreach ($supervisors as $key => $supervisor) {
            if($supervisor->agency_id==0) $supervisor->agency = "CCB";
            else{
                $agency = Department::where('id', $supervisor->agency_id)->first();
                $supervisor->agency = $agency->dept_name;
            }
        }

        foreach ($agents as $key => $agent) {
            if($agent->agency_id==0) $agent->agency = "CCB";
            else{
                $agency = Department::where('id', $agent->agency_id)->first();
                $agent->agency = $agency->dept_name;
            }
        }

        return view('admin.user.users')->with('user', $user)
            ->with('supervisors', $supervisors)
            ->with('agents', $agents);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $user = Auth::user();
        $agencies = Department::lists('dept_name', 'id')->toArray();

        return view('admin.user.add-user')->with('user', $user)->with('agencies', $agencies);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $input = $request->all();

        $user = new User;
        $user->first_name = $input['first_name'];
        $user->last_name = $input['last_name'];
        $user->email = $input['email'];
        $user->agency_id = $input['agency_id'];
        $user->role = $input['role'];
        $user->save();

        return redirect('/')->with('message', 'Successfully created user!');
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
        $user = Auth::user();
        $agencies = Department::lists('dept_name', 'id')->toArray();

        if($id>1){
            $update_user = User::where('id', $id)->first();

            return view('admin.user.edit-user')->with('user', $user)->with('update_user', $update_user)->with('agencies', $agencies);
        }
        return redirect('users')->with('error', 'Administrator details cannot be edited.');
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
            'first_name'     => 'required|max:255',
            'last_name'      => 'required|max:255',
            'email'          => 'required|max:255|unique:users,email',
            'agency_id'      => 'required',
            'role'           => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }

        $update_user = User::where('id', $input['user'])->first();
        $update_user->first_name = $input['first_name'];
        $update_user->last_name = $input['last_name'];
        $update_user->email = $input['email'];
        $update_user->agency_id = $input['agency_id'];
        $update_user->role = $input['role'];

        $update_user->save();

        return redirect('/users')->with('message', 'Successfully changed user details.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $user = User::where('id', $id)->first();

        if($user==NULL)
            return redirect()->back()->with('error', 'User not existing!');

        if($user->role==1){
            $members = User::where('role', 2)->where('group_number', $user->group_number)->lists('id');
            $tickets = Ticket::whereIn('assignee', $members)->get();
        }
        else{
            $tickets = Ticket::where('assignee', $user->id)->get();
        }

        if(count($tickets)>0)
            return redirect()->back()->with('error', 'User cannot be deleted. There are tickets still assigned to this user.');
        else{
            $user->delete();
            return redirect()->back()->with('message', 'User successfully deleted.');
        }
    }
}
