@extends('template.dashboard')

@section('title')
	Search Result
@stop

@section('heads')
    <link rel="stylesheet" href='{{ url("assets/css/styleadmin.css") }}'>
    <link rel="stylesheet" href='{{ url("assets/plugins/datatables/dataTables.bootstrap.css") }}'>
@stop

@section('page-title')
	Search Results
@stop

@section('page-desc')
	Tickets that contains 
@stop

@section('breadcrumb')
	<li>Tickets</li>
	<li class="active">Search Tickets</li>
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
                <i class="fa fa-fw fa-danger-circle"></i> &nbsp;{{ Session::get('error') }}
            </div>
        </div>
    @endif
    <br/>
@stop