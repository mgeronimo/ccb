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

		<form id="fdesign" method="POST" action="{{url('adddept')}}">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">

				<ul id="progressbar" class="col-md-12 col-md-push-2">
					<li class="active">Department Name</li>
					<li>Department's representative Details</li>
				</ul>
				<fieldset>
					<h2 class="fs-title">Agency name</h2>
					<div id="this-dept">
						<input type="text" name="dept_name" placeholder="Department Shortname" required>
					</div> 
					<div style= "margin-bottom:10px"> 
					<select class="form-control" name="regname" required>
						    <option disabled selected>Select the region of the agency</option>
						    @foreach($regions as $region)
  									<option value="{{$region->regcode}}">{{$region->regname}}</option>
  							@endforeach
					</select>
				</div>
					<select class="form-control" name="provname">
						    <option value="null" selected>Select the province of the agency</option>
						    @foreach($provinces as $province)
  							<option  value="{{$province->provcode}}">{{$province->provname}}</option>
  							@endforeach
					</select>
					<div class="checkbox">
						<label class="radio-inline"><strong> Is the agency member of CCB?</strong></label>
  						<label class="radio-inline"><input type="radio" value="1" id="1" name ="is_member" class="checkmember" >Yes</label>
 	 					<label class="radio-inline"><input type="radio" value="0" id ="2" name ="is_member" class="checkmember" checked>No</label>

					</div>
					<a href="/cancel-adddept" class="action-button btndesign" style="padding: 10px 25px">Cancel</a>
					<button  id="next" name="next" class="button next action-button " />Submit</button>
				</fieldset>
			<fieldset>
				<h2 class="fs-title">Agency representative details</h2>
				<div id="this-sfirstname">
					<input type="text"	name="firstname" placeholder="Firstname" required>
				</div>
				<div id="this-slastname">
					<input type="text" name="lastname" placeholder="Lastname" required/>
				</div>
				<div id="this-scontact">
					<input type="number" name="contact_number" placeholder="Contact Number" required/>
				</div>
				<div id="this-email">
					<input type="email" name="email" placeholder="Email" id="email"/>
				</div>		
				<input type="button" id="previous" name="previous" class="previous action-button btndesign" value="Previous" />

				<input type="button" id="submit1" name="submit1" class="submit action-button" value="Submit" />
			</fieldset>
		</form>
	</div>
@stop

@include('admin.department.add-dept-js')

