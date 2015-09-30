@extends('template.dashboard')

@section('title')
	Tickets In Process
@stop

@section('heads')
    <link rel="stylesheet" href='{{ url("assets/css/styleadmin.css") }}'>
    <link rel="stylesheet" href='{{ url("assets/plugins/datatables/dataTables.bootstrap.css") }}'>
@stop

@section('page-title')
	Tickets In Process
@stop

@section('page-desc')
	All tickets that are currenty in process
@stop

@section('breadcrumb')
	<li>Tickets</li>
	<li class="active">Tickets In Process</li>
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
                <i class="fa fa-fw fa-danger-circle"></i> &nbsp;{{ Session::get('error') }}
            </div>
        </div>
    @endif
    <br/>
	<div class="row">
        <section class="col-lg-12">
            <div class="box box-info" style="min-height: 250px">
                <div class="box-header">
                    <i class="fa fa-hourglass-half"></i>
                    <h3 class="box-title">Tickets In Process</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                	@if(count($in_process_tickets)==0)
                        <em class="no-statement"><center style="padding: 40px">No tickets added yet.</center></em>
                    @else
                    	<table id="table" class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Tasks</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($in_process_tickets as $ticket)
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
                    @endif
                </div>
            </div>
        </section>
    </div>
@stop

@section('scripts')
	<script src='{{ url("assets/js/jquery-1.11.1.min.js") }}'></script>
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