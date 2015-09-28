<section class="col-lg-4 connectedSortable">
    <div class="box box-success">
        <div class="box-header">
            <i class="fa fa-ticket"></i>
            <h3 class="box-title">New Tickets</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
            @if(count($new_tickets)==0)
                <em><center>No tickets added yet.</center></em>
            @else
                <ul class="todo-list">
                    @foreach($new_tickets as $new_ticket)
                        <li>
                            <i class="fa fa-circle-o"></i>
                            <!-- todo text -->
                            <span class="text"><a href="/tickets/{{ $new_ticket->id }}">{{ $new_ticket->ticket_id }}</a> - {{ $new_ticket->subject }}</span><br/>
                            <!-- Emphasis label -->
                            <span class="label label-default sub-time" style="font-size: 11px"><i class="fa fa-clock-o"></i> {{ $new_ticket->created_at }}</span>
                            <!--<span class="label label-info" style="font-size: 11px"><i class="fa fa-briefcase"></i> {{ $new_ticket->dept_name }}</span>-->
                            <!-- General tools such as edit or delete-->
                            <div class="tools">
                                <a href="/tickets/{{ $new_ticket->id }}"><i class="fa fa-info-circle" style="color: #222F4E" role="button"  data-toggle="tooltip" data-placement="top" title="See details"></i></a>
                            </div>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
        <div class="box-footer clearfix no-border">
        	@if(count($new_tickets)==0)
                <a class="btn btn-sm btn-default pull-right" href="#" role="button"><i class="fa fa-search"></i> &nbsp;&nbsp;
                See All Unassigned Tickets</a>
            @elseif($all_unassigned>5)
                <a class="btn btn-sm btn-default pull-right" href="#" role="button"><i class="fa fa-search"></i> &nbsp;&nbsp;
                See All</a>
            @endif
        </div>
    </div>
</section>
<section class="col-lg-4 connectedSortable">
    <div class="box box-info">
        <div class="box-header">
            <i class="fa fa-ticket"></i>
            <h3 class="box-title">Ongoing Tickets</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
            @if(count($show_ongoing_tickets)==0)
                <em><center>No tickets assigned to you yet.</center></em>
            @else
                <ul class="todo-list">
                    @foreach($show_ongoing_tickets as $ongoing_ticket)
                        <li>
                            <i class="fa fa-circle-o"></i>
                            <!-- todo text -->
                            <span class="text"><a href="/tickets/{{ $ongoing->id }}">{{ $ongoing_ticket->ticket_id }}</a> - {{ $ongoing_ticket->subject }}</span><br/>
                            <!-- Emphasis label -->
                            <span class="label label-default sub-time" style="font-size: 11px"><i class="fa fa-clock-o"></i> {{ $ongoing_ticket->created_at }}</span>
                            <!-- General tools such as edit or delete-->
                            <div class="tools">
                                <a href="/tickets/{{ $ongoing_ticket->id }}"><i class="fa fa-info-circle" style="color: #222F4E" role="button"  data-toggle="tooltip" data-placement="top" title="See details"></i></a>
                            </div>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
        <div class="box-footer clearfix no-border">
            @if(count($show_ongoing_tickets)==0)
                <a class="btn btn-sm btn-default pull-right" href="#" role="button"><i class="fa fa-search"></i> &nbsp;&nbsp;
                See All Unassigned Tickets</a>
            @elseif($ongoing_tickets>5)
                <a class="btn btn-sm btn-default pull-right" href="#" role="button"><i class="fa fa-search"></i> &nbsp;&nbsp;
                See All</a>
            @endif
        </div>
    </div>
</section>
<section class="col-lg-4 connectedSortable">
    <div class="box box-default">
        <div class="box-header">
            <i class="fa fa-ticket"></i>
            <h3 class="box-title">Closed Tickets</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
            @if(count($show_closed_tickets)==0)
                <em><center>No tickets are closed yet.</center></em>
            @else
                <ul class="todo-list">
                    @foreach($show_closed_tickets as $closed_ticket)
                        <li>
                            <i class="fa fa-circle-o"></i>
                            <!-- todo text -->
                            <span class="text"><a href="/tickets/{{ $closed_ticket->id }}">{{ $closed_ticket->ticket_id }}</a> - {{ $closed_ticket->subject }}</span><br/>
                            <!-- Emphasis label -->
                            <span class="label label-default sub-time" style="font-size: 11px"><i class="fa fa-clock-o"></i> {{ $closed_ticket->created_at }}</span>
                            <!-- General tools such as edit or delete-->
                            <div class="tools">
                                <a href="/tickets/{{ $closed_ticket->id }}"><i class="fa fa-info-circle" style="color: #222F4E" role="button"  data-toggle="tooltip" data-placement="top" title="See details"></i></a>
                            </div>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
        <div class="box-footer clearfix no-border">
            @if(count($show_closed_tickets)==0)
                <a class="btn btn-sm btn-default pull-right" href="#" role="button"><i class="fa fa-search"></i> &nbsp;&nbsp;
                See All Unassigned Tickets</a>
            @elseif($closed_tickets>5)
                <a class="btn btn-sm btn-default pull-right" href="#" role="button"><i class="fa fa-search"></i> &nbsp;&nbsp;
                See All</a>
            @endif
        </div>
    </div>
</section>