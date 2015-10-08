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
                <i class="fa fa-fw fa-danger-circle"></i> &nbsp;{{ Session::get("error") }}
            </div>
        </div>
    @endif
    @if ($errors->has('ticket_comment'))
    	<div class="no-print">
            <div class="callout callout-danger" style="margin-bottom: 0!important;">
                <i class="fa fa-fw fa-danger-circle"></i> &nbsp;{{ $errors->first('ticket_comment') }}
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
                    <span class="label label-{{ $ticket->class }}" style="font-size: 15px; margin-left: 20px">{{ $ticket->status_name }}</span><br/>
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
                	<p class="incident-data">{{ $dept->dept_name }} - {{ $dept->description }}</p>
                	<div class="space"></div>
                	<h4 class="incident-details">Person to Address:</h4>
            		<p class="incident-data">{{ is_null($ticket->complainee) ? 'None' : $ticket->complainee }}</p>
            		<div class="space"></div>
            		<!--<h4 class="incident-details">Ticket Status:</h4>-->
            		@if($ticket->attachments!='')
	            		<div style="height: 15px;"></div>
	            		<h4 class="incident-details">Attachment:</h4>
	            		<p>
	            			<img src="{{ url($ticket->attachments) }}" style="max-width: 100%;">
	            		</p>
	            	@endif
            		<br/>
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
		                <div class="box-body incident-body" style="overflow: auto; width: auto; max-height: 400px; margin-bottom: 10px;">
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
		                	@if($user->role == 1)
		                		<h5 style="text-align: center"><em>or</em></h5>
		                		<a href="/tickets/{{ $ticket->id }}/assign/{{ $user->id }}" class="btn btn-success btn-block assign-self">Assign to Self</a>
		                	@endif
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
				                      		@if($user->agency_id==0)
				                      			<small>CCB</small>
				                      		@else
				                      			<small>{{ $agency->dept_name }}</small>
				                      		@endif
				                      	@elseif($user->role == 4) 
				                      		<small>{{ $dept->dept_name }} Representative</small>
				                      	@elseif($user->role == 0) 
				                      		@if(count($agency)==0)
				                      			<small>CCB</small>
				                      		@else
				                      			<small>{{ $agency->agency_id }}</small>
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
	        				@if($ticket->status == 3 && $user->role > 0)
	        					<em><center>No action available. Ticket is currently waiting for public user's response.</center></em>
	        				@endif
	        					<!--<a class="btn btn-info btn-block" href="/tickets/{{ $ticket->id }}/status/2" role="button">Process Ticket</a>-->
		                    @if($ticket->status == 2)
		                    	@if($user->role < 4 && $user->role > 0)
		                    		@if($user->agency_id != $ticket->dept_id)
		                				<a class="btn bg-purple btn-block escalate" href="/tickets/{{ $ticket->id }}/status/6" role="button">Escalate to Agency</a>
		                			@endif
		                			<a class="btn btn-warning btn-block pending" href="/tickets/{{ $ticket->id }}/status/3" role="button">Change to Pending</a>
		                		@endif
		                		@if($user->role > 0 && $user->role < 3)
		                			<a class="btn bg-maroon btn-block" role="button" data-toggle="modal" data-target="#reassign">Reassign Ticket</a>
		                		@endif
		                		<a class="btn btn-default btn-block close-ticket" href="/tickets/{{ $ticket->id }}/status/5" role="button">Close Ticket</a>
		                	@endif
		                	@if($user->role == 0 && $ticket->status < 4)
	                			<a class="btn btn-danger btn-block cancel-ticket" href="/tickets/{{ $ticket->id }}/status/4" role="button">Cancel Ticket</a>
	                		@endif
	                		@if($ticket->status == 4 && $user->role == 0)
	        					<em><center>No action available. <br/>Ticket is already cancelled.</center></em>
	        				@endif
	                		@if($user->role < 2 && $ticket->status == 5)
	                			<a class="btn btn-info btn-block reopen-ticket" href="/tickets/{{ $ticket->id }}/status/2" role="button">Reopen Ticket</a>
	                		@endif
		                </div>
		            </div>
		            <div class="box-footer clearfix no-border">
		            </div>
		        </div>
		        <div class="box box-solid">
		            <div class="box-header with-header incident-header">
		            	<i class="fa fa-folder"></i>
		                <h2 class="box-title">Category @if($ticket->category!=NULL) : &nbsp;&nbsp;<span class="label label-{{ $ticket->class }}" style="font-size: 15px">{{ $ticket->category==1 ? 'ARTA' : 'Non-ARTA' }}</span> @endif </h2>
		            </div><!-- /.box-header -->
		            @if($ticket->category==NULL)
			            <div class="box-body incident-body">
		        			<div class="col-lg-12">
		        				<form method="POST" action="{{url('/set-category/'.$ticket->id) }}">
			        				<label class="radio-inline"><input type="radio" value="1" id="1" name ="category" class="checkmember" >ARTA</label><br/>
		 	 						<label class="radio-inline"><input type="radio" value="0" id ="2" name ="category" class="checkmember" >Non-ARTA</label>
			                </div>
			            </div>
			            <div class="box-footer clearfix no-border incident-body" style="padding-bottom: 20px">
			            			<div class="col-md-12">
			            				<button type="submit" class="btn btn-block btn-info pull-right">Set Category</button>
			            			</div>
			            		</form>
			            </div>
			        @else
			        	<div class="box-footer clearfix no-border incident-body">
			        	</div>
			        @endif
		        </div>
	        @endif
	        <div class="col-lg-12">
	        	<a class="btn bg-navy btn-lg btn-block" role="button" data-toggle="modal" data-target="#changeStat">View Ticket History</a>
	        </div>
	        <br/>
		</section>
		<section class="col-lg-12">
			@if($ticket->assignee!=NULL)
				<div class="row" style="margin-top: 20px;">
			        <div class="col-md-12">
			            <div class="box box-info">
			                <div class="box-header">
			                  	<h3 class="box-title"><i class="fa fa-commenting"></i> Comment</h3>
			                </div>
			                <form method="POST" action="{{url('/add-comment/'.$ticket->id) }}" enctype="multipart/form-data">
			                <div class="box-body">
			                	<input type="textarea" name="ticket_comment" class="form-control" placeholder="Enter your comment">
			                </div>
			                <div class="box-footer clearfix no-border">
			                	<button type="submit" class="btn btn-info pull-right">Send</button>
			                	<input type="file" class="btn btn-default pull-right" name="attachment" style="margin-right: 10px;" />
					        </div>
					        </form>
					    </div>
					</div>
				</div>
				@if(count($comments)>0)
					<div class="row">
						<div class="col-md-12">
							<ul class="timeline">
						        <!-- timeline time label -->
						        @foreach($comments as $comment)
						        	@if($comment->is_comment==1)
								        <li class="time-label">
								          	<span class="bg-gray">
								            	{{ $comment->created_at->toDateString() }}
								          	</span>
								        </li>
								        <!-- /.timeline-label -->
								        <!-- timeline item -->
								        <li>
								          	<i class="fa fa-comment {{ $comment->commenter_role }} @if($comment->commenter_role < 3) bg-blue @elseif($comment->commenter_role==3) bg-red @elseif($comment->commenter_role == 4) bg-yellow @endif"></i>
								          	<div class="timeline-item">
								            	<span class="time"><i class="fa fa-clock-o"></i> {{ $comment->created_at->toTimeString() }}</span>
								            	<h3 class="timeline-header"><a href="#">{{ $comment->commenter }}</a></h3>
								            	<div class="timeline-body">
										            {{ $comment->comment }}
										        </div>
									        </div>
								        </li>
								    @else
								    	<li>
						                  	<i class="fa fa-ticket bg-aqua"></i>
						                  	<div class="timeline-item bg-log">
						                    	<span class="time"><i class="fa fa-clock-o"></i> {{ $comment->created_at }}</span>
						                    	<h3 class="timeline-header no-border"><a href="#">{{ $comment->commenter }}</a>{{ $comment->comment }}</h3>
						                  	</div>
						                </li>
						            @endif
							    @endforeach
						        <li>
				                  	<i class="fa fa-clock-o bg-gray"></i>
				                </li>
						    </ul>
						</div>
					</div>
				@endif
			    <!-- END timeline item -->
			    
			@endif

		    <!-- Logs Modal -->
			<div class="modal fade" id="changeStat" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			  	<div class="modal-dialog" role="document">
			    	<div class="modal-content">
			      		<div class="modal-header">
			        		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			        		<h4 class="modal-title" id="myModalLabel">Ticket Logs</h4>
			      		</div>
				      	<div class="modal-body" style="padding-top: 0px">
				      		<table class="table">
					      		@foreach($logs as $log)
					        		<tr>
					        			<td class="logs" width="75%"><i class="fa {{$log->class}}" style="color: #3C8DBC"></i> &nbsp;&nbsp;
					        				{!! '<strong>'.$log->logger.'</strong> '.$log->comment !!}
					        			</td>
					        			<td><small class="pull-right log-time"><i class="fa fa-clock-o"></i> {{ $log->created_at }}</small></td>
					        		</tr>
					        	@endforeach
				        	</table>
				        	<!--<button type="button" class="btn btn-warning">Pending</button>
				        	<button type="button" class="btn btn-danger">Cancelled</button>-->
				    	</div>
			    	</div>
			  	</div>
			</div>

			<!-- Co-Agents Modal -->
			<div class="modal fade" id="reassign" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			  	<div class="modal-dialog" role="document">
			    	<div class="modal-content">
			      		<div class="modal-header">
			        		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			        		<h4 class="modal-title" id="myModalLabel">Reassign Ticket</h4>
			      		</div>
				      	<div class="modal-body" style="padding-top: 0px">
				      		<table class="table" style="margin-bottom: 0px">
				      			@if($co_agents!=NULL)
						      		@foreach($co_agents as $co_agent)
						        		<tr>
						        			<td class="logs" width="75%"><i class="fa fa-user" style="color: #3C8DBC"></i> &nbsp;&nbsp;
						        				{{ $co_agent->first_name.' '.$co_agent->last_name }} &nbsp;
						        				<small style="color: #bbb"><em>{{ $co_agent->role == 1 ? 'Supervisor' : 'Agent' }}, {{ $co_agent->dept }}</em></small>
						        			</td>
						        			<td><a href="/tickets/{{ $ticket->id }}/re-assign/{{ $co_agent->id }}" class="btn btn-success btn-sm btn-flat assign-agent">Re-assign</a></td>
						        		</tr>
						        	@endforeach
						        @endif
				        	</table>
				        	<!--<button type="button" class="btn btn-warning">Pending</button>
				        	<button type="button" class="btn btn-danger">Cancelled</button>-->
				    	</div>
			    	</div>
			  	</div>
			</div>
		</section>
	</div>
@stop

@section('scripts')
	<script type="text/javascript">
		$('input[type=file]').bootstrapFileInput();
		$('.file-inputs').bootstrapFileInput();
	</script>
@stop