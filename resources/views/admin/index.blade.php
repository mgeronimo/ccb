@extends('template.dashboard')

@section('title')
    Dashboard - Contact Center ng Bayan
@stop

@section('heads')
    <link rel="stylesheet" href="assets/css/styleadmin.css">
@stop

@section('content')
    <div class="row">
        <div class="box col-md-12">
            <div class="box-header with-border">
                <h3 class="box-title">Groups</h3>
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
                            <td>{{ $group->group_name }}<br>
                            <sub> Supervisor: {{ $group->supervisor }}</sub></td>
                        </tr>
                    @endforeach
                </table>
            </div><!-- /.box-body -->
            <div class="box-footer clearfix">
                <ul class="pagination pagination-sm no-margin pull-right">
                    <li><a href="#">&laquo;</a></li>
                    <li><a href="#">1</a></li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#">&raquo;</a></li>
                </ul>
            </div>
        </div><!-- /.box -->
    </div><!-- ./col -->
@stop


