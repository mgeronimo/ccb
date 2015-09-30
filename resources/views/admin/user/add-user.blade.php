@extends('template.dashboard')

@section('title')
	Add User
@stop

@section('heads')
    <link rel="stylesheet" href="{{ url('assets/css/styleadmin.css') }}">
@stop

@section('page-title')
	Add User
@stop

@section('page-desc')
	
@stop

@section('breadcrumb')
	<li>User</li>
	<li class="active">Add User</li>
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
    <form id="fdesign" method="POST" action="{{url('add-user')}}">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<fieldset style="margin: 20px 10%;">
			<h2 class="fs-title">User Details</h2>
			<div id="this-dept">
				<input type="text" name="first_name" placeholder="User First Name" required>
				<input type="text" name="last_name" placeholder="User Last Name" required>
				<input type="email" name="email" placeholder="User Email" required>
				<!--<select class="form-control"></select>-->
				{!! Form::select('agency_id', [null=>"--- Select Agency of User ---"] + [0=>"CCB"] + $agencies, Input::old('agency', -1), array('name' => 'agency_id', 'class' => 'input-group form-control')) !!}
				<div class="checkbox">
					<label class="radio-inline"><strong> User Designation: &nbsp;&nbsp;&nbsp;</strong></label>
					<label class="radio-inline"><input type="radio" value="1" id="1" name ="role">Supervisor</label> &nbsp;&nbsp;
					<label class="radio-inline"><input type="radio" value="2" id ="2" name ="role">Agent</label>
				</div>
			</div>
			<a href="/cancel-add-user" class="action-button btndesign" style="padding: 10px 25px">Cancel</a>
			<button type="submit" name="submit" class="btn btn-primary action-button" default style="margin-top: 7px; padding: 9px;">Submit</button>
		</fieldset>
	</form>
@stop