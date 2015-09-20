@extends('template.dashboard')

@section('title')
	All Groups List
@stop

@section('heads')
    <link rel="stylesheet" href="assets/css/styleadmin.css">
@stop

@section('page-title')
    Groups
@stop

@section('page-desc')
    List of all CCB Groups and their respective supervisor
@stop

@section('breadcrumb')
    <li>Dashboard</li>
    <li class="active">Groups</li>
@stop

@section('content')
	<div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                  	<h3 class="box-title">Group List</h3>
                  	<a class="btn btn-sm btn-primary pull-right" href="/addgroup" role="button"><i class="ion ion-plus-round"></i> &nbsp;&nbsp;
                    Add Group</a>
                </div><!-- /.box-header -->
             	<div class="box-body">
             		<table id="example2" class="table table-bordered table-hover">
             			<thead>
		                  	<tr>
			                    <th width="15%">Group ID</th>
			                    <th width="35%">Name</th>
			                    <th width="35%">Supervisor</th>
			                    <th width="15%">Action</th>
		                  	</tr>
		                </thead>
		                <tbody>
		                	@foreach($groups as $group)
			                	<tr>
			                		<td>{{ $group->id }}</td>
			                		<td>{{ $group->group_name }}</td>
			                		<td>{{ $group->supervisor }}</td>
			                		<td>
				                		<div class="btn-group">
				                			<a class="btn btn-info btn-sm" href="group/{{ $group->id }}">
	                    						<i class="fa fa-search"></i> View
	                  						</a>
	                  						<a class="btn btn-danger btn-sm">
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