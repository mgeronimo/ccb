@extends('template.dashboard')

@section('title')
	Department - Contact Center ng Bayan
@stop

@section('heads')
    <link rel="stylesheet" href="assets/css/styleadmin.css">
@stop

@section('page-title')
    {{$dept->dept_name}}
@stop

@section('page-desc')
    Agency Profile
@stop

@section('breadcrumb')
     <li>Departments</li>
    <li class="active">Department Profile</li>
@stop

@section('content')
<div class="row">
        <div class="col-xs-8">
            <div class="box box-success">
                <div class="box-header">
                  	<h3 class="box-title col-md-push-9"><strong>{{$dept->dept_name}}</strong></h3>
                  		<a href="/departments/edit/{{ $dept->id }}" class="btn btn-info btn-sm pull-right">
	                    <i class="fa fa-search"></i> Edit
	                  	</a>
                  
                </div><!-- /.box-header -->
             	<div class="box-body">
             		<table  class="table table-bordered" style="margin-bottom:20px">
             			<thead>
		                  	<tr>
			                    <th width="15%" rowspan="2" colspan="3" style="text-align: center">Agency Profile</th>
		                  	</tr>
		                </thead>
		                <tbody>
			                	<tr>
			                		@if($dept->is_member==1)
			                		<td colspan="3">Is a member of ccb: Yes</td>
			                		@else
			                		<td colspan="3" >Is a member of ccb: No</td>
			                		@endif
			                	</tr>
			                	<tr>
			                		<td td rowspan="1" colspan="2">Region: {{$region}}</td>
			                		@if(!$province==null)
			           				<td td rowspan="2" >Province: {{$province}}</td>
			           				@endif
			                	</tr>
		                </tbody>
             		</table>


             		<table  class="table table-bordered ">
             			<thead>
		                  	<tr>
			                    <th width="15%" rowspan="2" colspan="3" style="text-align: center">Agency Contact Details</th>
		                  	</tr>
		                </thead>
		                <tbody>
			                	<tr>
			                		<td> Agency's Head:   @if($dept->agency_head==null)  <em>No Agency head added.</em> @else {{$dept->agency_hed}} @endif</td>
			                	</tr>
			                	<tr>
			                		<td>Email: @if($dept->agency_email==null)  <em>No Email added.</em> @else {{$dept->agency_email}} @endif </td>
			                	</tr>
			                	<tr>
			                		<td>Contact Number: @if($dept->contact==null)  <em>No contact number added.</em> @else {{$dept->contact}} @endif</td>
			                	</tr>
		                </tbody>
             		</table>
             	</div>
            </div>
        </div>
        <div class="col-xs-4">

<div class="box box-solid">
	                <div class="box-header with-header incident-header">
	                 <center>   <h2 class="box-title">Agency Representative</h2> </center>
	                </div><!-- /.box-header -->
	                <div class="box-body incident-body">
                			<div class="item col-lg-12" style="margin-top: 25px; padding: 0px;">
                				@if($rep==null)
                				 <em><center>No Agency Representative.</center></em>
                				 @else
                				<div class="col-lg-12 assigned">
				                    <img src="{{ url('assets/img/account4.png') }}" alt="user image" class="online">
				                    <p class="message">
				                      	<span class="name">
				                      		{{$rep->first_name}} {{$rep->last_name}}
				                      	</span>
				                      		<small>Contact Number: {{$rep->contact_number}}</small>
				                      	
			                    	</p>
			                   	</div>
			                   	@endif
			                </div>
	                </div>
	                <div class="box-footer clearfix no-border">
	                </div>
	            </div>
	        </div>
	      @stop