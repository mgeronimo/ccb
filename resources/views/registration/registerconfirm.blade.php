@extends('template.layout')
@section('content')
    <!-- Top content -->
    <div class="top-content">
    	
        <div class="inner-bg">
            <div class="container">
                <div class="row">
                    <div class="col-sm-8 col-sm-offset-3">
                       <div class="form-top-left headerfont">
                                <p class="headerfont">Hello <strong> {{$user->first_name}}!</strong></p>
                                <p class="headfont">To confirm your account, please register your credentials below:</p>
                            </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6 col-sm-offset-3 form-box">
    
                       
                        <div class="form-bottom">
		                    <form role="form" action="" method="POST" class="login-form" action="{{ url('register/confirm/{token}') }}">
		                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                <div class="form-group">
		                    		<label class="sr-only" for="form-username">Username</label>
		                        	<input type="text" name="username" placeholder="Username..." class="form-username form-control" id="form-username">
		                        </div>
		                        <div class="form-group">
		                        	<label class="sr-only" for="form-password">Password</label>
		                        	<input type="password" name="password" placeholder="Password..." class="form-password form-control" id="form-password">
		                        </div>
                                <div class="form-group">
                                    <label class="sr-only" for="form-username">Contact Number</label>
                                    <input type="text" name="contact_number" placeholder="Contact Number..." class="form-username form-control" id="form-contact">
                                </div>
                                @if (count($errors) > 0)
                                <div class="alert alert-danger" role="alert">
                                
                                    @foreach ($errors->all() as $error)
                                        {{$error}} <br>
                                    @endforeach
                                
                                </div>
                                @endif
		                        <button type="submit" class="btn raised">Confirm Account!</button>
		                    </form>
	                    </div>
                    </div>
                </div>
            </div>
            <br/>
            <footer>
                Copyright 2015. All Rights Reserved.
            </footer>
        </div> 
    </div>
@stop

       