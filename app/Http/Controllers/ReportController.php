<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use JavaScript;
use Input;
use DB;

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
        $input = Input::all();
        $status = "";
        $category = "";

        /*$tickets = DB::table('tickets as t')
            ->join('departments as d', 't.dept_id', '=', 'd.id')
            ->join('statuses as s', 't.status', '=', 's.id')
            ->join('users as u', 't.created_by', '=', 'u.id')
            ->join('region as r', 'd.regcode', '=', 'r.regcode')
            ->join('province as p', 'd.provcode', '=', 'p.provcode')
            ->select('t.id')
            ->get();*/
        if(count($input)>0){
            $startDate = ($input['startDate']) ? $input['startDate'] : date("Y-m-d", strtotime('-29 day'));
            $endDate = ($input['endDate']) ? $input['endDate'] : date("Y-m-d");

            $agencies = explode(';', rtrim($input['agencies'],';'));
            $regions = explode(';', rtrim($input['regions'],';'));
            $provinces = explode(';', rtrim($input['provinces'],';'));
            if(isset($input['status'])){
                $status = $input['status'];
            }
            if(isset($input['category'])){
                $category = $input['category'];
            }

            if(count($provinces)==1 && $provinces[0]=="")
                $provinces[0] = NULL;

            $tickets = DB::table('tickets as t')
                ->leftJoin('departments as d', 't.dept_id', '=', 'd.id')
                ->leftJoin('statuses as s', 't.status', '=', 's.id')
                ->leftJoin('users as u', function($join){
                    $join->on('t.created_by', '=', 'u.id')->orOn('t.assignee', '=', 'u.id');
                })
                ->leftJoin('region as r', 'd.regcode', '=', 'r.regcode')
                ->leftJoin('province as p', 'd.provcode', '=', 'p.provcode')
                ->whereBetween(DB::raw('CAST(t.created_at AS DATE)'),[$input['startDate'],$input['endDate']])
                ->whereIn('t.dept_id',$agencies)
                ->whereIn('d.regcode',$regions)
                ->whereIn('t.status',$status)
                ->whereIn('d.provcode',$provinces)
                ->whereIn('t.category',$category)
                ->groupBy('t.id')
                ->get();


            $new_tickets = DB::table('tickets as t')
                ->leftJoin('departments as d', 't.dept_id', '=', 'd.id')
                ->leftJoin('statuses as s', 't.status', '=', 's.id')
                ->leftJoin('users as u', function($join){
                    $join->on('t.created_by', '=', 'u.id')->orOn('t.assignee', '=', 'u.id');
                })
                ->leftJoin('region as r', 'd.regcode', '=', 'r.regcode')
                ->leftJoin('province as p', 'd.provcode', '=', 'p.provcode')
                ->whereBetween(DB::raw('CAST(t.created_at AS DATE)'),[$input['startDate'],$input['endDate']])
                ->where('t.status', 1)
                ->whereIn('t.dept_id',$agencies)
                ->whereIn('d.regcode',$regions)
                ->whereIn('t.status',$status)
                ->whereIn('d.provcode',$provinces)
                ->whereIn('t.category',$category)
                ->groupBy('t.id')
                ->get();

            $ongoing_tickets = DB::table('tickets as t')
                ->leftJoin('departments as d', 't.dept_id', '=', 'd.id')
                ->leftJoin('statuses as s', 't.status', '=', 's.id')
                ->leftJoin('users as u', function($join){
                    $join->on('t.created_by', '=', 'u.id')->orOn('t.assignee', '=', 'u.id');
                })
                ->leftJoin('region as r', 'd.regcode', '=', 'r.regcode')
                ->leftJoin('province as p', 'd.provcode', '=', 'p.provcode')
                ->whereBetween(DB::raw('CAST(t.created_at AS DATE)'),[$input['startDate'],$input['endDate']])
                ->where('t.status', 2)
                ->whereIn('t.dept_id',$agencies)
                ->whereIn('d.regcode',$regions)
                ->whereIn('d.provcode',$provinces)
                ->whereIn('t.status',$status)
                ->whereIn('t.category',$category)
                ->groupBy('t.id')
                ->get();

            $pending_tickets = DB::table('tickets as t')
                ->leftJoin('departments as d', 't.dept_id', '=', 'd.id')
                ->leftJoin('statuses as s', 't.status', '=', 's.id')
                ->leftJoin('users as u', function($join){
                    $join->on('t.created_by', '=', 'u.id')->orOn('t.assignee', '=', 'u.id');
                })
                ->leftJoin('region as r', 'd.regcode', '=', 'r.regcode')
                ->leftJoin('province as p', 'd.provcode', '=', 'p.provcode')
                ->whereBetween(DB::raw('CAST(t.created_at AS DATE)'),[$input['startDate'],$input['endDate']])
                ->where('t.status', 3)
                ->whereIn('t.dept_id',$agencies)
                ->whereIn('d.regcode',$regions)
                ->whereIn('d.provcode',$provinces)
                ->whereIn('t.status',$status)
                ->whereIn('t.category',$category)
                ->groupBy('t.id')
                ->get();

            $closed_tickets = DB::table('tickets as t')
                ->leftJoin('departments as d', 't.dept_id', '=', 'd.id')
                ->leftJoin('statuses as s', 't.status', '=', 's.id')
                ->leftJoin('users as u', function($join){
                    $join->on('t.created_by', '=', 'u.id')->orOn('t.assignee', '=', 'u.id');
                })
                ->leftJoin('region as r', 'd.regcode', '=', 'r.regcode')
                ->leftJoin('province as p', 'd.provcode', '=', 'p.provcode')
                ->whereBetween(DB::raw('CAST(t.created_at AS DATE)'),[$input['startDate'],$input['endDate']])
                ->where('t.status', 5)
                ->whereIn('t.dept_id',$agencies)
                ->whereIn('d.regcode',$regions)
                ->whereIn('d.provcode',$provinces)
                ->whereIn('t.status',$status)
                ->whereIn('t.category',$category)
                ->groupBy('t.id')
                ->get();

            return view('reports.reports')->with('user', $user)
                //->with('agencies', $agencies)
                ->with('tickets', $tickets)
                ->with('new_tickets', $new_tickets)
                ->with('ongoing_tickets', $ongoing_tickets)
                ->with('pending_tickets', $pending_tickets)
                ->with('closed_tickets', $closed_tickets)
                ->with('startDate', $startDate)
                ->with('endDate', $endDate);
        }

        return view('reports.reports')->with('user', $user)
            //->with('agencies', $agencies)
            ->with('tickets', NULL);
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
