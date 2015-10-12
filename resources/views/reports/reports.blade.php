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
	<div class="box box-primary">
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
                <label class="radio-inline" style="padding-left: 0px"><input type="checkbox" value="1" id ="2" name ="checkmember[]" /> New</label>
                <label class="radio-inline"><input type="checkbox" value="2" id ="2" name ="checkmember[]" /> In Process</label>
                <label class="radio-inline"><input type="checkbox" value="3" id ="2" name ="checkmember[]" /> In Pending</label>
                <label class="radio-inline"><input type="checkbox" value="5" id ="2" name ="checkmember[]" /> Closed</label>
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
@stop