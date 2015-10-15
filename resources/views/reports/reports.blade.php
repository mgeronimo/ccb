@extends('template.dashboard')

@section('title')
	Reports
@stop

@section('heads')
    <link rel="stylesheet" href='{{ url("assets/css/styleadmin.css") }}'>
    <link rel="stylesheet" href='{{ url("assets/plugins/daterangepicker/daterangepicker-bs3.css") }}'>
    
@stop

@section('page-title')
	Reports
@stop

@section('page-desc')
	Generates reports in graphs, pdf, and csv form
@stop

@section('breadcrumb')
	<li class="active">Reports</li>
@stop

@section('content')
	@if(Session::has('message'))
        <div class="no-print">
            <div class="callout callout-info" style="margin-bottom: 0!important;">
                <i class="fa fa-fw fa-info-circle"></i> &nbsp;{{ Session::get('message') }}
            </div>
        </div>
    @endif
    @if(Session::has('error'))
        <div class="no-print">
            <div class="callout callout-danger" style="margin-bottom: 0!important;">
                <i class="fa fa-fw fa-danger-circle"></i> &nbsp;{{ Session::get("error") }}
            </div>
        </div>
    @endif
    <br/>
	<div class="box box-primary no-print">
		<div class="box-header with-border">
			<h3 class="box-title">Filters</h3>
		</div>
		<div class="box-body" style="font-size: 15px" ng-controller="ApplicationController">
            <form method="get" action="{{url('reports')}}" ng-submit="filterReport()">
			<div class="col-md-1 reports-filter">
				<label>Date</label>
			</div>
			<div class="col-md-5 reports-filter">
				<div style="overflow:hidden">
                    <div id="reportrange" class="pull-left">
                        <i class="fa fa-calendar fa-lg"></i>
                        <span>
                        @if(isset($startDate))
                            {{date("F j, Y", strtotime($startDate))}}
                            @else
                            {{date("F j, Y", strtotime('-29 day'))}}
                        @endif
                            -
                            @if(isset($endDate))
                                {{date("F j, Y", strtotime($endDate))}}
                            @else
                                {{date("F j, Y")}}
                            @endif
                        </span> <b class="caret"></b>
                    </div>
                </div>
                <input type="hidden" name="startDate" id="startDate"/>
                <input type="hidden" name="endDate" id="endDate"/>
			</div>
		    <div class="col-md-1 reports-filter">
                <label>Agencies</label>
            </div>
            <div class="col-md-5 reports-filter"> 
                <div
                    isteven-multi-select 
                    input-model="agencies" 
                    output-model="selected_agencies"
                    button-label="icon name"        
                    item-label="icon name maker"        
                    tick-property="ticked"                        
                >
                </div>
                <input type="hidden" name="agencies" id="agencies" ng-value="agency_input" />
            </div>
            <div class="col-md-1 reports-filter">
                <label>Region</label>
            </div>
            <div class="col-md-5 reports-filter">
                <div
                    isteven-multi-select 
                    input-model="regions" 
                    output-model="selected_regions"
                    button-label="icon name"        
                    item-label="icon name maker"        
                    tick-property="ticked"                        
                >
                </div>
                <input type="hidden" name="regions" id="regions" ng-value="region_input"/>
            </div>
            <div class="col-md-1 reports-filter">
                <label>Provinces</label>
            </div>
            <div class="col-md-5 reports-filter">
                <div
                    isteven-multi-select 
                    input-model="provinces" 
                    output-model="selected_provinces"
                    button-label="icon name"        
                    item-label="icon name maker"        
                    tick-property="ticked"                        
                >
                </div>
                <input type="hidden" name="provinces" id="provinces" ng-value="province_input"/>
            </div>
            <div class="col-md-1 reports-filter">
                <label>Status</label>
            </div>
            <div class="col-md-5 reports-filter">
                <label class="radio-inline" style="padding-left: 0px"><input type="checkbox" value="1" id ="2" name ="status[]" /> New</label>
                <label class="radio-inline"><input type="checkbox" value="2" id ="2" name ="status[]" /> In Process</label>
                <label class="radio-inline"><input type="checkbox" value="3" id ="2" name ="status[]" /> Pending</label>
                <label class="radio-inline"><input type="checkbox" value="5" id ="2" name ="status[]" /> Closed</label>
            </div>
            <div class="col-md-1 reports-filter">
                <label>Category</label>
            </div>
            <div class="col-md-5 reports-filter">
                <label class="radio-inline" style="padding-left: 0px"><input type="checkbox" value="1" id ="2" name ="category[]" /> ARTA</label>
                <label class="radio-inline" style="padding-left: 0px"><input type="checkbox" value="2" id ="2" name ="category[]" /> non-ARTA</label>
            </div>
		</div>
        <div class="box-footer">
                <input type="submit" onclick="this.form.action='/reports';" class="btn btn-primary pull-right" value="Generate Report">
            </form>
        </div>
	</div>

    @if($tickets!=NULL)
        <div class="col-md-12">
            <h4 style="text-align: center">RESULTS</h4>
            <h5 style="text-align: center">{{ date("F j, Y", strtotime($startDate)).' - '.date("F j, Y", strtotime($endDate)) }}</h5>
        </div>
        <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-green">
                    <span class="info-box-icon"><i class="fa fa-bookmark-o"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">New</span>
                        <span class="info-box-number">{{ count($new_tickets) }}</span>
                        <div class="progress">
                            <div class="progress-bar" style="width: {{ (count($new_tickets)/count($tickets))*100 }}%"></div>
                        </div>
                        <span class="progress-description">
                            {{ round((count($new_tickets)/count($tickets))*100, 2) }}% of the tickets
                        </span>
                    </div><!-- /.info-box-content -->
                </div><!-- /.info-box -->
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-aqua">
                    <span class="info-box-icon"><i class="fa fa-bookmark-o"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">In Process</span>
                        <span class="info-box-number">{{ count($ongoing_tickets) }}</span>
                        <div class="progress">
                            <div class="progress-bar" style="width: {{ (count($ongoing_tickets)/count($tickets))*100 }}%"></div>
                        </div>
                        <span class="progress-description">
                            {{ round((count($ongoing_tickets)/count($tickets))*100, 2) }}% of the tickets
                        </span>
                    </div><!-- /.info-box-content -->
                </div><!-- /.info-box -->
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-orange">
                    <span class="info-box-icon"><i class="fa fa-bookmark-o"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Pending</span>
                        <span class="info-box-number">{{ count($pending_tickets) }}</span>
                        <div class="progress">
                            <div class="progress-bar" style="width: {{ (count($pending_tickets)/count($tickets))*100 }}%"></div>
                        </div>
                        <span class="progress-description">
                            {{ round((count($pending_tickets)/count($tickets))*100, 2) }}% of the tickets
                        </span>
                    </div><!-- /.info-box-content -->
                </div><!-- /.info-box -->
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-gray">
                    <span class="info-box-icon"><i class="fa fa-bookmark-o"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Closed</span>
                        <span class="info-box-number">{{ count($closed_tickets) }}</span>
                        <div class="progress">
                            <div class="progress-bar" style="width: {{ (count($closed_tickets)/count($tickets))*100 }}%"></div>
                        </div>
                        <span class="progress-description">
                            {{ round((count($closed_tickets)/count($tickets))*100, 2) }}% of the tickets
                        </span>
                    </div><!-- /.info-box-content -->
                </div><!-- /.info-box -->
            </div>
        </div>
        <div class="row">
            <section class="col-lg-12">
                <div class="box box-default" style="min-height: 250px">
                    <div class="box-header">
                        <h3 class="box-title">Tickets</h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <table id="table" class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Tickets</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($tickets as $ticket)
                                <tr>
                                    <td class="ticket-td">
                                        <i class="fa fa-circle-o"></i>
                                        <!-- todo text -->
                                        <span class="text"><a href="/tickets/{{ $ticket->id }}">{{ $ticket->ticket_id }}</a> - {{ $ticket->subject }}</span><br/>
                                        <!-- Emphasis label -->
                                        <span class="label label-default sub-time" style="font-size: 11px"><i class="fa fa-clock-o"></i> {{ $ticket->created_at }}</span>
                                        <span class="label label-info" style="font-size: 11px"><i class="fa fa-briefcase"></i> {{ $ticket->dept_name }}</span>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
        </div>
    @else
        <div class="row">
            <section class="col-lg-12">
                <div class="callout bg-gray lead">
                    <p style="font-size: 16px; text-align: center">No result!</p>
                </div>
            </section>
        </div>
    @endif
@stop

@section('scripts')
    <script src='{{ url("assets/plugins/daterangepicker/moment.min.js") }}'></script>
    <script src='{{ url("assets/plugins/daterangepicker/daterangepicker.js") }}'></script>
    <script type="text/javascript">

        $('#reportrange').daterangepicker(
            {
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                },
                startDate: moment().subtract(6, 'days'),
                endDate: moment()
            },
            function(start, end) {
                $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
            }
        );
        $('#reportrange').on('apply.daterangepicker', function(ev, picker) {
            console.log(picker.startDate.format('YYYY-MM-DD'));
            console.log(picker.endDate.format('YYYY-MM-DD'));
        });

    </script>
    <script src='{{ url("assets/js/applicationController.js") }}'></script>
    <script src='{{ url("assets/plugins/datatables/jquery.dataTables.min.js") }}'></script>
    <script src='{{ url("assets/plugins/datatables/dataTables.bootstrap.min.js") }}'></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $(".pagination").addClass('pagination-sm no-margin pull-right')
        });

        $(function () {
            $("#table").DataTable();
        });
    </script>
@stop