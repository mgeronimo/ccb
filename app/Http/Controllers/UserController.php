<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;
use App\Group;
use App\Department;
use App\Ticket;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $user = Auth::user();
        $supervisors = User::where('role', 1)->get();
        foreach ($supervisors as $key => $supervisor) {
            $group = Group::where('id', $supervisor->group_number)->first();
            $supervisor->group_name = $group->group_name;
        }

        $agents = User::where('role', 2)->get();
        foreach ($agents as $key => $agent) {
            $group = Group::where('id', $supervisor->group_number)->first();
            $agent->group_name = $group->group_name;
        }

        $deptreps = User::where('role', 4)->get();
        foreach ($deptreps as $key => $deptrep) {
            $dept = Department::where('dept_rep', $deptrep->id)->first();
            $deptrep->dept_name = $dept->dept_name;
        }

        return view('admin.user.users')->with('user', $user)
            ->with('supervisors', $supervisors)
            ->with('agents', $agents)
            ->with('deptreps', $deptreps);
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
        $user = User::where('id', $id)->first();

        if($user==NULL)
            return redirect()->back()->with('error', 'User not existing!');

        $all_tickets = Ticket::all();

        $tickets = Ticket::where('assignee', $user->id)->get();

        if(count($tickets)>0)
            return redirect()->back()->with('error', 'User cannot be deleted. There are still tickets assigned to this user.');
        else{
            $user->delete();
            return redirect()->back()->with('message', 'User successfully deleted.');
        }
        
    }
}
