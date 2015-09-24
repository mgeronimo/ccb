@extends('template.dashboard')

@section('title')
	Add Group
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
		<input type="hidden" name="_token" value="{{ csrf_token() }}">

				<ul id="progressbar">
					<li class="active">Group Name</li>
					<li>Supervisor's Details</li>
					<li>Agents' Details</li>
				</ul>
				<fieldset>
					<h2 class="fs-title">Enter group name</h2>
					<div id="this-group">
						<input type="text" name="groupname" placeholder="Group Name" required />
					</div>
					<a href="/cancel-add" class="action-button btndesign" style="padding: 10px 25px">Cancel</a>
					<input type="button" id="next" name="next" class="next action-button " value="Next" />
				</fieldset>
			<fieldset>
				<h2 class="fs-title">Supervisor's details</h2>
				<div id="this-sfirstname">
					<input type="text"	name="sfirstname" placeholder="Supervisor's firstname" required>
				</div>
				<div id="this-slastname">
					<input type="text" name="slastname" placeholder="Supervisor's lastname" required/>
				</div>
				<div id="this-semail">
					<input type="email" name="sEmail" placeholder="Email" id="sEmail"/>
				</div>
				<input type="button" id="previous" name="previous" class="previous action-button btndesign" value="Previous" />
				<input type="button" id="next2" name="next" class="next action-button " value="Next" />
			</fieldset>
			<fieldset class="formgroup">
				<h2 class="fs-title">Agent Details</h2>
					<div id="addagent" class="addagent">
						<p>
							<input type="text" class="agentfname" name="agentfname[]" placeholder="First Name" required />
							<input type="text" name="agentlname[]" placeholder="Last Name" required />
							<div id="this-aemail-1">
								<input type="email" name="agentemail[]" class="agentEmail" placeholder="Email"  required/>
							</div>
						</p>
					</div>
				<h3><a href="#" id="addBtn" class="addButton"><i class="fa fa-plus-circle"></i> Add agent </a></h3>
				<input type="button" id="previous" name="previous" class="previous action-button btndesign" value="Previous" />
				<input type="button" id="submit1" name="submit1" class="submit action-button" value="Submit" />

			</fieldset>
		</form>
	</div>
@stop

@include('admin.group.add-group-js')

