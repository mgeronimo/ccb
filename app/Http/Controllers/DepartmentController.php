<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\Department;
use App\Ticket;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $user = Auth::user();
        $departments = Department::all();
        foreach ($departments as $key => $department) {
            $deptrep = User::where('id', $department->dept_rep)->first();
            $department->deptrep_name = $deptrep->first_name." ".$deptrep->last_name;
        }

        return view('admin.department.departments')->with('user', $user)
            ->with('departments', $departments);
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
        $dept = Department::where('id', $id)->first();

        if($dept==NULL)
            return redirect()->back()->with('error', 'Department not existing!');

        $tickets = Ticket::where('dept_id', $dept->id)->get();

        if(count($tickets)>0)
            return redirect()->back()->with('error', 'Department cannot be deleted. There are tickets still assigned to this user.');
        else{
            $user = User::where('id', $dept->dept_rep)->first();
            $dept->delete();
            $user->delete();
            return redirect()->back()->with('message', 'Department successfully deleted.');
        }
    }
}
