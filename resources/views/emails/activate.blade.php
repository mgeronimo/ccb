<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Activated Account</title>
</head>
<body>
	<p>
		Hello, {{$user->first_name}}. 
	</p>
	<p>
		We would just like to inform you that your CCB account is now reactivated. You may now log in to the system again using your account credentials:
	</p>
	<blockquote>
		<strong>Username:</strong> {{ $user->username }}<br/>
		<strong>Password:</strong> <em>Your account's password</em>
	</blockquote>
	<p>
		Thank you so much. Have a nice day.
	</p>
</body>
</html>