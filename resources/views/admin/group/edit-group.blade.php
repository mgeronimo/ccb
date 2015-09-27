@extends('template.dashboard')

@section('title')
	Edit Group
@stop

@section('heads')
    <link rel="stylesheet" href="{{ url('assets/css/styleadmin.css') }}">
@stop

@section('page-title')
	{{ $group->group_name }}
@stop

@section('page-desc')
	Update Group Name
@stop

@section('breadcrumb')
	<li>Groups</li>
	<li class="active">Edit {{ $group->group_name }}</li>
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
            	<i class="fa fa-fw fa-info-circle"></i> &nbsp;{{ Session::get('error') }}
          	</div>
        </div>
	@endif
	@if ($errors->has('group_name'))
    	<div class="no-print">
            <div class="callout callout-danger" style="margin-bottom: 0!important;">
                <i class="fa fa-fw fa-danger-circle"></i> &nbsp;{{ $errors->first('group_name') }}
            </div>
        </div>
    @endif
	<br/>
	<form id="msform" method="POST" action="{{url('/update-group')}}">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<input type="hidden" name="group" value="{{ $group->id }}">
		<fieldset>
			<h2 class="fs-title">Edit Group Name</h2>
			<div id="this-group">
				<input type="text" name="group_name" placeholder="Group Name" value="{{ $group->group_name }}" required />
			</div>
			<a href="/cancel-update-group" class="action-button btndesign" style="padding: 10px 25px">Cancel</a>
			<button type="submit" name="submit" class="btn btn-primary action-button" default>Submit</button>
		</fieldset>
	</form>
@stop