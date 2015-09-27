@extends('template.dashboard')

@section('title')
	All Announcements
@stop

@section('heads')
    <link rel="stylesheet" href="assets/css/styleadmin.css">
@stop

@section('page-title')
    Announcements
@stop

@section('page-desc')
    List of all announcements to be posted on the mobile application
@stop

@section('breadcrumb')
    <li class="active">Announcements</li>
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
                  	<h3 class="box-title">Announcement List</h3>
                  	<a class="btn btn-sm btn-primary pull-right" href="/add-announcement" role="button"><i class="ion ion-plus-round"></i> &nbsp;&nbsp;
                    Add Announcement</a>
                </div><!-- /.box-header -->
             	<div class="box-body">
             	@if(count($announcements)>0)
	             		<table id="example2" class="table table-bordered table-hover">
	             			<thead>
			                  	<tr>
				                    <th width="5%">ID</th>
				                    <th width="40%">Title</th>
				                    <th width="25%">Date Posted</th>
				                    <th width="10%">Status</th>
				                    <th width="20%">Action</th>
			                  	</tr>
			                </thead>
			                <tbody>
			                	@foreach($announcements as $announcement)
				                	<tr>
				                		<td>{{ $announcement->id }}</td>
				                		<td><a href="announcements/{{ $announcement->id }}">{{ $announcement->subject }}</a></td>
				                		<td>{{ $announcement->created_at }}</td>
				                		<td>
				                			@if($announcement->status==0)
				                				<span class="label label-default" style="font-size: 11px">Draft</span>
				                			@elseif($announcement->status==1)
				                				<span class="label label-success" style="font-size: 11px">Published</span>
				                			@endif
				                		</td>
				                		<td style="text-align: center">
					                		<div class="btn-group">
					                			<a class="btn btn-info btn-sm" href="announcements/{{ $announcement->id }}">
		                    						<i class="fa fa-search"></i> View
		                  						</a>
		                  						<a class="btn btn-danger btn-sm delete-announcement" href="announcements/delete/{{ $announcement->id }}">
		                    						<i class="fa fa-trash"></i> Delete
		                  						</a>
		                  					</div>
	                  					</td>
				                	</tr>
				                @endforeach
			                </tbody>
	             		</table>
	             	@else
	             		<em><center>There are no announcements added yet. <a href="/add-announcement">Add the first one!</a></center></em>
	             		<br/>
	             	@endif
             	</div>
            </div>
        </div>
    </div>
@stop