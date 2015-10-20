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
	Tickets that contains '{{ $term }}'
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
    <div class="row">
        <section class="col-lg-12">
            <div class="box box-default" style="min-height: 250px">
                <div class="box-header">
                    <i class="fa fa-hourglass-half"></i>
                    <h3 class="box-title">Results</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    @if(count($results)==0)
                        <em class="no-statement"><center style="padding: 40px">No tickets matched with '{{ $term }}'.</center></em>
                    @else
                        <table id="table" class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Tasks</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($results as $result)
                                <tr>
                                    <td class="ticket-td">
                                        <i class="fa fa-circle-o"></i>
                                        <!-- todo text -->
                                        <span class="text"><a href="/tickets/{{ $result->id }}">{{ $result->ticket_id }}</a> - {{ $result->subject }}</span><br/>
                                        <!-- Emphasis label -->
                                        <span class="label label-default sub-time" style="font-size: 11px"><i class="fa fa-clock-o"></i> {{ $result->created_at }}</span>
                                        <span class="label label-info" style="font-size: 11px"><i class="fa fa-briefcase"></i> </span>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </section>
    </div>
@stop

@section('scripts')
    <script src='{{ url("assets/js/jquery-1.11.1.min.js") }}'></script>
    <script src='{{ url("assets/plugins/datatables/jquery.dataTables.min.js") }}'></script>
    <script src='{{ url("assets/plugins/datatables/dataTables.bootstrap.min.js") }}'></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $(".pagination").addClass('pagination-sm no-margin pull-right')
        });

        $(function () {
            $("#table").DataTable();
        });
    </script>
@stop