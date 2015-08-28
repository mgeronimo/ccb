<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Group;
use App\User;
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
        return view('admin.dashboard-admin')->with('user', $user);
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
        return $input;
        $user->first_name = $request->$input['sfirstname'];
        $user->last_name = $request->$input['slastname'];
        $user->email = $request->$input['sEmail'];

        $user->first_name = $request->$input['agentfname'];
        $user->last_name = $request->$input['agentlname'];
        $user->email = $request->$input['agentemail'];

        $groups = Group::where('group_name', $group->group_name)->firstOrFail();
        //return $groups;

        $groups->users()->save($user);

        return redirect('/addgroup');
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
