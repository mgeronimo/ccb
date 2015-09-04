@extends('template.dashboard')

@section('title')
	Add Agent to {{ $group->group_name }}
@stop

@section('page-title')
	{{ $group->group_name }}
@stop

@section('page-desc')
	Add agent to group
@stop

@section('breadcrumb')
	<li>Groups</li>
	<li>{{ $group->group_name }}</li>
	<li class="active">Add Agent</li>
@stop

@section('content')

@stop