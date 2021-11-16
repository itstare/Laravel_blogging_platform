<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
</head>
<body>
	
	<h2>You have received message from {{ $name }}</h2>
	<h5>Answer to: {{ $email }}</h5>
	<hr>
	<div>
		<strong>{{ $subject }}</strong>
		<p>{{ $mail_message }}</p>
	</div>

</body>
</html>