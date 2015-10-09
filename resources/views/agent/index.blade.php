<section class="col-lg-7 connectedSortable">
    <div class="box box-warning">
        <div class="box-header">
            <i class="fa fa-group"></i>
            <h3 class="box-title">Tickets assigned to me</h3>
            <!--<a class="btn btn-sm btn-primary pull-right" href="/addgroup" role="button"><i class="ion ion-plus-round"></i> &nbsp;&nbsp;
            Add Group</a>-->
        </div><!-- /.box-header -->
        <div class="box-body">
            @if(count($assigned_tickets)==0)
                <em><center>No tickets assigned yet. Go and handle some tickets!</center></em>
            @else
                <ul class="todo-list">
                @foreach($assigned_tickets as $assigned_ticket)
                    <li>
                        <i class="fa fa-circle-o"></i>
                        <!-- todo text -->
                        <span class="text"><a href="/tickets/{{ $assigned_ticket->id }}" class="assigned-tix">{{ $assigned_ticket->ticket_id }}</a> - {{ $assigned_ticket->subject }}</span><br/>
                        <!-- Emphasis label -->
                        <span class="label label-default sub-time" style="font-size: 11px"><i class="fa fa-clock-o"></i> {{ $assigned_ticket->created_at }}</span>
                        <span class="label label-warning" style="font-size: 11px"><i class="fa fa-briefcase"></i> {{ $assigned_ticket->dept_name }}</span>
                        <span class="label label-{{ $assigned_ticket->class }}" style="font-size: 11px">{{ $assigned_ticket->status_name }}</span>
                        <!-- General tools such as edit or delete-->
                        <div class="tools">
                            <a href="/tickets/{{ $assigned_ticket->id }}"><i class="fa fa-info-circle" style="color: #222F4E" role="button"  data-toggle="tooltip" data-placement="top" title="See details"></i></a>
                        </div>
                    </li>
                @endforeach
            </ul>
            @endif
        </div><!-- /.box-body -->
        <div class="box-footer clearfix no-border">
            @if(count($assigned_tickets)==0)
                <a class="btn btn-sm btn-default pull-right" href="in-process-tickets" role="button"><i class="fa fa-search"></i> &nbsp;&nbsp;
                See All Unassigned Tickets</a>
            @elseif($all_assigned>10)
                <a class="btn btn-sm btn-default pull-right" href="in-process-tickets" role="button"><i class="fa fa-search"></i> &nbsp;&nbsp;
                See All</a>
            @endif
        </div>
    </div>
</section>
<section class="col-lg-5 connectedSortable">
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
                <a class="btn btn-sm btn-default pull-right" href="unassigned-tickets" role="button"><i class="fa fa-search"></i> &nbsp;&nbsp;
                    See All</a>
            @endif
        </div>
    </div>
</section>