@extends('template.dashboard')

@section('title')
	Tickets In Process
@stop

@section('heads')
    <link rel="stylesheet" href='{{ url("assets/css/styleadmin.css") }}'>
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
            <div class="box box-info" style="min-height: 360px">
                <div class="box-header">
                    <i class="fa fa-hourglass-half"></i>
                    <h3 class="box-title">Tickets In Process</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                	@if(count($in_process_tickets)==0)
                        <em><center>No tickets added yet.</center></em>
                    @else
                    	<ul class="todo-list">
                            @foreach($in_process_tickets as $ticket)
                                <li>
                                    <i class="fa fa-circle-o"></i>
                                    <!-- todo text -->
                                    <span class="text"><a href="/tickets/{{ $ticket->id }}">{{ $ticket->ticket_id }}</a> - {{ $ticket->subject }}</span><br/>
                                    <!-- Emphasis label -->
                                    <span class="label label-default sub-time" style="font-size: 11px"><i class="fa fa-clock-o"></i> {{ $ticket->created_at }}</span>
                                    <span class="label label-info" style="font-size: 11px"><i class="fa fa-briefcase"></i> {{ $ticket->dept_name }}</span>
                                    <!-- General tools such as edit or delete-->
                                    <div class="tools">
                                        <a href="/tickets/{{ $ticket->id }}"><i class="fa fa-info-circle" style="color: #222F4E" role="button"  data-toggle="tooltip" data-placement="top" title="See details"></i></a>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
                <div class="box-footer clearfix no-border">
	                {!! $in_process_tickets->render() !!}
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