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
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3>{{ $unassigned_tickets }}</h3>
                    <p>New Tickets</p>
                </div>
                <div class="icon">
                    <i class="ion ion-plus-round"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div><!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-green">
                <div class="inner">
                    <h3>{{ $closed_tickets }}</h3>
                    <p>Resolved Tickets</p>
                </div>
                <div class="icon">
                    <i class="ion ion-checkmark-circled"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div><!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3>{{ $ongoing_tickets }}</h3>
                    <p>Ongoing Tickets</p>
                </div>
                <div class="icon">
                    <i class="ion ion-gear-a"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
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
                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div><!-- ./col -->
    </div><!-- /.row -->
    <div class="row">
        <section class="col-lg-7 connectedSortable">
            <div class="box box-success">
                <div class="box-header">
                    <i class="fa fa-ticket"></i>
                    <h3 class="box-title">Unassigned Tickets</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    @if(count($tickets)==0)
                        <em><center>No tickets added yet.</center></em>
                    @else
                        <ul class="todo-list">
                            @foreach($tickets as $ticket)
                                <li>
                                    <i class="fa fa-circle-o"></i>
                                    <!-- todo text -->
                                    <span class="text"><a href="/tickets/{{ $ticket->id }}">{{ $ticket->ticket_id }}</a> - {{ $ticket->subject }}</span><br/>
                                    <!-- Emphasis label -->
                                    <span class="label label-default sub-time" style="font-size: 11px"><i class="fa fa-clock-o"></i> {{ $ticket->created_at }}</span>
                                    <span class="label label-info" style="font-size: 11px"><i class="fa fa-briefcase"></i> {{ $ticket->dept_name }}</span>
                                    <!-- General tools such as edit or delete-->
                                    <div class="tools">
                                        <a href="/tickets/{{ $ticket->id }}"><i class="fa fa-info-circle" style="color: #222F4E" role="button"  data-toggle="tooltip" data-placement="top" title="See details"></i></a>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
                <div class="box-footer clearfix no-border">
                    @if($unassigned_tickets>10)
                        <a class="btn btn-sm btn-default pull-right" href="tickets" role="button"><i class="fa fa-search"></i> &nbsp;&nbsp;
                            See All</a>
                    @endif
                </div>
            </div>
        </section>
        <section class="col-lg-5 connectedSortable">
            <div class="box box-primary">
                <div class="box-header">
                    <i class="fa fa-group"></i>
                    <h3 class="box-title">Groups</h3>
                    <a class="btn btn-sm btn-primary pull-right" href="/addgroup" role="button"><i class="ion ion-plus-round"></i> &nbsp;&nbsp;
                    Add Group</a>
                </div><!-- /.box-header -->
                <div class="box-body">
                    @if(count($groups)==0)
                        <em><center>No group added yet.</center></em>
                    @else
                        <table class="table table-bordered">
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>Group Name</th>
                            </tr>
                            @foreach($groups as $group)
                                <tr>
                                    <td>{{ $group->id }}</td>
                                    <td><a href="/group/{{$group->id}}">{{ $group->group_name }}</a><br>
                                    <sub> Supervisor: {{ $group->supervisor }}</sub></td>
                                </tr>
                            @endforeach
                        </table>
                    @endif
                </div><!-- /.box-body -->
                <div class="box-footer clearfix no-border">
                    @if(count($depts)==0)
                        <a class="btn btn-sm btn-primary pull-right" href="/addgroup" role="button"><i class="ion ion-plus-round"></i> &nbsp;&nbsp;
                        Add Group</a>
                    @elseif($unassigned_tickets>10)
                        <a class="btn btn-sm btn-default pull-right" href="#" role="button"><i class="fa fa-search"></i> &nbsp;&nbsp;
                        See All</a>
                    @endif
                </div>

            </div><!-- /.box -->
            <div class="box box-primary">
                <div class="box-header">
                    <i class="fa fa-building-o"></i>
                    <h3 class="box-title">Departments</h3>
                    <a class="btn btn-sm btn-primary pull-right" href="#" role="button"><i class="ion ion-plus-round"></i> &nbsp;&nbsp;
                    Add Department</a>
                </div><!-- /.box-header -->
                <div class="box-body">
                    @if(count($depts)==0)
                        <em><center>No department added yet.</center></em>
                    @else
                        <table class="table table-bordered">

                            <tr>
                                <th style="width: 30%;">Department</th>
                                <th>Description</th>
                            </tr>
                            @foreach($depts as $dept)
                                <tr>
                                    <td><a href="#">{{ $dept->dept_name }}</a></td>
                                    <td>{{ $dept->description }}<br>
                                    <sub> Representative: {{ $dept->dept_rep }}</sub></td>
                                </tr>
                            @endforeach
                        </table>
                    @endif
                </div><!-- /.box-body -->
                <div class="box-footer clearfix no-border">
                    @if(count($depts)==0)
                        <a class="btn btn-sm btn-primary pull-right" href="#" role="button"><i class="ion ion-plus-round"></i> &nbsp;&nbsp;
                        Add Department</a>
                    @elseif($all_depts>5)
                        <a class="btn btn-sm btn-default pull-right" href="#" role="button"><i class="fa fa-search"></i> &nbsp;&nbsp;
                        See All</a>
                    @endif
                </div>
            </div><!-- /.box -->
        </section>
    </div>
@stop


