@extends('layout.nosidebar')

@section('content')

@include('user.profile-stats')

<div class="col-sm-8">

	@if ( Session::has('message') )
		<div class="alert alert-info fade in" role="alert">
      		<button type="button" class="close" data-dismiss="alert">
      			<span aria-hidden="true">×</span>
      			<span class="sr-only">Fèmen</span>
      		</button>
      		<h1>{{ Session::get('message') }}</h1>
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
	<h3 class="text-center">{{ $firstname }} gen {{ $mp3count }} Mizik ak {{ $mp4count }} Videyo</h3>

	<hr>

	@if ( $mp3count > 0 )

	<h3 class="text-center">Mizik {{ $firstname }} Yo</h3>
	<hr>

	@include('mp3.grid-12')

	@else

	<h3 class="text-center">{{ $first_name }} poko gen mizik.</h3>
		<p class="text-center">
			<a
				href="/mp3/up"
				class="btn btn-primary btn-lg">
				<span class="glyphicon glyphicon-music"></span>
				Mete Yon Mizik
				<span class="glyphicon glyphicon-upload"></span>
			</a>
		</p>
	@endif

	@if ( $mp4count > 0 )

		<hr>
		<h3 class="text-center">Videyo {{ $firstname }} Yo</h3>

		@include('mp4.grid-12')

	@else
		&nbsp;<hr>
		<h3 class="text-center">{{ $firstname }} poko gen videyo.</h3>

	@endif

</div>

@stop