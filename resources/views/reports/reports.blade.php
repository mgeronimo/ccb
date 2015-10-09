@extends('template.dashboard')

@section('title')
	Reports
@stop

@section('heads')
    <link rel="stylesheet" href='{{ url("assets/css/styleadmin.css") }}'>
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
		<div class="box-body" style="font-size: 15px">
			<div class="col-md-3">
				<label>Agencies</label>
			</div>
			<div class="col-md-3">
				{!! Form::select('agency_id', [null=>"--- Select Agency of User ---"] + [0=>"CCB"] + $agencies, Input::old('agency', -1), array('name' => 'agency_id', 'class' => 'input-group form-control')) !!}
			</div>
			<div class="col-md-3">
				<h5>Select Dates</h5>
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
			</div>
		</div>
	</div>
@stop

@section('scripts')
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
                    startDate: moment(startDate),
                    endDate: moment(endDate)
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
@stop