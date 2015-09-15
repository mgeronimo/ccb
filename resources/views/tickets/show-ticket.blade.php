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
	</div>
@stop