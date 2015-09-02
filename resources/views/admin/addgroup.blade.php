@extends('template.dashboard')

@section('title')
  Dashboard - Contact Center ng Bayan
@stop

@section('heads')
    <link rel="stylesheet" href="assets/css/styleadmin.css">
@stop

@section('page-title')
    Add Group
@stop

@section('breadcrumb')
    <li class="active">Add Group</li>
@stop

@section('content')
	<div class="row">
		<form id="msform" method="POST" action="{{url('/addgroup')}}">
				<ul id="progressbar">
					<li class="active">Group Name</li>
					<li>Supervisor's Details</li>
					<li>Agents' Details</li>
				</ul>
				<fieldset>
					<h2 class="fs-title">Enter group name</h2>
					<input type="text" name="groupname" placeholder="Group Name" class="form-control"required />
					<input type="button" id="next" name="next" class="next action-button" value="Next" />
				</fieldset>
			<fieldset>
				<h2 class="fs-title">Supervisor's details</h2>
				<input type="text"	name="sfirstname" placeholder="Supervisor's firstname" required>
				<input type="text" name="slastname" placeholder="Supervisor's lastname" required/>
				<input type="email" name="sEmail" placeholder="Email" />
				<input type="button" id="previous" name="previous" class="previous action-button" value="Previous" />
				<input type="button" id="next2" name="next" class="next action-button" value="Next" />
			</fieldset>
			<fieldset class="formgroup">
				<h2 class="fs-title">Agent Details</h2>
					<div id="addagent" class="addagent">
						<p>
							<input type="text" name="agentfname[]" placeholder="First Name" required />
							<input type="text" name="agentlname[]" placeholder="Last Name" required />
							<input type="email" name="agentemail[]" placeholder="Email" required/>
						</p>
					</div>
				<h3><a href="#" id="addBtn" class="addButton"><i class="fa fa-plus-circle"></i> Add agent </a></h3>
				<input type="button" id="previous" name="previous" class="previous action-button" value="Previous" />
				<input type="submit" id="submit" id="submit" name="submit" class="submit action-button" value="Submit" />
			</fieldset>
		</form>
	</div>
@stop

@include('admin.group.add-group-js')