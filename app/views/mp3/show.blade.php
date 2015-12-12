@extends('layout.main')

@section('title')
	{{ $title }}
@stop

@section('seo')

	{{-- SEO --}}
	<meta name="description" content="{{ $mp3->description }}"/>
	<link rel="canonical" href="{{ Config::get('site.url') }}/mp3/{{ $mp3->id }}" />

	{{-- Open Graph --}}
	<meta property="og:title" content="{{ $title }}" />
	<meta property="og:description" content="{{ $mp3->description }}" />
	<meta property="og:url" content="{{ Config::get('site.url') }}/mp3/{{ $mp3->id }}" />
	<meta property="fb:admins" content="504535793062337" />
	<meta property="og:image" content="/uploads/images/{{ $mp3->image }}" />
	<meta property="og:site_name" content="{{ $mp3->name }}" />

	{{-- Twitter Graph --}}
	<meta name="twitter:card" content="summary"/>
	<meta name="twitter:description" content="{{ $mp3->description }}"/>
	<meta name="twitter:title" content="{{ $title }}"/>
	<meta name="twitter:domain" content="{{ Config::get('site.url') }}/mp3/{{ $mp3->id }}"/>
	<meta name="twitter:site" content="{{ Config::get('site.twitter') }}"/>
	<meta name="twitter:image" content="/uploads/images/{{ $mp3->image }}"/>
	<meta name="twitter:creator" content="{{ Config::get('site.twitter') }}"/>
	{{-- /SEO --}}

@stop
@section('content')

<div class="col-sm-8">

	@if ( Session::has('message') )
		<div class="alert alert-success fade in" role="alert">
	      <button type="button" class="close" data-dismiss="alert">
	      	<span aria-hidden="true">×</span>
	      	<span class="sr-only">Fèmen</span>
	      </button>
	      <strong>{{ Session::get('message') }}</strong>
	    </div>
	@endif


	@include('mp3.audio-player')

	<h2 class="text-center">
		{{ $mp3->name }}
		<br>
		<small>
			<span class="views_count" data-obj="MP3" data-id="{{ $mp3->id }}">{{ $mp3->views }}</span>
			<span class="glyphicon glyphicon-eye-open"></span> --|--
			<span class="play_count" data-obj="MP3" data-id="{{ $mp3->id }}">{{ $mp3->play }}</span>
			<span class="glyphicon glyphicon-headphones"></span> --|--
			<span class="download_count" data-obj="MP3" data-id="{{ $mp3->id }}">{{ $mp3->download }}</span>
			<span class="glyphicon glyphicon-download"></span>
		</small>
	</h2>
	<p class="text-center text-muted">
		<em>
			Pa <a href="/u/{{ $mp3->user->id }}">{{ $mp3->user->name }}</a>
			Nan <a href="/cat/{{ $mp3->category->slug }}">{{ $mp3->category->name }}</a>
			 {{ date('d/m/Y', strtotime( $mp3->created_at ) ) }}
			a {{ date('g:h a', strtotime( $mp3->created_at ) ) }}
		</em>
	</p>

	<hr>

	<div class="btn-group btn-group-lg">
	  	<a
	  		class="btn btn-success"
	  		href="/mp3/get/{{ $mp3->id }}"
	  		download="{{ $mp3->name }}">
	  		<span class="glyphicon glyphicon-download-alt"></span>
	  		<span class="hidden-484">Telechaje</span>
	  	</a>

	  	@if ( Auth::check() )

	  		@if( Auth::user()->id == $mp3->user_id || User::is_Admin() )

			<a
				href="/mp3/delete/{{ $mp3->id }}"
				onclick="return confirm('Ou Vle Efase {{ $mp3->name }} tout bon?')"
				class="btn btn-danger">
				<span class="glyphicon glyphicon-trash"></span>
				<span class="hidden-484">Efase</span>
			</a>

			<a
				class="btn btn-default"
				href="/mp3/{{ $mp3->id }}/edit">
				<span class="glyphicon glyphicon-edit"></span> Modifye
			</a>

			@endif

			<?php Votee::view('MP3', $mp3->id, $mp3->vote_up, $mp3->vote_down); ?>

	  	@endif

	</div>
	<hr>
	<form class="form-horizontal" role="form">
	  	<div class="form-group">
	    	<label
	    		for="linktext"
	    		class="col-sm-4 control-label">
	    		<span class="glyphicon glyphicon-music"></span>
	    		Music link: </label>
	    	<div class="col-sm-8">
	      	<input
	      		onclick="return this.select()"
	      		type="text"
	      		class="form-control strong"
	      		id="linktext"
	      		value="{{ URL::to("/mp3/$mp3->id") }}">
	    	</div>
	  	</div>
	  	<div class="form-group">
	    	<label
	    		for="downloadlink"
	    		class="col-sm-4 control-label">
	    		<span class="glyphicon glyphicon-download-alt"></span>
	    		Download link:
	    	</label>
	    	<div class="col-sm-8">
	      	<input
	      		onclick="return this.select()"
	      		type="text"
	      		class="form-control strong"
	      		id="downloadlink"
	      		value="{{ URL::to("/mp3/get/$mp3->id") }}">
	    	</div>
	  	</div>
	</form>

	<hr>

	<?php
	$url = Config::get('site.url') . '/mp3/' . $mp3->id;
	$urle = urlencode( $url );
	$name = $mp3->name;
	?>

	@include('inc.sharing')


    @if ( $mp3->description )

    <hr>

	<p class="mp3-desc">{{ $mp3->description }}</p>

    @endif

	<hr>

	{{-- <p class="related">
		<ul class="list list-unstyled">
			@foreach ( $related as $rel )
			<li><a href="/mp3/{{ $rel->id }}">{{ $rel->name }}</a></li>
			@endforeach
		</ul>
	</p> --}}

</div>

@stop