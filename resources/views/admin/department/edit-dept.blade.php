@extends('template.dashboard')

@section('title')
	Edit Department
@stop

@section('heads')
    <link rel="stylesheet" href="{{ url('assets/css/styleadmin.css') }}">
@stop

@section('page-title')
	{{ $dept->dept_name }}
@stop

@section('page-desc')
	Update Department Details
@stop

@section('breadcrumb')
	<li>Department</li>
	<li class="active">Edit {{ $dept->dept_name }}</li>
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
	<form id="fdesign" method="POST" action="{{url('update-dept')}}">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<input type="hidden" name="dept" value="{{ $dept->id }}">
			<fieldset style="margin: 20px 10%;">
				<h2 class="fs-title">Department Details</h2>
				<div id="this-dept">
					<input type="text" name="dept_name" placeholder="Department Shortname" value="{{ $dept->dept_name }}" required>
				</div>
				<input type="text" name="description" placeholder="Department Description" value="{{ $dept->description }}" required></textarea>
				<div class="checkbox">
					<label class="radio-inline"><strong> Is the department member of CCB?</strong></label>
						<label class="radio-inline"><input type="radio" value="1" id="1" name ="is_member" @if($dept->is_member==1) checked @endif>Yes</label>
	 					<label class="radio-inline"><input type="radio" value="0" id ="2" name ="is_member" @if($dept->is_member==0) checked @endif>No</label>

				</div>
				<a href="/cancel-update-dept" class="action-button btndesign" style="padding: 10px 25px">Cancel</a>
				<button type="submit" name="submit" class="btn btn-primary action-button" default>Submit</button>
			</fieldset>
	</form>
@stop