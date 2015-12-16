@extends('layout.main')

@section('title')
	{{ $title }}
@stop

@include('inc.seo')

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

	  		@if( Auth::user()->id == $mp3->user_id || User::is_admin() )

			<a
				href="/mp3/delete/{{ $mp3->id }}"
				onclick='return confirm("Ou Vle Efase {{ $mp3->name }} tout bon?")'
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