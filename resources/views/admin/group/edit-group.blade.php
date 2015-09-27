@extends('template.dashboard')

@section('title')
	Edit Group
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
	<div class="box box-primary">
		<div class="box-header with-border">
			<h3 class="box-title">Edit Group Name</h3>
		</div>
		<div class="box-body" style="font-size: 15px">
			<form method="POST" action="{{url('/update-group')}}">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<input type="hidden" name="group" value="{{ $group->id }}">
				<div class="row">
					<div class="col-lg-10">
						<input type="text" name="group_name" class="form-control" value="{{ $group->group_name }}" />
					</div>
					<div class="col-lg-2">
						<button type="submit" name="submit" class="btn btn-block btn-primary" default>Submit</button>
					</div>
				</div>
			</form>
		</div>
	</div>
@stop