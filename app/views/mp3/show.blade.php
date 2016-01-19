@extends('layout.main')

@section('title')
	{{ $title }}
@stop

{{-- @include('inc.seo') --}}

@section('seo')
<?php TKPM::seo($mp3, 'mp3', $author) ?>
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

	<div class="row bg-black">
		<h2 class="text-center">
			{{ $mp3->name }} <small>({{ $mp3->size }})</small>
			<br>
			<small>
				<span class="views_count" data-obj="MP3" data-id="{{ $mp3->id }}">{{ $mp3->views }}</span>
				<i class="fa fa-eye"></i> --|--
				<span class="play_count" data-obj="MP3" data-id="{{ $mp3->id }}">{{ $mp3->play }}</span>
				<i class="fa fa-headphones"></i> --|--
				<span class="download_count" data-obj="MP3" data-id="{{ $mp3->id }}">{{ $mp3->download }}</span>
				<i class="fa fa-download"></i>
			</small>
		</h2>
		<p class="text-center text-muted">
			<em>
				Pa
				@if ( $mp3->user->username )
					<a href="/@{{{ $mp3->user->username }}}">{{ $mp3->user->name }}</a>
				@else
					<a href="/u/{{ $mp3->user->id }}">{{ $mp3->user->name }}</a>
				@endif
				Nan <a href="/cat/{{ $mp3->category->slug }}">{{ $mp3->category->name }}</a>
				{{ $mp3->created_at->format('d/m/Y')}}
				a {{ $mp3->created_at->format('g:h A')}}
			</em>
		</p>
	</div>


	@if ($mp3->description)

    <hr>

	<p class="mp3-desc">{{ $mp3->description }}</p>

    @endif

	<hr>
	<div class="btn-group btn-group-lg">
	  	<a
	  		class="btn btn-success"
	  		href="/mp3/get/{{ $mp3->id }}"
	  		download="{{ $mp3->name }}">
	  		<i class="fa fa-download"></i>
	  		<span class="hidden-484">Telechaje</span>
	  	</a>

	  	@if ( Auth::check() )
	  		<?php $user = Auth::user(); ?>

	  		@if( $user->id == $mp3->user_id || $user::is_admin() )

			<a
				href="/mp3/delete/{{ $mp3->id }}"
				onclick='return confirm("Ou Vle Efase {{ $mp3->name }} tout bon?")'
				class="btn btn-danger">
				<i class="fa fa-trash-o"></i>
				<span class="hidden-484">Efase</span>
			</a>

			<a
				class="btn btn-default"
				href="/mp3/{{ $mp3->id }}/edit">
				<i class="fa fa-edit"></i>
				<span class="hidden-484">Modifye</span>
			</a>

			@endif

			<?php TKPM::vote('MP3', $mp3->id, $mp3->vote_up, $mp3->vote_down); ?>

	  	@endif

	</div>
	<hr>
	<form class="form-horizontal" role="form">
	  	<div class="form-group">
	    	<label
	    		for="linktext"
	    		class="col-sm-4 control-label">
	    		<i class="fa fa-music"></i>
	    		Lyen paj sa a: </label>
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
	    		<i class="fa fa-download"></i>
	    		Telechajman:
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

	<hr>
	@include('inc.ads.bottom')
	<hr>

	@include('mp3.related')

</div>

@stop