@section('seo')

	{{-- SEO --}}
	<meta name="description" content="{{ $mp3->description }}"/>
	<link rel="canonical" href="{{ Config::get('site.url') }}/mp3/{{ $mp3->id }}" />

	{{-- Open Graph --}}
	<meta property="og:title" content="{{ $author }} {{ $mp3->name }}" />
	<meta property="og:description" content="{{ $mp3->description }}" />
	<meta property="og:url" content="{{ Config::get('site.url') }}/mp3/{{ $mp3->id }}" />
	<meta property="fb:admins" content="504535793062337" />
	<meta property="og:image" content="/uploads/images/{{ $mp3->image }}" />
	<meta property="og:site_name" content="{{ $mp3->name }}" />

	{{-- Twitter Graph --}}
	<meta name="twitter:card" content="summary"/>
	<meta name="twitter:description" content="{{ $mp3->description }}"/>
	<meta name="twitter:title" content="{{ ucwords($author) }} {{ $mp3->name }}"/>
	<meta name="twitter:domain" content="{{ Config::get('site.url') }}/mp3/{{ $mp3->id }}"/>
	<meta name="twitter:site" content="{{ Config::get('site.twitter') }}"/>
	<meta name="twitter:image" content="/uploads/images/{{ $mp3->image }}"/>
	<meta name="twitter:creator" content="{{ Config::get('site.twitter') }}"/>
	{{-- /SEO --}}

@stop