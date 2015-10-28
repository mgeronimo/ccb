<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Verify Account</title>
</head>
<body>
	<h1>Welcome to Contact Center ng Bayan!</h1>
	<p>
		Hello, {{$user->first_name}}!
	</p>
	<p>
		You have been registered as an Agency representative. Please log in to <a href='{{ url("login") }}' >CCB web application</a> to start.
	</p>
</body>
</html>