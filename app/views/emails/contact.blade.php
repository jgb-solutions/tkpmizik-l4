<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf8">
	<title>HTML Email template</title>
</head>
<body>

	<h2>Contact request</h2>
	<div>Somebody sent a contact request, details:</div>

	<div>Subject: {{ $subject }}</div>
	<div>Message: {{ $request }}</div>
</body>
</html>