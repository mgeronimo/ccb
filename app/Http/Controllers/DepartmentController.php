<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Validator;
use App\Mailers\AppDepartment;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\Department;
use App\Ticket;
use App\Region;
use App\Province;
class DepartmentController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin',['except'=>'index']);
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
            $deptrep = User::where('agency_id', $department->id)->where('role', 4)->first();
            if($deptrep!=NULL)
                $department->deptrep_name = $deptrep->first_name." ".$deptrep->last_name;
            else $department->deptrep_name = "None";
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
        $regions = Region::all();
        $provinces =Province::all();
        $exist_region = Region::where('regcode', $dept->regcode)->value('regname'); 
        if(!$dept->provcode==null)
        {
            $exist_province = Province::where('provcode', $dept->provcode)->value('provname');
        }
        else
        {
            $exist_province = null;
        }
        $deptrep = User::where('agency_id', $id)->first();
        if($deptrep=="")
        {
            $deptrep = null;
        }

        return view('admin.department.edit-dept')->with('user', $user)->with('dept', $dept)->with('regions',$regions)->with('provinces',$provinces)->with('exist_region',$exist_region)->with('exist_province', $exist_province)->with('deptrep', $deptrep);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function update(Request $request, AppDepartment $mailer)
    {
        $input = $request->all();

        $department = Department::where('id', $input['dept'])->first();
        $dept = $input['dept_name'];

        $department->dept_name = $input['dept_name'];
        $department->is_member = $input['is_member'];
        $department->regcode =  $input['regname'];
        if(!$input['provname']=="null") 
        {$department->provcode =  $input['provname']; }
        if(!$input['agency_head']==null) 
        { $department->agency_head =$input['agency_head']; }
        if(!$input['contact']==null)
        {$department->contact = $input['contact']; }
        if(!$input['agency_email']==null)
        {$department->agency_email = $input['agency_email']; }
        $department->save();
         if($input['is_member']==1)
        {  
              $user = User::where('agency_id', $input['dept'])->first();
             $email = User::where('agency_id', $input['dept'])->value('email');

              if($user=="")
           {       
                $user = new User;
                $user->first_name = $input['firstname'];
                $user->last_name = $input['lastname'];
                $user->email = $input['email'];
                $user->role = 4;
                $user->agency_id = Department::where('dept_name',$dept)->value('id');
                $user->contact_number = $input['contact_number'];
                $user->save();
                $mailer->sendEmailConfirmationTo($user);
            }
            else
            {
                $user->first_name = $input['firstname'];
                $user->last_name = $input['lastname'];
                $user->email = $input['email'];
                $user->role = 4;
                $user->agency_id = Department::where('dept_name',$dept)->value('id');
                $user->contact_number = $input['contact_number'];
                if(!($email ==  $input['email'])){  $mailer->sendEmailConfirmationTo($user); }
                $user->save();
            }
        }

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

    public function profile($id)
    {
        $user = Auth::user();
        $dept =  Department::where('id', $id)->first();
        $region = Region::where('regcode',$dept->regcode)->value('regname');
        if(!$dept->provcode==null)
        {
            $province = Province::where('provcode', $dept->provcode)->value('provname');
        }
        else
        {
            $province=null;
        }
        if($dept->is_member == 1)
        {
            $rep = User::where('agency_id', $dept->id)->first();
        }
        else
        {
            $rep=null;
        }
        return view('admin.department.department-profile')->with('user', $user)->with('dept',$dept)->with('region',$region)->with('province',$province)->with('rep',$rep);
    }
}
