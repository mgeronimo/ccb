<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use JavaScript;
use Input;
use DB;
use PDF;
use League\Csv\Writer;

use App\User;
use App\Ticket;
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

            /*$tickets = DB::table('tickets as t')
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
            dd($tickets);*/

            //dd($agencies);

            $tickets = DB::table('tickets as t')
                ->leftJoin('departments as d', 't.dept_id', '=', 'd.id')
                ->leftJoin('statuses as s', 't.status', '=', 's.id')
                ->leftJoin('users as u', function($join){
                    $join->on('t.created_by', '=', 'u.id')->orOn('t.assignee', '=', 'u.id');
                })
                ->leftJoin('region as r', 'd.regcode', '=', 'r.regcode')
                ->leftJoin('province as p', 'd.provcode', '=', 'p.provcode')
                ->whereBetween(DB::raw('CAST(t.created_at AS DATE)'),[$input['startDate'],$input['endDate']]);

            /*$new_tickets = DB::table('tickets as t')
                ->leftJoin('departments as d', 't.dept_id', '=', 'd.id')
                ->leftJoin('statuses as s', 't.status', '=', 's.id')
                ->leftJoin('users as u', function($join){
                    $join->on('t.created_by', '=', 'u.id')->orOn('t.assignee', '=', 'u.id');
                })
                ->leftJoin('region as r', 'd.regcode', '=', 'r.regcode')
                ->leftJoin('province as p', 'd.provcode', '=', 'p.provcode')
                ->whereBetween(DB::raw('CAST(t.created_at AS DATE)'),[$input['startDate'],$input['endDate']])
                ->where('t.status', 1);*/

            $ongoing_tickets = DB::table('tickets as t')
                ->leftJoin('departments as d', 't.dept_id', '=', 'd.id')
                ->leftJoin('statuses as s', 't.status', '=', 's.id')
                ->leftJoin('users as u', function($join){
                    $join->on('t.created_by', '=', 'u.id')->orOn('t.assignee', '=', 'u.id');
                })
                ->leftJoin('region as r', 'd.regcode', '=', 'r.regcode')
                ->leftJoin('province as p', 'd.provcode', '=', 'p.provcode')
                ->whereBetween(DB::raw('CAST(t.created_at AS DATE)'),[$input['startDate'],$input['endDate']])
                ->where('t.status', 2);

            $pending_tickets = DB::table('tickets as t')
                ->leftJoin('departments as d', 't.dept_id', '=', 'd.id')
                ->leftJoin('statuses as s', 't.status', '=', 's.id')
                ->leftJoin('users as u', function($join){
                    $join->on('t.created_by', '=', 'u.id')->orOn('t.assignee', '=', 'u.id');
                })
                ->leftJoin('region as r', 'd.regcode', '=', 'r.regcode')
                ->leftJoin('province as p', 'd.provcode', '=', 'p.provcode')
                ->whereBetween(DB::raw('CAST(t.created_at AS DATE)'),[$input['startDate'],$input['endDate']])
                ->where('t.status', 3);

            $closed_tickets = DB::table('tickets as t')
                ->leftJoin('departments as d', 't.dept_id', '=', 'd.id')
                ->leftJoin('statuses as s', 't.status', '=', 's.id')
                ->leftJoin('users as u', function($join){
                    $join->on('t.created_by', '=', 'u.id')->orOn('t.assignee', '=', 'u.id');
                })
                ->leftJoin('region as r', 'd.regcode', '=', 'r.regcode')
                ->leftJoin('province as p', 'd.provcode', '=', 'p.provcode')
                ->whereBetween(DB::raw('CAST(t.created_at AS DATE)'),[$input['startDate'],$input['endDate']])
                ->where('t.status', 5);

            if($agencies[0]!=""){
                $tickets = $tickets->whereIn('t.dept_id',$agencies);
                $new_tickets = $new_tickets->whereIn('t.dept_id',$agencies);
                /*$ongoing_tickets = $ongoing_tickets->whereIn('t.dept_id',$agencies);
                $pending_tickets = $pending_tickets->whereIn('t.dept_id',$agencies);
                $closed_tickets = $closed_tickets->whereIn('t.dept_id',$agencies);*/
            }
            if($provinces[0]!=""){
                $tickets = $tickets->whereIn('d.provcode',$provinces);
                $new_tickets = $new_tickets->whereIn('d.provcode',$provinces);
                /*$ongoing_tickets = $ongoing_tickets->whereIn('d.provcode',$provinces);
                $pending_tickets = $pending_tickets->whereIn('d.provcode',$provinces);
                $closed_tickets = $closed_tickets->whereIn('d.provcode',$provinces);*/
            }
            if($regions[0]!=""){
                $tickets = $tickets->whereIn('d.regcode',$regions);
                $new_tickets = $new_tickets->whereIn('d.regcode',$regions);
                /*$ongoing_tickets = $ongoing_tickets->whereIn('d.regcode',$regions);
                $pending_tickets = $pending_tickets->whereIn('d.regcode',$regions);
                $closed_tickets = $closed_tickets->whereIn('d.regcode',$regions);*/
            }
            
            if($category!=""){
                $tickets = $tickets->whereIn('t.category',$category);
                $new_tickets = $new_tickets->whereIn('t.category',$category);
                /*$ongoing_tickets = $ongoing_tickets->whereIn('t.category',$category);
                $pending_tickets = $pending_tickets->whereIn('t.category',$category);
                $closed_tickets = $closed_tickets->whereIn('t.category',$category);*/
            }

            $data = $tickets;
            if($status!=""){
                $data = $data->whereIn('t.status',$status);
            }
            $data = $data->groupBy('t.id')->get();
            $new_tickets = $tickets->where('t.status', 1)->groupBy('t.id')->get();
            //$ongoing_tickets = $tickets->where('t.status', 2)->groupBy('t.id')->get();
            //$pending_tickets = $tickets->where('t.status', 3)->groupBy('t.id')->get();
            //$closed_tickets = $tickets->where('t.status', 5)->groupBy('t.id')->get();

            return view('reports.reports')->with('user', $user)
                //->with('agencies', $agencies)
                ->with('tickets', $data)
                ->with('new_tickets', $new_tickets)
                ->with('ongoing_tickets', $ongoing_tickets)
                ->with('pending_tickets', $pending_tickets)
                ->with('closed_tickets', $closed_tickets)
                ->with('startDate', $startDate)
                ->with('endDate', $endDate)
                ->with('input', $input);
        }

        //$pdf = PDF::loadView('reports.reports-pdf');
        //return $pdf->stream('report.pdf');

        return view('reports.reports')->with('user', $user)
            //->with('agencies', $agencies)
            ->with('tickets', NULL)
            ->with('input', $input);
            //->with('startDate', $startDate)
            //->with('endDate', $endDate);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function generatePdf()
    {
        $user = Auth::user();
        $input = Input::all();
        $status = "";
        $category = "";

        
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
            ->whereBetween(DB::raw('CAST(t.created_at AS DATE)'),[$input['startDate'],$input['endDate']]);

        if($tickets!=NULL){
            $ongoing_tickets = DB::table('tickets as t')
                ->leftJoin('departments as d', 't.dept_id', '=', 'd.id')
                ->leftJoin('statuses as s', 't.status', '=', 's.id')
                ->leftJoin('users as u', function($join){
                    $join->on('t.created_by', '=', 'u.id')->orOn('t.assignee', '=', 'u.id');
                })
                ->leftJoin('region as r', 'd.regcode', '=', 'r.regcode')
                ->leftJoin('province as p', 'd.provcode', '=', 'p.provcode')
                ->whereBetween(DB::raw('CAST(t.created_at AS DATE)'),[$input['startDate'],$input['endDate']])
                ->where('t.status', 2);

            $pending_tickets = DB::table('tickets as t')
                ->leftJoin('departments as d', 't.dept_id', '=', 'd.id')
                ->leftJoin('statuses as s', 't.status', '=', 's.id')
                ->leftJoin('users as u', function($join){
                    $join->on('t.created_by', '=', 'u.id')->orOn('t.assignee', '=', 'u.id');
                })
                ->leftJoin('region as r', 'd.regcode', '=', 'r.regcode')
                ->leftJoin('province as p', 'd.provcode', '=', 'p.provcode')
                ->whereBetween(DB::raw('CAST(t.created_at AS DATE)'),[$input['startDate'],$input['endDate']])
                ->where('t.status', 3);

            $closed_tickets = DB::table('tickets as t')
                ->leftJoin('departments as d', 't.dept_id', '=', 'd.id')
                ->leftJoin('statuses as s', 't.status', '=', 's.id')
                ->leftJoin('users as u', function($join){
                    $join->on('t.created_by', '=', 'u.id')->orOn('t.assignee', '=', 'u.id');
                })
                ->leftJoin('region as r', 'd.regcode', '=', 'r.regcode')
                ->leftJoin('province as p', 'd.provcode', '=', 'p.provcode')
                ->whereBetween(DB::raw('CAST(t.created_at AS DATE)'),[$input['startDate'],$input['endDate']])
                ->where('t.status', 5);

            if($agencies[0]!=""){
                $tickets = $tickets->whereIn('t.dept_id',$agencies);
                $new_tickets = $new_tickets->whereIn('t.dept_id',$agencies);
            }
            if($provinces[0]!=""){
                $tickets = $tickets->whereIn('d.provcode',$provinces);
                $new_tickets = $new_tickets->whereIn('d.provcode',$provinces);
            }
            if($regions[0]!=""){
                $tickets = $tickets->whereIn('d.regcode',$regions);
                $new_tickets = $new_tickets->whereIn('d.regcode',$regions);
            }
            
            if($category!=""){
                $tickets = $tickets->whereIn('t.category',$category);
                $new_tickets = $new_tickets->whereIn('t.category',$category);
            }

            $data = $tickets;
            if($status!=""){
                $data = $data->whereIn('t.status',$status);
            }
            $data = $data->groupBy('t.id')->get();
            $new_tickets = $tickets->where('t.status', 1)->groupBy('t.id')->get();

            foreach($data as $d){
                $assignee = User::where('id', $d->assignee)->first();
                if($assignee!=NULL)
                    $d->assignee_name = $assignee->first_name.' '.$assignee->last_name;
                else $d->assignee_name = "None";

                $date = Ticket::where('ticket_id', $d->ticket_id)->first();
                if($date!=NULL)
                    $d->date_time = $date->created_at;
                else $d->date_time = "";
            }

            $pdf = PDF::loadView('reports.reports-pdf', array('tickets'=>$data, 'new_tickets'=>$new_tickets, 'ongoing_tickets'=>$ongoing_tickets, 'pending_tickets'=>$pending_tickets, 'closed_tickets'=>$closed_tickets, 'startDate'=>$startDate, 'endDate'=>$endDate, 'input'=>$input));
            return $pdf->stream('report.pdf');
        }

        return redirect('reports')->with('user', $user)
            ->with('tickets', NULL)
            ->with('input', $input)
            ->with('error', 'No ticket matched so no PDF generated.');
    }

    /**
     * Generates csv report.
     *
     * @return Response
     */
    public function generateCsv()
    {
        $user = Auth::user();
        $input = Input::all();
        $status = "";
        $category = "";

        
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

        DB::setFetchMode(\PDO::FETCH_ASSOC);

        $tickets = DB::table('tickets as t')
            ->leftJoin('departments as d', 't.dept_id', '=', 'd.id')
            ->leftJoin('statuses as s', 't.status', '=', 's.id')
            ->leftJoin('users as u', function($join){
                $join->on('t.created_by', '=', 'u.id')->orOn('t.assignee', '=', 'u.id');
            })
            ->leftJoin('region as r', 'd.regcode', '=', 'r.regcode')
            ->leftJoin('province as p', 'd.provcode', '=', 'p.provcode')
            ->whereBetween(DB::raw('CAST(t.created_at AS DATE)'),[$input['startDate'],$input['endDate']]);

        //if($tickets!=NULL){
        $ongoing_tickets = DB::table('tickets as t')
            ->leftJoin('departments as d', 't.dept_id', '=', 'd.id')
            ->leftJoin('statuses as s', 't.status', '=', 's.id')
            ->leftJoin('users as u', function($join){
                $join->on('t.created_by', '=', 'u.id')->orOn('t.assignee', '=', 'u.id');
            })
            ->leftJoin('region as r', 'd.regcode', '=', 'r.regcode')
            ->leftJoin('province as p', 'd.provcode', '=', 'p.provcode')
            ->whereBetween(DB::raw('CAST(t.created_at AS DATE)'),[$input['startDate'],$input['endDate']])
            ->where('t.status', 2);

        $pending_tickets = DB::table('tickets as t')
            ->leftJoin('departments as d', 't.dept_id', '=', 'd.id')
            ->leftJoin('statuses as s', 't.status', '=', 's.id')
            ->leftJoin('users as u', function($join){
                $join->on('t.created_by', '=', 'u.id')->orOn('t.assignee', '=', 'u.id');
            })
            ->leftJoin('region as r', 'd.regcode', '=', 'r.regcode')
            ->leftJoin('province as p', 'd.provcode', '=', 'p.provcode')
            ->whereBetween(DB::raw('CAST(t.created_at AS DATE)'),[$input['startDate'],$input['endDate']])
            ->where('t.status', 3);

        $closed_tickets = DB::table('tickets as t')
            ->leftJoin('departments as d', 't.dept_id', '=', 'd.id')
            ->leftJoin('statuses as s', 't.status', '=', 's.id')
            ->leftJoin('users as u', function($join){
                $join->on('t.created_by', '=', 'u.id')->orOn('t.assignee', '=', 'u.id');
            })
            ->leftJoin('region as r', 'd.regcode', '=', 'r.regcode')
            ->leftJoin('province as p', 'd.provcode', '=', 'p.provcode')
            ->whereBetween(DB::raw('CAST(t.created_at AS DATE)'),[$input['startDate'],$input['endDate']])
            ->where('t.status', 5);

        if($agencies[0]!=""){
            $tickets = $tickets->whereIn('t.dept_id',$agencies);
            $new_tickets = $new_tickets->whereIn('t.dept_id',$agencies);
        }
        if($provinces[0]!=""){
            $tickets = $tickets->whereIn('d.provcode',$provinces);
            $new_tickets = $new_tickets->whereIn('d.provcode',$provinces);
        }
        if($regions[0]!=""){
            $tickets = $tickets->whereIn('d.regcode',$regions);
            $new_tickets = $new_tickets->whereIn('d.regcode',$regions);
        }
        
        if($category!=""){
            $tickets = $tickets->whereIn('t.category',$category);
            $new_tickets = $new_tickets->whereIn('t.category',$category);
        }

        $data = $tickets;
        if($status!=""){
            $data = $data->whereIn('t.status',$status);
        }
        $data = $data->groupBy('t.id')->get();
        DB::setFetchMode(\PDO::FETCH_CLASS);
        //dd($data);
        $new_tickets = $tickets->where('t.status', 1)->groupBy('t.id')->get();

        if($data!=NULL){
            $csv = Writer::createFromFileObject(new \SplTempFileObject());

            $siteheader = ['id', 'ticket_id', 'subject', 'message' ,'status', 'dept_name', 'incident_date_time', 'created_at', 'category', 'sender_firstname', 'sender_lastname', 'sender_email', 'sender_contactnumber'];
            $csv->insertOne($siteheader);

            foreach($data as $d){
                $assignee = User::where('id', $d['assignee'])->first();
                if($assignee!=NULL)
                    $d['assignee_name'] = $assignee->first_name.' '.$assignee->last_name;
                else $d['assignee_name'] = "None";

                $date = Ticket::where('ticket_id', $d['ticket_id'])->first();
                if($date!=NULL)
                    $d['date_time'] = $date->created_at;
                else $d['date_time'] = "";

                $result[0] = $date->id;
                $result[1] = $d['ticket_id'];
                $result[2] = $d['subject'];
                $result[3] = $d['message'];
                $result[4] = $d['status'];
                $result[5] = $d['incident_date_time'];
                $result[6] = $d['date_time'];
                if($d['category']==1)
                    $result[7] = 'ARTA';
                else if($d['category']==2)
                    $result[7] = 'Non-ARTA';
                else $result[7] = 'None yet';
                $result[8] = $d['first_name'];
                $result[9] = $d['last_name'];
                $result[10] = $d['email'];
                $result[11] = $d['contact_number'];
                $result[12] = $d['dept_name'];

                $csv->insertOne($result);
            }

            $csv->output('CCB-reports.csv');
            die;
        }
        else{
            return redirect('reports')->with('user', $user)
                ->with('tickets', NULL)
                ->with('input', $input)
                ->with('error', 'No ticket matched so no CSV can be generated.');
        }
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
