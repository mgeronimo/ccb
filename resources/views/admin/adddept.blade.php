@extends('template.dashboard')

@section('title')
	Add Group
@stop

@section('heads')
    <link rel="stylesheet" href="assets/css/styleadmin.css">
@stop

@section('page-title')
    Add Department
@stop

@section('breadcrumb')
    <li class="active">Add Department</li>
@stop

@section('content')
	<div class="row">
		<form id="fdesign" class="formdesign" method="POST" action="{{url('adddept')}}">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">

				<ul id="progressbar" class="col-md-12 col-md-push-2">
					<li class="active">Department Name</li>
					<li>Department's representative Details</li>
				</ul>
				<fieldset>
					<h2 class="fs-title">Department name</h2>
					<div id="this-dept">
						<input type="text" name="dept_name" placeholder="Department Shortname" required>
					</div>
					<input type="text" name="description" placeholder="Department Description" required></textarea>
					<div class="checkbox">
						<label class="radio-inline"><strong> Is the department member of CCB?</strong></label>
  						<label class="radio-inline"><input type="radio" value="1" id="1" name ="is_member" checked>Yes</label>
 	 					<label class="radio-inline"><input type="radio" value="0" id ="2" name ="is_member">No</label>
					</div>
					<a href="/cancel-adddept" class="action-button btndesign" style="padding: 10px 25px">Cancel</a>
					<input type="button" id="next" name="next" class="next action-button " value="Next" />
				</fieldset>
			<fieldset>
				<h2 class="fs-title">Deparment representative details</h2>
				<div id="this-sfirstname">
					<input type="text"	name="firstname" placeholder="Department representative's firstname" required>
				</div>
				<div id="this-slastname">
					<input type="text" name="lastname" placeholder="Department representative's lastname" required/>
				</div>
				<div id="this-email">
					<input type="email" name="email" placeholder="Department representative's email" id="email"/>
				</div>		
				<input type="button" id="previous" name="previous" class="previous action-button btndesign" value="Previous" />
				<input type="button" id="submit" name="submit" class="submit action-button" value="Submit" />
			</fieldset>
		</form>
	</div>
@stop
@include('admin.department.add-dept-js')

