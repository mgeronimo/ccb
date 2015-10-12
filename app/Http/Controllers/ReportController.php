<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use JavaScript;
use Input;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Department;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $user = Auth::user();
        $agencies = Department::where('is_member', 1)->lists('dept_name', 'id')->toArray();
        //$input = Input::only('startDate','endDate');
        $input = Input::all();
        //$startDate = ($input['startDate']) ? $input['startDate'] : date("Y-m-d", strtotime('-29 day'));
        //$endDate = ($input['endDate']) ? $input['endDate'] : date("Y-m-d");

        //dd($input);

        /*JavaScript::put([
            'startDate' => $startDate,
            'endDate' => $endDate
        ]);*/

        return view('reports.reports')->with('user', $user)
            ->with('agencies', $agencies);
            //->with('startDate', $startDate)
            //->with('endDate', $endDate);
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
