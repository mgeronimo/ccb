@extends('template.dashboard')

@section('title')
	Edit User
@stop

@section('heads')
    <link rel="stylesheet" href="{{ url('assets/css/styleadmin.css') }}">
@stop

@section('page-title')
	{{ $update_user->first_name.' '.$update_user->last_name }}
@stop

@section('page-desc')
	Update User Details
@stop

@section('breadcrumb')
	<li>User</li>
	<li class="active">Edit Details</li>
@stop

@section('content')
	@if(Session::has('message'))
		<div class="no-print">
          	<div class="callout callout-info" style="margin-bottom: 0!important;">
            	<i class="fa fa-fw fa-info-circle"></i> &nbsp;{{ Session::get('message') }}
          	</div>
        </div>
	@endif
	@if(Session::has('errors'))
        <div class="no-print">
            <div class="callout callout-danger" style="margin-bottom: 0!important;">
                <i class="fa fa-fw fa-info-danger-circle"></i>Error:
                <ul style="margin-left: 35px;">
                    @foreach($errors->all() as $error)           
                        <li> {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif
	<br/>
	<form id="fdesign" method="POST" action="{{url('update-user')}}">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<input type="hidden" name="user" value="{{ $update_user->id }}">
			<fieldset style="margin: 20px 10%;">
				<h2 class="fs-title">User Details</h2>
				<div id="this-dept">
					<input type="text" name="first_name" placeholder="User First Name" value="{{ $update_user->first_name }}" required>
					<input type="text" name="last_name" placeholder="User Last Name" value="{{ $update_user->last_name }}" required>
					<input type="email" name="email" placeholder="User Email" value="{{ $update_user->email }}" required>
					{!! Form::select('agency_id', [null=>"--- Select Agency of User ---"] + [0=>"CCB"] + $agencies, $update_user->agency_id, array('name' => 'agency_id', 'class' => 'input-group form-control')) !!}
					<div class="checkbox">
						<label class="radio-inline"><strong> User Designation: &nbsp;&nbsp;&nbsp;</strong></label>
						<label class="radio-inline"><input type="radio" value="1" id="1" name ="role" {{ $update_user->role == 1 ? 'checked' : '' }}>Supervisor</label> &nbsp;&nbsp;
						<label class="radio-inline"><input type="radio" value="2" id ="2" name ="role" {{ $update_user->role == 2 ? 'checked' : '' }}>Agent</label>
					</div>
				</div>
				<a href="/cancel-update-user" class="action-button btndesign" style="padding: 10px 25px">Cancel</a>
				<button type="submit" name="submit" class="btn btn-primary action-button" default style="margin-top: 7px; padding: 9px;">Submit</button>
			</fieldset>
	</form>
@stop