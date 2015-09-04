<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Verify Account</title>
</head>
<body>
	<h1>Welcome to Contact Center ng Bayan!</h1>
	<p>

		Hello, thank you for signing up! We just need you to verify your email address.<br><br>
		<a href='{{ url("register/confirm/{$user->token}") }}' 
						style="  color: #fff;
 						 background-color: #348eda;
 						 border-color: #46b8da;  
 						 display: inline-block;
  						 padding: 6px 12px;
  						 margin-bottom: 0;
  						 font-size: 14px;
  						 font-weight: normal;
  						 line-height: 1.42857143;
  						 text-align: center;
  						 white-space: nowrap;
  						 vertical-align: middle;
  						 background-image: none;
                         border: 1px solid transparent;
  						 border-radius: 4px;
  						 text-decoration:none; ">  <strong> Confirm Email Address</strong></a>
	</p>
</body>
</html>