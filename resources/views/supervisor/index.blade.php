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
                            <span class="label label-{{ $ticket->class }}" style="font-size: 11px">{{ $ticket->status_name }}</span>
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
        	@if(count($tickets)==0)
                <a class="btn btn-sm btn-default pull-right" href="#" role="button"><i class="fa fa-search"></i> &nbsp;&nbsp;
                See All Unassigned Tickets</a>
            @elseif($all_unassigned>10)
                <a class="btn btn-sm btn-default pull-right" href="#" role="button"><i class="fa fa-search"></i> &nbsp;&nbsp;
                See All</a>
            @endif
        </div>
    </div>
</section>
<section class="col-lg-5 connectedSortable">
	<div class="box box-primary">
        <div class="box-header">
            <i class="fa fa-group"></i>
            <h3 class="box-title">Group Members</h3>
            <!--<a class="btn btn-sm btn-primary pull-right" href="/addgroup" role="button"><i class="ion ion-plus-round"></i> &nbsp;&nbsp;
            Add Group</a>-->
        </div><!-- /.box-header -->
        <div class="box-body">
            @if(count($members)==0)
                <em><center>No member added yet. Ask the administrator for members.</center></em>
            @else
                <table class="table table-bordered">
                    @foreach($members as $member)
                        <tr>
                        	<td width="20%"><img src="{{ url('assets/img/account4.png') }}" alt="user image" class="members"></td>
                            <td><strong>{{ $member->first_name." ".$member->last_name }}</strong><br/>
                            <sub> Assigned tickets: {{ $member->assigned_tix }}</sub></td>
                        </tr>
                    @endforeach
                </table>
            @endif
        </div><!-- /.box-body -->
        <div class="box-footer clearfix no-border">
            @if($all_members>5)
                <a class="btn btn-sm btn-default pull-right" href="#" role="button"><i class="fa fa-search"></i> &nbsp;&nbsp;
                See All</a>
            @endif
        </div>
    </div>

    <div class="box box-purple">
        <div class="box-header">
            <i class="fa fa-user-plus"></i>
            <h3 class="box-title">Tickets Assigned to Members</h3>
            <!--<a class="btn btn-sm btn-primary pull-right" href="/addgroup" role="button"><i class="ion ion-plus-round"></i> &nbsp;&nbsp;
            Add Group</a>-->
        </div><!-- /.box-header -->
        <div class="box-body">
            @if(count($all_assigned)==0)
                <em><center>No tickets assigned to your members yet.</center></em>
            @else
                <ul class="todo-list">
                    @foreach($all_assigned as $assigned)
                        <li>
                            <i class="fa fa-circle-o"></i>
                            <!-- todo text -->
                            <span class="text"><a href="/tickets/{{ $assigned->id }}" class="to-members">{{ $assigned->ticket_id }}</a> - {{ $assigned->subject }}</span><br/>
                            <!-- Emphasis label -->
                            <span class="label label-default sub-time" style="font-size: 11px"><i class="fa fa-clock-o"></i> {{ $assigned->created_at }}</span>
                            <span class="label bg-navy" style="font-size: 11px"><i class="fa fa-user"></i> {{ $assigned->first_name." ".$assigned->last_name }}</span>
                            <!-- General tools such as edit or delete-->
                            <div class="tools">
                                <a href="/tickets/{{ $assigned->id }}"><i class="fa fa-info-circle" style="color: #222F4E" role="button"  data-toggle="tooltip" data-placement="top" title="See details"></i></a>
                            </div>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div><!-- /.box-body -->
        <div class="box-footer clearfix no-border">
            @if($count_assigned>5)
                <a class="btn btn-sm btn-default pull-right" href="#" role="button"><i class="fa fa-search"></i> &nbsp;&nbsp;
                See All</a>
            @endif
        </div>
    </div>
</section>