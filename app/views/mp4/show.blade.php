@extends('layout.main')

@section('content')

@section('seo')
<?php TKPM::seo($mp4, 'mp4', $author) ?>
@stop

@section('title')
{{ $title }}
@stop

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
	<div class="row bg-black">
		<h2 class="text-center">
		{{ $title }}
		<br>
		<small>
			<span class="views_count" data-obj="MP4" data-id="{{ $mp4->id }}">{{ $mp4->views }}</span>
			<i class="fa fa-eye"></i> --|--
			<span class="download_count" data-obj="MP4" data-id="{{ $mp4->id }}">{{ $mp4->download }}</span>
			<i class="fa fa-download"></i>
		</small>
		</h2>
		<p class="text-center text-muted">
			<em>
				Pa
					@if ( $mp4->user->username )
					<a href="/@{{{ $mp4->user->username }}}">{{ $mp4->user->name }}</a>
				@else
					<a href="/u/{{ $mp4->user->id }}">{{ $mp4->user->name }}</a>
				@endif
				Nan <a href="/cat/{{ $mp4->category->slug }}">{{ $mp4->category->name }}</a>
					{{ $mp4->created_at->format('d/m/Y')}}
				a {{ $mp4->created_at->format('g:h A')}}
			</em>
		</p>
	</div>

	@if ( $mp4->description )

    <hr>
	<p>{{ $mp4->description }}</p>

    @endif

	<hr>

	<div class="btn-group btn-group-lg">
	  	<a
	  		class="btn btn-success"
	  		href="/mp4/get/{{ $mp4->id }}"
	  		target="_blank"
	  	>
	  		<i class="fa fa-download"></i>
	  		<span class="hidden-484">Telechaje</span>
	  	</a>

	  	@if ( Auth::check() )

	  		@if( Auth::user()->id == $mp4->user_id || Auth::user()->admin == 1 )

			<a
				href="/mp4/delete/{{ $mp4->id }}"
				onclick="return confirm('Are you sure?')"
				class="btn btn-danger">
				<i class="fa fa-trash-o"></i> Efase
			</a>

			<a
				class="btn btn-default"
				href="/mp4/{{ $mp4->id }}/edit">
				<i class="fa fa-edit"></i> Modifye
			</a>

			@endif

			<?php TKPM::vote('MP4', $mp4->id, $mp4->vote_up, $mp4->vote_down); ?>

	  	@endif
	</div>

	<hr>
	<form class="form-horizontal" role="form">
	  	<div class="form-group">
	    	<label
	    		for="linktext"
	    		class="col-sm-4 control-label">
	    		<i class="fa fa-video-camera"></i>
	    		Lyen Videyo a: </label>
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
	    		<i class="fa fa-download"></i>
	    		Telechajman:
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

	<hr>
	@include('inc.ads.bottom')
	<hr>

	@include('mp4.related')

</div>

@stop