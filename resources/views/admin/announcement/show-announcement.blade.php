@extends('template.dashboard')

@section('title')
	Announcement No. {{ $announcement->id }} - {{ $announcement->subject }}
@stop

@section('heads')
    <link rel="stylesheet" href="assets/css/styleadmin.css">
@stop

@section('page-title')
    Announcement No. {{ $announcement->id }}
@stop

@section('page-desc')
    {{ $announcement->subject }}
@stop

@section('breadcrumb')
    <li>Announcements</li>
    <li class="active">Show Announcement</li>
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
    <div class="box box-primary">
        <div class="box-body" style="font-size: 16px; padding: 20px 25px;">
            {!! $announcement->message !!}
        </div>
        <div class="box-footer clearfix no-border">
            <a class="btn btn-sm btn-default pull-right" href="edit/{{ $announcement->id }}" role="button"><i class="fa fa-edit"></i> &nbsp;&nbsp;Edit</a>
        </div>
    </div>
@stop