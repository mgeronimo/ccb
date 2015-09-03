<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Verify Account</title>
</head>
<body>
	<h1>Thanks for signing up!</h1>
	<p>
		We just need you to verify your email address real quick.
		<a href='{{ url("register/confirm/{$user->remember_token}") }}'></a>
	</p>
</body>
</html>