<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\Group;

class DashboardController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');

     /*   $this->middleware('login');*/
        //$this->middleware('sup.agent');
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $user = Auth::user();

        $tickets = Ticket::all();
        
        if($user->role==0)
            return view('admin.index')->with('user', $user)->with('groups', $groups)->with('tickets', $tickets);
        else if($user->role==1)
            return view('admin.index')->with('user', $user)->with('groups', $groups)->with('tickets', $tickets);

        $groups = Group::orderBy('group_name')->get();
        //return $groups;
                foreach ($groups as $key => $group) {
                   $supervisor = User::where('group_number', $group->id)
                                ->where('role', 1)->first();
                   $group->supervisor = $supervisor->first_name." ".$supervisor->last_name;
                   }
        if($user->role==0)
        
            return view('admin.index')->with('user', $user)->with('groups', $groups);

        else if($user->role==2)
            return view('dashboard')->with('user', $user);
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
}
