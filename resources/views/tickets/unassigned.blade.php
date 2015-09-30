@extends('template.dashboard')

@section('title')
	Unassigned Tickets
@stop

@section('heads')
    <link rel="stylesheet" href='{{ url("assets/css/styleadmin.css") }}'>
@stop

@section('page-title')
	Unassigned Tickets
@stop

@section('page-desc')
	All newly created and unassigned tickets
@stop

@section('breadcrumb')
	<li>Tickets</li>
	<li class="active">Unassigned Tickets</li>
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
	<div class="row">
        <section class="col-lg-12">
            <div class="box box-success" style="min-height: 360px">
                <div class="box-header">
                    <i class="fa fa-hourglass-start"></i>
                    <h3 class="box-title">New Tickets</h3>
                    <div class="box-tools">
                    	<div class="input-group" style="width: 250px;">
	                    	<input type="text" id="search" name="table_search" class="form-control input-sm pull-right" placeholder="Search">
	                    	<div class="input-group-btn">
	                        	<button class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
	                      	</div>
	                    </div>
	                </div>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                	@if(count($unassigned_tickets)==0)
                        <em><center>No tickets added yet.</center></em>
                    @else
                    	<table id="table" class="table table-hover">
                            @foreach($unassigned_tickets as $uticket)
                                <tr>
                                	<td class="ticket-td">
	                                    <i class="fa fa-circle-o"></i>
	                                    <!-- todo text -->
	                                    <span class="text"><a href="/tickets/{{ $uticket->id }}">{{ $uticket->ticket_id }}</a> - {{ $uticket->subject }}</span><br/>
	                                    <!-- Emphasis label -->
	                                    <span class="label label-default sub-time" style="font-size: 11px; margin-left: 20px;"><i class="fa fa-clock-o"></i> {{ $uticket->created_at }}</span>
	                                    <span class="label label-info" style="font-size: 11px"><i class="fa fa-briefcase"></i> {{ $uticket->dept_name }}</span>
	                                </td>
                                </tr>
                            @endforeach
                        </table>
                    @endif
                </div>
                <div class="box-footer clearfix no-border">
	                {!! $unassigned_tickets->render() !!}
	            </div>
            </div>
        </section>
    </div>
@stop

@section('scripts')
	<script src='{{ url("assets/js/jquery-1.11.1.min.js") }}'></script>]
	<script type="text/javascript">
		$(document).ready(function() {
			$(".pagination").addClass('pagination-sm no-margin pull-right')
		});

		// Write on keyup event of keyword input element
	    $("#search").keyup(function(){
	        _this = this;
	        // Show only matching TR, hide rest of them
	        $.each($("#table tbody").find("tr"), function() {
	            console.log($(this).text());
	            if($(this).text().toLowerCase().indexOf($(_this).val().toLowerCase()) == -1)
	               $(this).hide();
	            else
	                 $(this).show();                
	        });
	    }); 


	</script>
@stop