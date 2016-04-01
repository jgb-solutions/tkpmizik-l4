<!DOCTYPE html>
<html lang="">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>
		@section('title')
			{{ Config::get('site.slug') }}
		@show
			&mdash; {{ Config::get('site.name') }}
	</title>

	{{-- RSS Feed --}}
	<link
		rel="alternate"
		type="application/rss+xml"
		href="{{ URL::to('/mp3/feed')}}"
		title="MP3 RSS Feed {{ Config::get('site.name') }}">

	<link
		rel="alternate"
		type="application/rss+xml"
		href="{{ URL::to('/mp4/feed')}}"
		title="MP4 RSS Feed {{ Config::get('site.name') }}">

	@include('inc.seo')

	@include('styles')

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->

<!-- 	@if (! App::isLocal() )
	<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
	@endif -->

</head>
<body>

	<div class="container" id="wrapper">

		<div class="row">
			@include('nav')
		</div>
<div class="row">

	@section('search-results')

	<div class="col-sm-12" id="searchResultsDiv">
		<p>@include('search-form')</p>

		<table
			class="noTextCenter table table-striped table-hover table-bordered
			table-condensed">
			<tbody id="searchResults">

				{{-- @include('js-template.search-results-template') --}}

			</tbody>
		</table>

		{{-- <hr> --}}
	</div>

	{{-- Fist ad --}}
	<div class="col-sm-12">
		@include('inc.ads.top')
		<hr>
	</div>

	@show