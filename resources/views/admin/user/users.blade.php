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
	<div class="row">
        <div class="col-md-12">
            <!-- Custom Tabs -->
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                  	<li class="active"><a href="#tab_1" data-toggle="tab">Supervisors</a></li>
                  	<li><a href="#tab_2" data-toggle="tab">Agents</a></li>
                  	<li><a href="#tab_3" data-toggle="tab">Department Representatives</a></li>
                </ul>
	            <div class="tab-content">
	                <div class="tab-pane active" id="tab_1">
	                	<div class="box-body">
		             		<table id="example2" class="table table-bordered table-hover">
		             			<thead>
				                  	<tr>
					                    <th width="15%">User ID</th>
					                    <th width="35%">Name</th>
					                    <th width="35%">Group Name</th>
					                    <th width="15%">Action</th>
				                  	</tr>
				                </thead>
				                <tbody>
				                	@foreach($supervisors as $supervisor)
					                	<tr>
					                		<td>{{ $supervisor->id }}</td>
					                		<td>{{ $supervisor->first_name." ".$supervisor->last_name }}</td>
					                		<td>{{ $supervisor->group_name }}</td>
					                		<td style="text-align: center">
						                		<div class="btn-group">
						                			<a class="btn btn-info btn-sm">
			                    						<i class="fa fa-search"></i> Edit
			                  						</a>
			                  						<a class="btn btn-danger btn-sm">
			                    						<i class="fa fa-trash"></i> Delete
			                  						</a>
			                  					</div>
		                  					</td>
					                	</tr>
					                @endforeach
				                </tbody>
				            </table>
				        </div>
	                </div>
	                <div class="tab-pane" id="tab_2">
	                	<div class="box-body">
		             		<table id="example2" class="table table-bordered table-hover">
		             			<thead>
				                  	<tr>
					                    <th width="15%">User ID</th>
					                    <th width="35%">Name</th>
					                    <th width="35%">Group Name</th>
					                    <th width="15%">Action</th>
				                  	</tr>
				                </thead>
				                <tbody>
				                	@foreach($agents as $agent)
					                	<tr>
					                		<td>{{ $agent->id }}</td>
					                		<td>{{ $agent->first_name." ".$agent->last_name }}</td>
					                		<td>{{ $agent->group_name }}</td>
					                		<td style="text-align: center">
						                		<div class="btn-group">
						                			<a class="btn btn-info btn-sm">
			                    						<i class="fa fa-search"></i> Edit
			                  						</a>
			                  						<a class="btn btn-danger btn-sm">
			                    						<i class="fa fa-trash"></i> Delete
			                  						</a>
			                  					</div>
		                  					</td>
					                	</tr>
					                @endforeach
				                </tbody>
				            </table>
				        </div>
	                </div>
	                <div class="tab-pane" id="tab_3">
	                	<div class="box-body">
		             		<table id="example2" class="table table-bordered table-hover">
		             			<thead>
				                  	<tr>
					                    <th width="15%">User ID</th>
					                    <th width="35%">Name</th>
					                    <th width="35%">Department Name</th>
					                    <th width="15%">Action</th>
				                  	</tr>
				                </thead>
				                <tbody>
				                	@foreach($deptreps as $deptrep)
					                	<tr>
					                		<td>{{ $deptrep->id }}</td>
					                		<td>{{ $deptrep->first_name." ".$deptrep->last_name }}</td>
					                		<td>{{ $deptrep->dept_name }}</td>
					                		<td style="text-align: center">
						                		<div class="btn-group">
						                			<a class="btn btn-info btn-sm">
			                    						<i class="fa fa-search"></i> Edit
			                  						</a>
			                  						<a class="btn btn-danger btn-sm">
			                    						<i class="fa fa-trash"></i> Delete
			                  						</a>
			                  					</div>
		                  					</td>
					                	</tr>
					                @endforeach
				                </tbody>
				            </table>
				        </div>
	                </div>
	            </div>
        	</div>
        </div>
    </div>
@stop