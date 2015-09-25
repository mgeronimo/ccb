@extends('template.dashboard')

@section('title')
	Add Agent to {{ $group->group_name }}
@stop

@section('heads')
    <link rel="stylesheet" href='{{ url("assets/css/styleadmin.css") }}'>
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
	@if(Session::has('message'))
        <div class="no-print">
            <div class="callout callout-info" style="margin-bottom: 0!important;">
                <i class="fa fa-fw fa-info-circle"></i> &nbsp;{{ Session::get('message') }}
            </div>
        </div>
    @endif
	<div class="row">
		<br/>
		<form id="msform" method="POST" action="/group/{{$group->id}}/add-agent">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<fieldset class="formgroup">
				<h2 class="fs-title">Agent Details</h2>
					<div id="addagent" class="addagent">
						<div id="fields1">
							<!--<input type="text" class="agentfname" name="first_name[]" placeholder="First Name" value="{{ Input::get('first_name', '') }}" required />-->
							<input type="text" class="agentfname" name="first_name[]" placeholder="First Name" value="{{ Input::get('first_name', '') }}" required />
							<input type="text" name="last_name[]" placeholder="Last Name" value="{{ Input::get('last_name', '') }}" required />
							<div id="this-aemail-1">
								<!--<input type="email" name="email[]" placeholder="Email" value="{{ Input::get('email[]', '') }}" required/>-->
								<input type="email" name="email[]" placeholder="Email" value="{{ Input::get('email', '') }}" required/>
							</div>
						</div>
					</div>
				<h3><a href="#" id="addBtn" class="addButton add-more"><i class="fa fa-plus-circle"></i> Add agent </a></h3>
				
				<input type="submit" id="submit-additional-agent" class="submit action-button" value="Submit" />
			</fieldset>
		</form>
	</div>
@stop

@include('admin.group.add-agent-js')