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
                    <h3>150</h3>
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
                    <h3>53<sup style="font-size: 20px">%</sup></h3>
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
                    <h3>44</h3>
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
                    <h3>65</h3>
                    <p>Rejected Tickets</p>
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
                    <h3 class="box-title">Most Recent Tickets</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <ul class="todo-list">
                        @foreach($tickets as $ticket)
                            <li>
                                <i class="fa fa-circle-o"></i>
                                <!-- todo text -->
                                <span class="text"><a href="#">{{ $ticket->ticket_id }}</a> - {{ $ticket->subject }}</span><br/>
                                <!-- Emphasis label -->
                                <span class="label label-default sub-time" style="font-size: 11px"><i class="fa fa-clock-o"></i> {{ $ticket->created_at }}</span>
                                <span class="label label-info" style="font-size: 11px"><i class="fa fa-briefcase"></i> {{ $ticket->dept_name }}</span>
                                <!-- General tools such as edit or delete-->
                                <div class="tools">
                                    <i class="fa fa-edit"></i>
                                    <i class="fa fa-trash-o"></i>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </section>
        <section class="col-lg-5 connectedSortable">
            <div class="box box-primary">
                <div class="box-header">
                    <i class="fa fa-group"></i>
                    <h3 class="box-title">Groups</h3>
                    <!--<a class="btn btn-sm btn-primary btn-flat pull-right" href="/addgroup" role="button"><i class="ion ion-plus-round"></i> &nbsp;&nbsp;
                    Add Group</a>-->
                </div><!-- /.box-header -->
                <div class="box-body">
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
                </div><!-- /.box-body -->
                <div class="box-footer clearfix no-border">
                    <a class="btn btn-sm btn-default pull-right" href="/addgroup" role="button"><i class="ion ion-plus-round"></i> &nbsp;&nbsp;
                    Add Group</a>
                </div>
                <!-- Pagination -->
                <!--<div class="box-footer clearfix">
                    <ul class="pagination pagination-sm no-margin pull-right">
                        <li><a href="#">&laquo;</a></li>
                        <li><a href="#">1</a></li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#">&raquo;</a></li>
                    </ul>
                </div>-->

            </div><!-- /.box -->
        </section>
    </div>
@stop


