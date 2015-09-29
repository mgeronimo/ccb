<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Input;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Announcement;
use App\Http\Requests\AnnouncementRequest;
use App\Http\Requests\AnnouncementDraftRequest;

class AnnouncementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $announcements = Announcement::where('status', 1)->get();

        return response()->json(['data' => $this->transform($announcements)], 200);        
    }

    /**
     * Display list of al annoucements
     *
     * @return Response
     */
    public function allAnnouncements()
    {
        $user = Auth::user();
        $announcements = Announcement::all();

        return view('admin.announcement.index')->with('user', $user)->with('announcements', $announcements);
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
        $user = Auth::user();
        $announcement = Announcement::where('id', $id)->first();

        return view('admin.announcement.show-announcement')->with('user', $user)->with('announcement', $announcement);
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
        $announcement = Announcement::where('id', $id)->first();

        return view('admin.announcement.edit-announcement')->with('user', $user)->with('announcement', $announcement);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function update(AnnouncementRequest $request)
    {
        $input = $request->all();

        $announcement = Announcement::where('id', $input['id'])->first();

        $announcement->subject = $input['subject'];
        $announcement->message = $input['message'];
        $announcement->status = 1;
        $announcement->save();

        return redirect('announcements/'.$input['id'])->with('message', 'Successfully updated post!');
    }

    public function draftEditedAnnouncement(AnnouncementDraftRequest $request)
    {
         $input = $request->all();
         $announcement = Announcement::where('id', $input['id'])->first();
         $announcement->subject = $input['subject'];
         $announcement->message = $input['message'];
         $announcement->status = 0;
         $announcement->save();

         return redirect('announcements/'.$input['id'])->with('message', 'Announcement is saved as draft.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function delete($id)
    {
        $announcement = Announcement::where('id', $id)->first();

        $announcement->delete();

        return redirect()->back()->with('message', 'Announcement successfully deleted!');
    }

    /**
     * Transforms annoucement list
     *
     * @param  int  $id
     * @return Response
     */
    private function transform($announcements)
    {
        return array_map(function($announcements){
            return [
                'id'           => $announcements['id'],
                'subject'      => $announcements['subject'],
                'message'      => $announcements['message'],
                'updated_at'   => $announcements['updated_at']
            ];
        }, $announcements->toArray());
    }
      
}
