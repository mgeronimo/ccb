<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Validator;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\Department;
use App\Ticket;

class DepartmentController extends Controller
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
        $user = Auth::user();
        $dept = Department::where('id', $id)->first();

        return view('admin.department.edit-dept')->with('user', $user)->with('dept', $dept);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function update(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($request->all(), [
            'dept_name'     => 'required|max:45|unique:departments,dept_name',
            'description'   => 'required|max:255',
            'is_member'     => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
            //dd($validator->errors());
        }

        $dept = Department::where('id', $input['dept'])->first();
        $dept->dept_name = $input['dept_name'];
        $dept->description = $input['description'];
        $dept->is_member = $input['is_member'];
        $dept->save();

        return redirect('/departments')->with('message', 'Successfully changed department details.');
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
