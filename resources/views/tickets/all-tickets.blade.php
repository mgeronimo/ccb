@extends('template.dashboard')

@section('title')
	All Tickets
@stop

@section('heads')
    <link rel="stylesheet" href='{{ url("assets/css/styleadmin.css") }}'>
@stop

@section('page-title')
	Tickets
@stop

@section('page-desc')
	All tickets submitted by public users
@stop

@section('breadcrumb')
	<li class="active">Tickets</li>
@stop

@section('content')
	<div class="row">
        <section class="col-lg-6">
            <div class="box box-success" style="min-height: 360px">
                <div class="box-header">
                    <i class="fa fa-hourglass-start"></i>
                    <h3 class="box-title">New Tickets</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                	@if(count($unassigned_tickets)==0)
                        <em><center>No tickets added yet.</center></em>
                    @else
                    	<ul class="todo-list">
                            @foreach($unassigned_tickets as $uticket)
                                <li>
                                    <i class="fa fa-circle-o"></i>
                                    <!-- todo text -->
                                    <span class="text"><a href="/tickets/{{ $uticket->id }}">{{ $uticket->ticket_id }}</a> - {{ $uticket->subject }}</span><br/>
                                    <!-- Emphasis label -->
                                    <span class="label label-default sub-time" style="font-size: 11px"><i class="fa fa-clock-o"></i> {{ $uticket->created_at }}</span>
                                    <span class="label label-info" style="font-size: 11px"><i class="fa fa-briefcase"></i> {{ $uticket->dept_name }}</span>
                                    <!-- General tools such as edit or delete-->
                                    <div class="tools">
                                        <a href="/tickets/{{ $uticket->id }}"><i class="fa fa-info-circle" style="color: #222F4E" role="button"  data-toggle="tooltip" data-placement="top" title="See details"></i></a>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
                <div class="box-footer clearfix no-border">
	                {!! $unassigned_tickets->render() !!}
	            </div>
            </div>
        </section>
        <section class="col-lg-6">
        	<div class="box box-danger">
                <div class="box-header">
                	<i class="fa fa-hourglass-end"></i>
                    <h3 class="box-title">Overdue</h3>
                </div>
                <div class="box-body">
	                <em><center>No overdue tickets yet.</center></em><br/>
                </div>
            </div>
        	<div class="box box-info">
                <div class="box-header">
                	<i class="fa fa-hourglass-half"></i>
                    <h3 class="box-title">In Process</h3>
                </div>
                <div class="box-body">
                	@if(count($inprocess_tickets)==0)
                        <em><center>No tickets in process yet.</center></em>
                    @else
                    	<ul class="todo-list">
                            @foreach($inprocess_tickets as $iticket)
                                <li>
                                    <i class="fa fa-circle-o"></i>
                                    <!-- todo text -->
                                    <span class="text"><a href="/tickets/{{ $iticket->id }}">{{ $iticket->ticket_id }}</a> - {{ $iticket->subject }}</span><br/>
                                    <!-- Emphasis label -->
                                    <span class="label label-default sub-time" style="font-size: 11px"><i class="fa fa-clock-o"></i> {{ $iticket->created_at }}</span>
                                    <span class="label label-info" style="font-size: 11px"><i class="fa fa-briefcase"></i> {{ $iticket->dept_name }}</span>
                                    <!-- General tools such as edit or delete-->
                                    <div class="tools">
                                        <a href="/tickets/{{ $iticket->id }}"><i class="fa fa-info-circle" style="color: #222F4E" role="button"  data-toggle="tooltip" data-placement="top" title="See details"></i></a>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
                <div class="box-footer clearfix no-border">
	                {!! $inprocess_tickets->render() !!}
	            </div>
            </div>
            <div class="box box-warning">
                <div class="box-header">
                    <i class="fa fa-hourglass-end"></i>
                    <h3 class="box-title">Pending</h3>
                </div>
                <div class="box-body">
                    @if(count($pending_tickets)==0)
                        <em><center>No pending tickets yet.</center></em>
                    @else
                        <ul class="todo-list">
                            @foreach($pending_tickets as $pticket)
                                <li>
                                    <i class="fa fa-circle-o"></i>
                                    <!-- todo text -->
                                    <span class="text"><a href="/tickets/{{ $pticket->id }}">{{ $pticket->ticket_id }}</a> - {{ $pticket->subject }}</span><br/>
                                    <!-- Emphasis label -->
                                    <span class="label label-default sub-time" style="font-size: 11px"><i class="fa fa-clock-o"></i> {{ $pticket->created_at }}</span>
                                    <span class="label label-info" style="font-size: 11px"><i class="fa fa-briefcase"></i> {{ $pticket->dept_name }}</span>
                                    <!-- General tools such as edit or delete-->
                                    <div class="tools">
                                        <a href="/tickets/{{ $pticket->id }}"><i class="fa fa-info-circle" style="color: #222F4E" role="button"  data-toggle="tooltip" data-placement="top" title="See details"></i></a>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </section>
    </div>
@stop

@section('scripts')
	<script src='{{ url("assets/js/jquery-1.11.1.min.js") }}'></script>]
	<script type="text/javascript">
		$(document).ready(function() {
			$(".pagination").addClass('pagination-sm no-margin pull-right')
		});
	</script>
@stop