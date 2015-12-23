@extends('layout.nosidebar')

@section('content')

@section('title')
 	{{ $title }}
@stop

@include('user.profile-stats')

<div class="col-sm-8">

	@if ( Session::has('message') )
		<div class="alert alert-info fade in" role="alert">
      		<button type="button" class="close" data-dismiss="alert">
      			<span aria-hidden="true">×</span>
      			<span class="sr-only">Fèmen</span>
      		</button>
      		<h3>{{ Session::get('message') }}</h3>
    	</div>
	@endif

	<div class="bg-danger">

		@if( $errors )
			<ul class="list-unstyled">
				@foreach ( $errors->all('<li>:message</li>') as $error )
					{{ $error }}
				@endforeach
			</ul>
		@endif
	</div>

	<hr class="visible-xs">
	<h3 class="text-center">Ou genyen {{ $mp3count }} Mizik ak {{ $mp4count }} Videyo</h3>

	<hr>

	@if ( $mp3count > 0 )

	@include('mp3.grid-12')

	<div class="text-center">
		<a href="/user/mp3" class="btn btn-primary btn-lg">
			<span class="glyphicon glyphicon-music"></span>
			Tcheke Tout Mizik Ou Yo
		</a>
	</div>

	@else

	<h3 class="text-center">Nou regrèt, men ou poko gen mizik.</h3>
		<p class="text-center">
			<a
				href="/mp3/up"
				class="btn btn-primary btn-lg">
				<span class="glyphicon glyphicon-music"></span>
				Mete Yon Mizik
			</a>
		</p>
	@endif

	@if ( $mp4count > 0 )

	<hr>

	@include('mp4.table')

	<div class="text-center">
		<p>
			<a href="/user/mp4" class="btn btn-danger btn-lg">
				<span class="glyphicon glyphicon-facetime-video"></span>
				Tcheke Tout Videyo Ou Yo
				<span class="glyphicon glyphicon-facetime-video"></span>
			</a>
		</p>
	</div>

	@else

	<hr>
	<h3 class="text-center">Nou regrèt, men ou poko gen videyo.</h3>
	<p class="text-center">
		<a
			href="/mp4/up"
			class="btn btn-danger btn-lg">
			<span class="glyphicon glyphicon-facetime-video"></span>
			Mete Yon Videyo
		</a>
	</p>

	@endif

</div>

@stop