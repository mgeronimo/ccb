@extends('template.dashboard')

@section('title')
  Dashboard - Contact Center ng Bayan
@stop
@section('heads')
        <link rel="stylesheet" href='{{url("assets/bower_components/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css")}}'>
        <link rel="stylesheet" href='{{url("assets/bower_components/iCheck/flat/blue.css")}}'>
@stop
@section('content')
  @if(Session::has('errors'))
        <div class="no-print">
            <div class="callout callout-danger" style="margin-bottom: 0!important;">
                <i class="fa fa-fw fa-info-danger-circle"></i> &nbsp;<ul style= "">@foreach($errors->all() as $error)           
                <li> {{ $error }}</li>
                 @endforeach
              </ul>
            </div>

        </div>
    @endif<br>
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Compose Announcement</h3>
                </div><!-- /.box-header -->
                <div class="box-body">

                  <div class="form-group">
                    <form role="form" method="POST" action="{{url('announcement')}}">
                    <input class="form-control" name="subject" placeholder="Subject:">
                  </div>
                  <div class="form-group">
                    <textarea id="compose-textarea" name="message" class="form-control" style="height: 300px">
                   
                    </textarea>
                  </div>
                 
                </div><!-- /.box-body -->
                <div class="box-footer">
                     @if (count($errors) > 0)
                         <div class="alert alert-danger" role="alert">
                                @foreach ($errors->all() as $error)
                                <center>
                                        {{$error}} <br>
                                    @endforeach
                                  </center>
                                </div>
                                @endif
                  <div class="pull-right">
                   <button type="submit" formaction="draftAnnouncement" name="submit1" class="btn btn-default"><i class="fa fa-pencil"></i> Draft</button>
                    <button type="submit" name="submit2" class="btn btn-primary" default><i class="fa fa-envelope-o"></i> Send</button>
                  </div>
                  <a href="cancel-announcement" class="btn btn-default"><i class="fa fa-times"></i> Discard</a>
                </form>
                </div><!-- /.box-footer -->
              </div><!-- /. box -->

@stop
@section('scripts')
<script src='{{ url("assets/js/jquery-1.11.1.min.js") }}'></script>
  <script src='{{ url("assets/bower_components/jquery-validation-1.14.0/dist/jquery.validate.js") }}'></script>
  <script src='{{ url("assets/js/jquery.easing-82496a9/jquery.easing.1.3.js") }}'></script>
          <script src='{{ url("assets/bower_components/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js") }}'></script>

   <script>
      $(function () {
        //Add text editor
        $("#compose-textarea").wysihtml5();
      });
    </script>
@stop
