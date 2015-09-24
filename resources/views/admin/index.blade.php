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
                @if($all_unassigned>10)
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
                @elseif($all_groups>10)
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


