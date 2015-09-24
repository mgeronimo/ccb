@extends('template.dashboard')

@section('title')
	Dashboard - Contact Center ng Bayan
@stop

@section('heads')
    <link rel="stylesheet" href="assets/css/styleadmin.css">
@stop

@section('page-title')
    Dashboard
@stop

@section('page-desc')
    Control Panel
@stop

@section('breadcrumb')
    <li class="active">Dashboard</li>
@stop

@section('content')
    @if(Session::has('message'))
        <div class="no-print">
            <div class="callout callout-info" style="margin-bottom: 0!important;">
                <i class="fa fa-fw fa-info-circle"></i> &nbsp;{{ Session::get('message') }}
            </div>
        </div>
    @endif

    <br/>
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-green">
                <div class="inner">
                    <h3>{{ $all_unassigned }}</h3>
                    <p>Unassigned Tickets</p>
                </div>
                <div class="icon">
                    <i class="ion ion-plus-round"></i>
                </div>
                <!-- change into reports link when a reports page is already existing -->
                <a href="tickets" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div><!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-gray">
                <div class="inner">
                    <h3>{{ $closed_tickets }}</h3>
                    <p>Resolved Tickets</p>
                </div>
                <div class="icon">
                    <i class="ion ion-checkmark-circled"></i>
                </div>
                <!-- change into reports link when a reports page is already existing -->
                <a href="tickets" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div><!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3>{{ $ongoing_tickets }}</h3>
                    <p>Ongoing Tickets</p>
                </div>
                <div class="icon">
                    <i class="ion ion-gear-a"></i>
                </div>
                <!-- change into reports link when a reports page is already existing -->
                <a href="tickets" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div><!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-red">
                <div class="inner">
                    <h3>{{ $cancelled_tickets }}</h3>
                    <p>Cancelled Tickets</p>
                </div>
                <div class="icon">
                    <i class="ion ion-close-round"></i>
                </div>
                <!-- change into reports link when a reports page is already existing -->
                <a href="tickets" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div><!-- ./col -->
    </div><!-- /.row -->
    <div class="row">
        @if($user->role==0)
            @include('admin.index')
        @elseif($user->role==1)
	        @include('supervisor.index')
	    @elseif($user->role==2)
		    @include('agent.index')
        @elseif($user->role==4)
            @include('deptrep.index')
	    @endif
    </div>
@stop
