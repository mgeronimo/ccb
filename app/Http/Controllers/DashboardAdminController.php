<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Mailers\AppMailer;
use App\Mailers\AppDepartment;
use Mail;
use Input;
use App\Group;
use App\User;
use App\Department;
use App\Departments;
use App\Region;
use App\Province;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Announcement;
use App\Http\Requests\AnnouncementRequest;
use App\Http\Requests\AnnouncementDraftRequest;

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
        $regions = Region::all();
        $provinces =Province::all();
        return view('admin.adddept')->with('user', $user)->with('regions',$regions)->with('provinces',$provinces);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function addDept(Request $request,  AppDepartment $mailer)

    {
        //
        $user = new User;
        $department = new Departments;
        $input = $request->all();
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
              $user->first_name = $input['firstname'];
              $user->last_name = $input['lastname'];
              $user->email = $input['email'];
              $user->role = 4;

              $user->agency_id = Departments::where('dept_name',$dept)->value('id');

              //$user->agency_id = count(Department::all())+1;

              $user->contact_number = $input['contact_number'];
              $user->save();
              $mailer->sendEmailConfirmationTo($user);
        }
        //different email
        return redirect('/')->with('message', 'Department Successfully added.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function validateDepartment()
    {
        $validate = null;
        $input = trim(Input::get('dept_name'));

        $validate = Departments::where('dept_name', $input)->get();
        
        if(count($validate)) return 'failed';
        else return 'passed';
    
        //
    }
      public function validateEditDepartment($id)
    {
        $validate = null;
        $input = trim(Input::get('dept_name'));

        $validate = Departments::whereNotIn('id', [$id])->where('dept_name', $input)->get();
        if(count($validate)) return 'failed';
        else return 'passed';
    
        //
    }
       public function validateEditEmailHead($id)
    {
        $validate = null;
        $input = trim(Input::get('agency_email'));

        $validate = Departments::whereNotIn('id', [$id])->where('agency_email', $input)->get();

        if(count($validate)) return 'failed';
        else return 'passed';
    
        //
    }
        public function validateEditEmail($id)
    {
        $validate = null;
        $input = trim(Input::get('email'));

        $validate = User::whereNotIn('agency_id', [$id])->where('email', $input)->get();
        if(count($validate)) return 'failed';
        else return 'passed';
    
        //
    }


    public function validateDeptRep()
    {
        $validate = null;
        $input = trim(Input::get('email'));

        $validate = User::where('email', $input)->get();
        
        if(count($validate)) return 'failed';
        else return 'passed';
    
        //
    }
    public function validateAgencyEmail()
    {
        $validate = null;
        $input = trim(Input::get('agency_email'));

        $validate = Departments::where('agency_email', $input)->get();

        if($input=="") return 'passed';
        else if(count($validate)) return 'failed';
        else return 'passed';
    
        //
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function announcement()
    {
        //
        $user = Auth::user();
        return view('admin.announcement')->with('user', $user);
    }
    
    public function saveAnnouncement(AnnouncementRequest $request)
    {
         $input = $request->all();
         $announcement = new Announcement;
         $announcement->subject = $input['subject'];
         $announcement->message=$input['message'];
         $announcement->status = 1;
         $announcement->save();
         return redirect('/announcements')->with('message','Announcement successfully added!');
    }
    public function draftAnnouncement(AnnouncementDraftRequest $request)
    {
         $input = $request->all();
         $announcement = new Announcement;
         $announcement->subject = $input['subject'];
         $announcement->message=$input['message'];
         $announcement->status = 0;
         $announcement->save();
         return redirect('/announcements')->with('message','Announcement is saved as draft.');
    }
}
