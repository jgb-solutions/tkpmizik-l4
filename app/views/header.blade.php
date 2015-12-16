<!DOCTYPE html>
<html lang="">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>
		@section('title')
			{{ Config::get('site.description') }}
		@show
			&mdash; {{ Config::get('site.name') }}
	</title>

	<!-- SEO -->
	@section('seo')

	{{-- SEO --}}
	<meta name="description" content="{{ Config::get('site.description') }}"/>
	<link rel="canonical" href="{{ Config::get('site.url') }}" />

	{{-- Open Graph --}}
	<meta property="og:locale" content="ht_HT" />
	<meta property="og:type" content="website" />
	<meta property="og:title" content="{{ Config::get('site.name') }} &mdash; {{ Config::get('site.description') }}" />
	<meta property="og:description" content="{{ Config::get('site.description') }}" />
	<meta property="og:url" content="{{ Config::get('site.url') }}" />
	<meta property="fb:admins" content="504535793062337" />
	<meta property="og:image" content="{{ Config::get('site.logo') }}" />
	<meta property="og:site_name" content="{{ Config::get('site.name') }}" />

	{{-- Twitter Graph --}}
	<meta name="twitter:card" content="summary"/>
	<meta name="twitter:description" content="{{ Config::get('site.description') }}"/>
	<meta name="twitter:title" content="{{ Config::get('site.name') }} &mdash; {{ Config::get('site.description') }}"/>
	<meta name="twitter:domain" content="{{ Config::get('site.name') }}"/>
	<meta name="twitter:site" content="{{ Config::get('site.twitter') }}"/>
	<meta name="twitter:image" content="{{ Config::get('site.logo') }}"/>
	<meta name="twitter:creator" content="{{ Config::get('site.twitter') }}"/>
	{{-- /SEO --}}

	@show
	<!-- / SEO -->

	@include('styles')

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->
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

		<table class="noMarginTopBottom noTextCenter table table-striped table-hover table-bordered table-condensed">
			<tbody id="searchResults">

			@include('js-template.search-results-template')

			</tbody>
		</table>

		{{-- <hr class="noMarginTopBottom"> --}}
	</div>

	@show