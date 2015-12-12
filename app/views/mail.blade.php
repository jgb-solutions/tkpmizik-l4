<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf8">
	<title>Email from {{ $name }}</title>
	<style>
		body {
			background-color: #18A3F9;
			color: white;
    		text-shadow: 1px 1px 1px #000;
    		font-weight: bold;
		}
	</style>
</head>
<body>
	<h2>{{ $name }}</h2>
	<p>{{ $mailMessage }}</p>
</body>
</html>