@extends('template.dashboard')

@section('title')
	All Departments List
@stop

@section('heads')
    <link rel="stylesheet" href="assets/css/styleadmin.css">
@stop

@section('page-title')
    Agency
@stop

@section('page-desc')
    List of all government agencies, and their respective agency representatives
@stop

@section('breadcrumb')
    <li>Dashboard</li>
    <li class="active">Agency</li>
@stop

@section('content')
	@if(Session::has('message'))
        <div class="no-print">
            <div class="callout callout-info" style="margin-bottom: 0!important;">
                <i class="fa fa-fw fa-info-circle"></i> &nbsp;{{ Session::get('message') }}
            </div>
        </div><br/>
    @endif
    @if(Session::has('error'))
        <div class="no-print">
            <div class="callout callout-danger" style="margin-bottom: 0!important;">
                <i class="fa fa-fw fa-danger-circle"></i> &nbsp;{{ Session::get('error') }}
            </div>
        </div><br/>
    @endif
	<div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                  	<h3 class="box-title">Agency List</h3>
              	    <a class="btn btn-sm btn-primary pull-right" href="adddept" role="button"><i class="ion ion-plus-round"></i> &nbsp;&nbsp;
                    Add Agency</a>
                </div><!-- /.box-header -->
             	<div class="box-body">
             		<table id="example2" class="table table-bordered table-hover">
             			<thead>
		                  	<tr>
			                    <th width="15%">Agency ID</th>
			                    <th width="35%">Agency Name</th>
			                    <th width="35%">Agency Representative</th>
			                    <th width="15%">Action</th>
		                  	</tr>
		                </thead>
		                <tbody>
		                	@foreach($departments as $department)
			                	<tr>
			                		<td>{{ $department->id }}</td>
			                		<td>
			                	<a href="departments/{{$department->id}}">		{{ $department->dept_name }}<br/>
			                			<small>{{ $department->description }}</small>
			                		</td>
			                		<td>{{ $department->deptrep_name }}</td>
			                		<td style="text-align: center">
				                		<div class="btn-group">
				                			<a href="/departments/edit/{{ $department->id }}" class="btn btn-info btn-sm">
	                    						<i class="fa fa-search"></i> Edit
	                  						</a>
	                  						<a class="btn btn-danger btn-sm del-dept" href="/departments/delete/{{ $department->id }}">
	                    						<i class="fa fa-trash"></i> Delete
	                  						</a>
	                  					</div>
                  					</td>
			                	</tr>
			                @endforeach
		                </tbody>
             		</table>
             	</div>
            </div>
        </div>
    </div>
@stop

@section('scripts')
	<script src='{{ url("assets/plugins/datatables/jquery.dataTables.min.js") }}'></script>
	<script src='{{ url("assets/plugins/datatables/dataTables.bootstrap.min.js") }}'></script>
	<script src='{{ url("assets/plugins/slimScroll/jquery.slimscroll.min.js") }}'></script>
	<script>
      $(function () {
        $("#example1").DataTable();
        $('#example2').DataTable({
	        "paging": true,
	        "lengthChange": false,
	        "searching": false,
	        "ordering": true,
	        "info": true,
	        "autoWidth": false
        });
      });
    </script>
@stop