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
					<h2 class="fs-title">Agency name</h2>
					<div id="this-dept">
						<input type="text" name="dept_name" placeholder="Department Shortname" value="{{$dept->dept_name}}" required>
					</div> 
					<div style= "margin-bottom:10px"> 
					<select class="form-control" name="regname" required>
						    <option value="{{$dept->regcode}}" selected>{{$exist_region}}</option>
						    @foreach($regions as $region)
						    	@if($region->regname!=$exist_region)
  									<option value="{{$region->regcode}}">{{$region->regname}}</option>
  								@endif
  							@endforeach
					</select>
				</div>
					<select class="form-control" name="provname">
							@if($exist_province==null)
						    <option value="null" selected>Select the province of the agency</option>
						    @else
						    <option value="null">None</option>
						    <option value="{{$dept->provcode}}" selected>{{$exist_province}}</option>
						    @endif
						    @foreach($provinces as $province)
						    @if($province->provname!=$exist_province)
  							<option  value="{{$province->provcode}}">{{$province->provname}}</option>
  							@endif
  							@endforeach
					</select>
					<div class="checkbox">
						<label class="radio-inline"><strong> Is the agency member of CCB?</strong></label>
						@if($dept->is_member==1)
  						<label class="radio-inline"><input type="radio" value="1" id="1" name ="is_member" class="checkmember" checked >Yes</label>
 	 					<label class="radio-inline"><input type="radio" value="0" id ="2" name ="is_member" class="checkmember" disabled >No</label>
 	 					@else
 	 					<label class="radio-inline"><input type="radio" value="1" id="1" name ="is_member" class="checkmember"  >Yes</label>
 	 					<label class="radio-inline"><input type="radio" value="0" id ="2" name ="is_member" class="checkmember" checked >No</label>
 	 					@endif

					</div>
					<a href="/cancel-adddept" class="action-button btndesign" style="padding: 10px 25px">Cancel</a>
					<button  id="next" name="next" class="button next action-button " />Next</button>
				</fieldset>
				<fieldset>
					<h2 class="fs-title">Agency's Details</h2>
						<div id="this-person">
							@if($dept->agency_head==null)
						<input type="text" name="agency_head" placeholder="Agency's Head">
							@else
						<input type="text" name="agency_head" value="{{$dept->agency_head}}" placeholder="Agency's Head">
						@endif
					</div> 
					<div id="this-contact">
							@if($dept->contact==null)
						<input type="number" name="contact" placeholder="Contact Number" >
						@else
						<input type="number" name="contact" value="{{$dept->contact}}" placeholder="Contact Number" >
						@endif
					</div> 
					<div id="this-email2">
						@if($dept->agency_email==null)
						<input type="email" name="agency_email" placeholder="Email">
						@else
						<input type="email" name="agency_email" value="{{$dept->agency_email}}" placeholder="Email">
						@endif
					</div> 
				<input type="button" id="previous" name="previous" class="previous action-button btndesign" value="Previous" />
				@if(($dept->is_member)==1)
					<button  id="next2" name="next" class="button next action-button " />Next</button>
				@else
					<button  id="next2" name="next" class="button next action-button " />Submit</button>
				@endif
				</fieldset>

			<fieldset>
				<h2 class="fs-title">Agency representative details</h2>
					@if($deptrep==null)
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
				@else
				<div id="this-sfirstname">
					<input type="text"	name="firstname" value="{{$deptrep->first_name}}" placeholder="Firstname" required>
				</div>
				<div id="this-slastname">
					<input type="text" name="lastname"  value="{{$deptrep->last_name}}"placeholder="Lastname" required/>
				</div>
				<div id="this-scontact">
					<input type="number" name="contact_number" value="{{$deptrep->contact_number}}" placeholder="Contact Number" required/>
				</div>
				<div id="this-email">
					<input type="email" name="email" value="{{$deptrep->email}}"placeholder="Email" id="email"/>
				</div>	
				@endif
				<input type="button" id="previous" name="previous" class="previous action-button btndesign" value="Previous" />

				<input type="button" id="submit1" name="submit1" class="submit action-button" value="Submit" />
			</fieldset>
	</form>
@stop
@include('admin.department.edit-agent-js')