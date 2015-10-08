@extends('template.dashboard')

@section('title')
	All Users List
@stop

@section('heads')
    <link rel="stylesheet" href="assets/css/styleadmin.css">
@stop

@section('page-title')
    Users
@stop

@section('page-desc')
    List of all CCB Users based on roles
@stop

@section('breadcrumb')
    <li>Dashboard</li>
    <li class="active">Users</li>
@stop

@section('content')
	@if(Session::has('message'))
        <div class="no-print">
            <div class="callout callout-info" style="margin-bottom: 0!important;">
                <i class="fa fa-fw fa-info-circle"></i> &nbsp;{{ Session::get('message') }}
            </div>
        </div><br/>
    @endif
    @if(Session::has('error'))
        <div class="no-print">
            <div class="callout callout-danger" style="margin-bottom: 0!important;">
                <i class="fa fa-fw fa-danger-circle"></i> &nbsp;{{ Session::get('error') }}
            </div>
        </div><br/>
    @endif
	<div class="row">
        <div class="col-md-12">
            <!-- Custom Tabs -->
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs col-md-10">
                  	<li class="active"><a href="#tab_1" data-toggle="tab">Supervisors</a></li>
                  	<li><a href="#tab_2" data-toggle="tab">Agents</a></li>
                </ul>
                <div class="col-md-2">
	                <a class="btn btn-sm btn-primary add-user" href="/add-user" role="button"><i class="ion ion-plus-round"></i> &nbsp;&nbsp;
	                    Add User</a>
	            </div>
	            <div class="tab-content">
	                <div class="tab-pane active" id="tab_1">
	                	<div class="box-body">
	                		@if(count($supervisors)>0)
			             		<table id="example2" class="table table-bordered table-hover">
			             			<thead>
					                  	<tr>
						                    <th width="15%">User ID</th>
						                    <th width="35%">Name</th>
						                    <th width="25%">Agency</th>
						                    <th width="25%">Action</th>
					                  	</tr>
					                </thead>
					                <tbody>
					                	@foreach($supervisors as $supervisor)
						                	<tr>
						                		<td @if($supervisor->is_activated==0) class="deactivated" @endif>{{ $supervisor->id }}</td>
						                		<td @if($supervisor->is_activated==0) class="deactivated" @endif>{{ $supervisor->first_name." ".$supervisor->last_name }}</td>
						                		<td @if($supervisor->is_activated==0) class="deactivated" @endif>{{ $supervisor->agency }}</td>
						                		<td style="text-align: center; font-style: normal;">
							                		<div class="btn-group">
							                			@if($supervisor->is_activated == 0)
								                			<a class="btn btn-success btn-sm activate" href="/users/activate/{{ $supervisor->id }}">
								                				<i class="fa fa-check-circle-o"></i> Activate
								                			</a>
								                		@else
								                			<a class="btn bg-navy btn-sm deactivate" href="/users/deactivate/{{ $supervisor->id }}">
								                				<i class="fa fa-exclamation-circle"></i> Deactivate
								                			</a>
								                		@endif
							                			<a class="btn btn-info btn-sm" href="/users/update/{{ $supervisor->id }}">
				                    						<i class="fa fa-search"></i> Edit
				                  						</a>
				                  						<a class="btn btn-danger btn-sm del-user" href="/users/delete/{{ $supervisor->id }}">
				                    						<i class="fa fa-trash"></i> Delete
				                  						</a>
				                  					</div>
			                  					</td>
						                	</tr>
						                @endforeach
					                </tbody>
					            </table>
					        @else
					        	<em><center>There are no supervisors added yet. <a href="/addgroup">Add a group first!</a></center></em>
	             			@endif
				        </div>
	                </div>
	                <div class="tab-pane" id="tab_2">
	                	<div class="box-body">
	                		@if(count($agents)>0)
			             		<table id="example2" class="table table-bordered table-hover">
			             			<thead>
					                  	<tr>
						                    <th width="15%">User ID</th>
						                    <th width="35%">Name</th>
						                    <th width="25%">Agency</th>
						                    <th width="25%">Action</th>
					                  	</tr>
					                </thead>
					                <tbody>
					                	@foreach($agents as $agent)
						                	<tr>
						                		<td @if($agent->is_activated==0) class="deactivated" @endif>{{ $agent->id }}</td>
						                		<td @if($agent->is_activated==0) class="deactivated" @endif>{{ $agent->first_name." ".$agent->last_name }}</td>
						                		<td @if($agent->is_activated==0) class="deactivated" @endif>{{ $agent->agency }}</td>
						                		<td style="text-align: center">
							                		<div class="btn-group">
							                			@if($agent->is_activated == 0)
								                			<a class="btn btn-success btn-sm activate" href="/users/activate/{{ $agent->id }}">
								                				<i class="fa fa-check-circle-o"></i> Activate
								                			</a>
								                		@else
								                			<a class="btn bg-navy btn-sm deactivate" href="/users/deactivate/{{ $agent->id }}">
								                				<i class="fa fa-exclamation-circle"></i> Deactivate
								                			</a>
								                		@endif
							                			<a class="btn btn-info btn-sm" href="/users/update/{{ $agent->id }}">
				                    						<i class="fa fa-search"></i> Edit
				                  						</a>
				                  						<a class="btn btn-danger btn-sm del-user" href="/users/delete/{{ $agent->id }}">
				                    						<i class="fa fa-trash"></i> Delete
				                  						</a>
				                  					</div>
			                  					</td>
						                	</tr>
						                @endforeach
					                </tbody>
					            </table>
					        @else
					        	<em><center>There are no agents added yet. <a href="/addgroup">Add a group first!</a></center></em>
	             			@endif
				        </div>
	                </div>
	            </div>
        	</div>
        </div>
    </div>
@stop