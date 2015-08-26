@extends('template.dashboardadmin')

@section('title')
  Dashboard - Contact Center ng Bayan
@stop
@section('content')
<div class="content-wrapper">
  <section class="content-header">
        <h1>
            Dashboard
            <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

          <div class="row">
              <div class="box group col-md-9">
                <div class="box-header with-border">
                  <h3 class="box-title">Groups</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table class="table table-bordered">
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Group Name</th>
                    </tr>
                    <tr>
                      <td>1.</td>
                      <td>Update software<br>
                        <sub> Supervisor: </sub></td>
                    </tr>
                    <tr>
                      <td>2.</td>
                      <td>Clean database<br>
                        <sub> Supervisor: </sub></td>
                    </tr>
                    <tr>
                      <td>3.</td>
                      <td>Cron job running<br>
                        <sub> Supervisor: </sub></td>
                    </tr>
                    <tr>
                      <td>4.</td>
                      <td>Fix and squish bugs<br>
                        <sub> Supervisor: </sub></td>
                    </tr>
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
              <div class="col-lg-2 col-xs-2 .col-md-3">
                <!-- small box -->
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3>150</h3>
                        <p>New Group</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-plus-round"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
                </div>
      
            </div><!-- ./col -->
          </div>

          </div>

          </section>
@stop


