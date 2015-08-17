@extends('template.layout')
@section('content')
    <body>

        <!-- Top content -->
        <div class="top-content">
        	
            <div class="inner-bg">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-8 col-sm-offset-4">
                           <img src="/assets/img/logo/logo-white-with-icon.png" class="img-responsive logo" width=""></div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 col-sm-offset-3 form-box">
                        	<div class="form-top">
                        		<div class="form-top-left">
                        			<h3>Login to our site</h3>
                            		<p>Enter your username and password to log on:</p>
                        		</div>
                        		<div class="form-top-right">
                        			<i class="fa fa-lock"></i>
                        		</div>
                            </div>
                           
                            <div class="form-bottom">
			                    <form role="form" action="" method="POST" class="login-form" action="{{ url('/auth/login') }}">
			                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                    <div class="form-group">
			                    		<label class="sr-only" for="form-username">Username</label>
			                        	<input type="text" name="username" placeholder="Username..." class="form-username form-control" id="form-username">
			                        </div>
			                        <div class="form-group">
			                        	<label class="sr-only" for="form-password">Password</label>
			                        	<input type="password" name="password" placeholder="Password..." class="form-password form-control" id="form-password">
			                        </div>
                                    @if (count($errors) > 0)
                                    <div class="alert alert-danger" role="alert">
                                    
                                        @foreach ($errors->all() as $error)
                                            {{$error}} <br>
                                        @endforeach
                                    
                                    </div>
                                    @endif
			                        <button type="submit" class="btn raised">Sign in!</button>
                                     <div class="form-group">
                         
                        </div>
			                    </form>
		                    </div>
                        </div>
                    </div>
                   
                </div>
            </div>
            
        </div>
@yield('login')

       