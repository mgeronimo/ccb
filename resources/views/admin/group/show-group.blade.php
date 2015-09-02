@extends('template.dashboard')

@section('title')
	Group Details - {{ $group->group_name }}
@stop

@section('page-title')
	{{ $group->group_name }}
@stop

@section('page-desc')
	Group details
@stop

@section('breadcrumb')
	<li>Groups</li>
	<li class="active">{{ $group->group_name }}</li>
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
	<div class="box box-primary">
		<div class="box-header with-border">
			<h3 class="box-title">Supervisor</h3>
			<a class="btn btn-xs btn-default pull-right" href="#" role="button"><i class="fa fa-fw fa-user"></i> &nbsp;&nbsp;Change Supervisor</a>
		</div>
		<div class="box-body" style="font-size: 15px">
			<strong>Name:</strong> &nbsp;&nbsp;
			{{ $supervisor->first_name." ".$supervisor->last_name }}
		</div>
	</div>
	<div class="box box-warning">
		<div class="box-header with-border">
			<h3 class="box-title">Agents</h3>
			<a class="btn btn-xs btn-default pull-right" href="#" role="button"><i class="fa fa-fw fa-user-plus"></i> &nbsp;&nbsp;Add Agent(s)</a>
		</div>
		<div class="box-body no-padding">
			<table class="table table-striped">
				<tbody>
					<tr>
						<th style="width: 70px">ID #</th>
						<th>Agent Name</th>
						<th>Action</th>
					</tr>
					@foreach($agents as $agent)
						<tr>
							<td>{{ $agent->id }}</td>
							<td>{{ $agent->first_name." ".$agent->last_name }}</td>
							<td><a class="btn btn-sm btn-danger" href="/agent/delete/{{ $agent->id }}" role="button"><i class="fa fa-fw fa-trash"></i></a></td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>

@stop