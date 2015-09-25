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
    @if(Session::has('error'))
        <div class="no-print">
            <div class="callout callout-danger" style="margin-bottom: 0!important;">
                <i class="fa fa-fw fa-danger-circle"></i> &nbsp;{{ Session::get('error') }}
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
                    <!--<a class="btn btn-sm btn-default pull-right" href="/addgroup" role="button">
                    Change Status</a>-->
                    @if($ticket->assignee == $user->id)
	                    <!--<button type="button" class="btn btn-sm btn-default pull-right" data-toggle="modal" data-target="#changeStat">
							<i class="fa fa-check-square"></i> &nbsp;&nbsp;Change Status
						</button>-->
					@endif
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
            		<div class="space"></div>
            		<h4 class="incident-details">Ticket Status:</h4>
            		<span class="label label-{{ $ticket->class }}" style="font-size: 11px">{{ $ticket->status_name }}</span>
            		<br/><br/>
                </div>
                <div class="box-footer clearfix">
                </div>
            </div>
		</section>
		<section class="col-lg-4">
			@if($ticket->assignee==NULL)
				@if($user->role<=1)
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
		        @elseif($user->role==2)
		        	<div class="box box-solid">
		                <div class="box-header with-header incident-header">
		                	<i class="fa fa-user-plus"></i>
		                    <h2 class="box-title">Assign Agent</h2>
		                </div><!-- /.box-header -->
		                <div class="box-body incident-body" style="overflow: hidden; width: auto; height: 250px; text-align: center">
	                		<img src="{{ url('assets/img/account4.png') }}" alt="user image" class="assign-self"><br/>
	                		<a href="/tickets/{{ $ticket->id }}/assign/{{ $user->id }}" class="btn btn-info btn-flat assign-agent">Assign to Self</a>
		                </div>
		                <div class="box-footer clearfix no-border">
		                </div>
		            </div>
		        @endif
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
				                      	@if($user->role < 3 && $user->role > 0) 
				                      		<small>{{ $group->group_name }}</small>
				                      	@elseif($user->role == 4) 
				                      		<small>{{ $dept->dept_name }} Representative</small>
				                      	@elseif($user->role == 0) 
				                      		@if(count($group)==0)
				                      			<small>{{ $dept->dept_name }}</small>
				                      		@else
				                      			<small>{{ $group->group_name }}</small>
				                      		@endif
				                      	@endif
			                    	</p>
			                   	</div>
			                </div>
	                </div>
	                <div class="box-footer clearfix no-border">
	                </div>
	            </div>
	            <div class="box box-solid">
		            <div class="box-header with-header incident-header">
		            	<i class="fa fa-cog"></i>
		                <h2 class="box-title">Actions</h2>
		            </div><!-- /.box-header -->
		            <div class="box-body incident-body">
	        			<div class="col-lg-12">
	        				@if($ticket->status == 5 && $user->role > 1)
	        					<em><center>No action available. <br/>Ticket is already closed.</center></em>
	        				@endif
	        				@if($ticket->status == 3 && $ticket->assignee == $user->id)
	        					<em><center>No action available. Ticket is currently waiting for department representative's acceptance.</center></em>
	        				@endif
	        				@if($ticket->status == 3 && $user->role == 4 && $user->group_number == NULL)
	        					<a class="btn btn-info btn-block" href="/tickets/{{ $ticket->id }}/status/2" role="button">Process Ticket</a>
	        				@endif
		                    @if($ticket->status == 2)
		                    	@if($user->role < 4 && $user->role > 0)
		                			<a class="btn bg-purple btn-block escalate" href="/tickets/{{ $ticket->id }}/status/3" role="button">Escalate to Dept. Representative</a>
		                		@endif
		                		<a class="btn btn-default btn-block close-ticket" href="/tickets/{{ $ticket->id }}/status/5" role="button">Close Ticket</a>
		                	@endif
		                	@if($user->role == 0 && $ticket->status != 5)
	                			<a class="btn btn-danger btn-block cancel-ticket" href="/tickets/{{ $ticket->id }}/status/4" role="button">Cancel Ticket</a>
	                		@endif
	                		@if($user->role < 2 && $ticket->status == 5)
	                			<a class="btn btn-info btn-block reopen-ticket" href="/tickets/{{ $ticket->id }}/status/2" role="button">Reopen Ticket</a>
	                		@endif
		                </div>
		            </div>
		            <div class="box-footer clearfix no-border">
		            </div>
		        </div>
	        @endif
		</section>
		<section class="col-lg-12">
			<div class="row">
				<div class="col-md-12">
					<ul class="timeline">
				        <!-- timeline time label -->
				        <li class="time-label">
				          	<span class="bg-gray">
				            	10 Feb. 2014
				          	</span>
				        </li>
				        <!-- /.timeline-label -->
				        <!-- timeline item -->
				        <li>
				          	<i class="fa fa-comment bg-purple"></i>
				          	<div class="timeline-item">
				            	<span class="time"><i class="fa fa-clock-o"></i> 12:05</span>
				            	<h3 class="timeline-header"><a href="#">Support Team</a></h3>
				            	<div class="timeline-body">
						            Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,
						            weebly ning heekya handango imeem plugg dopplr jibjab, movity
						            jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo kaboodle
						            quora plaxo ideeli hulu weebly balihoo...
						        </div>
					            <div class="timeline-footer">
					              	<a class="btn btn-primary btn-xs">Read more</a>
					              	<a class="btn btn-danger btn-xs">Delete</a>
					            </div>
					        </div>
				        </li>
				        <li>
		                  	<i class="fa fa-clock-o bg-gray"></i>
		                </li>
				    </ul>
				</div>
			</div>
		    <!-- END timeline item -->
		    <div class="row" style="margin-top: 10px;">
		        <div class="col-md-12">
		            <div class="box box-info">
		                <div class="box-header">
		                  	<h3 class="box-title"><i class="fa fa-commenting"></i> Comment</h3>
		                </div>
		                <div class="box-body">
		                	<input type="textarea" class="form-control" placeholder="Enter your comment">
		                </div>
		                <div class="box-footer clearfix no-border">
		                	<button type="submit" class="btn btn-info pull-right">Send</button>
				        </div>
				    </div>
				</div>
			</div>

		    <!-- Modal -->
			<div class="modal fade" id="changeStat" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			  	<div class="modal-dialog" role="document">
			    	<div class="modal-content">
			      		<div class="modal-header">
			        		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			        		<h4 class="modal-title" id="myModalLabel">Change Ticket Status</h4>
			      		</div>
				      	<div class="modal-body">
				      		@foreach($statuses as $status)
				        		<!--<button type="button" class="btn btn-block btn-{{ $status->class }}">{{ $status->status }}</button>-->
				        		<a class="btn btn-{{ $status->class }} btn-block" href="/tickets/{{ $ticket->id }}/status/{{ $status->id }}" role="button">{{ $status->status }}</a>
				        	@endforeach
				        	<!--<button type="button" class="btn btn-warning">Pending</button>
				        	<button type="button" class="btn btn-danger">Cancelled</button>-->
				    	</div>
			    	</div>
			  	</div>
			</div>
		</section>
	</div>
@stop