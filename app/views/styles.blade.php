@if ( App::isLocal() )
	<link rel="stylesheet" type="text/css" href="{{ TKPM::asset('css/all.css') }}">
@else
	<link rel="stylesheet" type="text/css" href="{{ TKPM::asset('css/app.css') }}">
	<link
		rel="stylesheet"
		href="//maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
@endif