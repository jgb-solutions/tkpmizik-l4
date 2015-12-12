@extends('layout.main')

@section('content')

<div class="col-sm-8">

	@if ( Session::has('message') )
		<div class="alert alert-success fade in" role="alert">
	      <button type="button" class="close" data-dismiss="alert">
	      	<span aria-hidden="true">×</span>
	      	<span class="sr-only">Close</span>
	      </button>
	      <strong>{{ Session::get('message') }}</strong>
	    </div>
	@endif

	@include('mp4.video-player')
	<h2 class="text-center">
		{{ $mp4->name }}
		<br>
		<small>
			<span class="views_count" data-obj="MP4" data-id="{{ $mp4->id }}">{{ $mp4->views }}</span>
			<span class="glyphicon glyphicon-eye-open"></span> --|--
			<span class="download_count" data-obj="MP4" data-id="{{ $mp4->id }}">{{ $mp4->download }}</span>
			<span class="glyphicon glyphicon-download"></span>
		</small>
	</h2>
	<p class="text-center text-muted">
		<em>
			By: <a href="/u/{{ $mp4->user->id }}">{{ $mp4->user->name }}</a>
			In: <a href="/cat/{{ $mp4->category->slug }}">{{ $mp4->category->name }}</a>
			On: {{ date('d/m/Y', strtotime( $mp4->created_at ) ) }}
			at: {{ date('g:h a', strtotime( $mp4->created_at ) ) }}
		</em>
	</p>

	<hr>

	<div class="btn-group btn-group-lg">
	  	<a
	  		class="btn btn-success"
	  		href="/mp4/get/{{ $mp4->id }}"
	  		target="_blank"
	  	>
	  		<span class="glyphicon glyphicon-download-alt"></span>
	  		Download
	  	</a>

	  	@if ( Auth::check() )

	  		@if( Auth::user()->id == $mp4->user_id || Auth::user()->admin == 1 )

			<a
				href="/mp4/delete/{{ $mp4->id }}"
				onclick="return confirm('Are you sure?')"
				class="btn btn-danger">
				<span class="glyphicon glyphicon-trash"></span> Delete
			</a>

			<a
				class="btn btn-default"
				href="/mp4/{{ $mp4->id }}/edit">
				<span class="glyphicon glyphicon-edit"></span> Edit
			</a>

			@endif

			<?php Votee::view('MP4', $mp4->id, $mp4->vote_up, $mp4->vote_down); ?>

	  	@endif
	</div>
	<hr>
	<form class="form-horizontal" role="form">
	  	<div class="form-group">
	    	<label
	    		for="linktext"
	    		class="col-sm-4 control-label">
	    		<span class="glyphicon glyphicon-facetime-video"></span>
	    		Video link: </label>
	    	<div class="col-sm-8">
	      	<input
	      		onclick="return this.select()"
	      		type="text"
	      		class="form-control strong"
	      		id="linktext"
	      		value="{{ URL::to("/mp4/$mp4->id") }}">
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
	      		value="{{ URL::to("/mp4/get/$mp4->id") }}">
	    	</div>
	  	</div>
	</form>

	<hr>

	<?php
	$url = Config::get('site.url') . '/mp4/' . $mp4->id;
	$urle = urlencode( $url );
	$via = "TiKwenPam";
	$name = $mp4->name;
	?>

	@include('inc.sharing')


    @if ( $mp4->description )

    <hr>

	<p class="mp4-desc padding1em bg-info">{{ $mp4->description }}</p>

    @endif

	<hr>

</div>

@stop