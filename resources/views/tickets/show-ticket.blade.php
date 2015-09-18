@extends('template.dashboard')

@section('title')
	Ticket No. {{ $ticket->ticket_id }} Details
@stop

@section('heads')
    <link rel="stylesheet" href='{{ url("assets/css/styleadmin.css") }}'>
@stop

@section('page-title')
	Ticket No. {{ $ticket->ticket_id }}
@stop

@section('page-desc')
	Incident date: {{ $ticket->incident_date_time }}
@stop

@section('breadcrumb')
	<li>Tickets</li>
	<li class="active">{{ $ticket->ticket_id }}</li>
@stop

@section('content')
	@if(Session::has('message'))
        <div class="no-print">
            <div class="callout callout-info" style="margin-bottom: 0!important;">
                <i class="fa fa-fw fa-info-circle"></i> &nbsp;{{ Session::get('message') }}
            </div>
        </div>
    @endif
    <br/>
	<div class="row">
		<section class="col-lg-8">
			<div class="box box-solid">
                <div class="box-header with-header incident-header">
                	<i class="fa fa-ticket"></i>
                    <h2 class="box-title"><strong>{{ $ticket->subject }}</strong></h2>
                </div><!-- /.box-header -->
                <div class="box-body incident-body">
                	<h4 class="incident-details">Incident details:</h4>
                	<blockquote>
                		<p>{{ $ticket->message }}</p>
                	</blockquote>
                	<h4 class="incident-details">Agency:</h4>
                	<p class="incident-data"><a href="/department/{{ $dept->id }}">{{ $dept->dept_name }} - {{ $dept->description }}</a></p>
                	<div class="space"></div>
                	<h4 class="incident-details">Complainee:</h4>
            		<p class="incident-data">{{ is_null($ticket->complainee) ? 'None' : $ticket->complainee }}</p>
                </div>
                <div class="box-footer clearfix no-border">
                </div>
            </div>
		</section>
		<section class="col-lg-4">
			@if($ticket->assignee==NULL)
				<div class="box box-solid">
	                <div class="box-header with-header incident-header">
	                	<i class="fa fa-user-plus"></i>
	                    <h2 class="box-title">Assign Agent</h2>
	                </div><!-- /.box-header -->
	                <div class="box-body incident-body" style="overflow: hidden; width: auto; height: 250px;">
                		@foreach($agents as $agent)
                			<div class="item col-lg-12" style="margin-top: 25px; padding: 0px;">
                				<div class="col-lg-8">
				                    <img src="{{ url('assets/img/account4.png') }}" alt="user image" class="online">
				                    <p class="message">
				                      	<span class="name">
				                        	{{ $agent->first_name." ".$agent->last_name }}
				                      	</span>
				                      	<small>Assigned tickets: {{ $agent->assigned_tix }}</small>
			                    	</p>
			                   	</div>
								<div class="col-lg-4">
			                      	<a href="/tickets/{{ $ticket->id }}/assign/{{ $agent->id }}" class="btn btn-success btn-sm btn-flat assign-agent">Assign</a>
			                    </div>
			                </div>
                		@endforeach
	                </div>
	                <div class="box-footer clearfix no-border">
	                </div>
	            </div>
	        @else
	        	<div class="box box-solid">
	                <div class="box-header with-header incident-header">
	                	<i class="fa fa-user-plus"></i>
	                    <h2 class="box-title">Assigned Agent</h2>
	                </div><!-- /.box-header -->
	                <div class="box-body incident-body">
                			<div class="item col-lg-12" style="margin-top: 25px; padding: 0px;">
                				<div class="col-lg-12 assigned">
				                    <img src="{{ url('assets/img/account4.png') }}" alt="user image" class="online">
				                    <p class="message">
				                      	<span class="name">
				                        	{{ $agent->first_name." ".$agent->last_name }}
				                      	</span>
				                      	<small>{{ $group->group_name }}</small>
			                    	</p>
			                   	</div>
			                </div>
	                </div>
	                <div class="box-footer clearfix no-border">
	                </div>
	            </div>
	        @endif
		</section>
	</div>
@stop