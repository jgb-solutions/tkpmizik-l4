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

	<div class="row bg-black">
		<h3 class="text-center">
			{{ $first_name }} gen {{ $mp3count }} Mizik ak {{ $mp4count }} Videyo
		</h3>
	</div>

	<hr>

	@if ( $mp3count > 0 )

	<div class="row bg-primary">
		<h3 class="text-center">
			<i class="fa fa-music"></i>
			Mizik {{ $first_name }} Yo
		</h3>
	</div>
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

		&nbsp;<hr>
		<div class="row bg-danger">
			<h3 class="text-center">
				<i class="fa fa-video-camera"></i>
				Videyo {{ $first_name }} Yo
			</h3>
		</div>
		<hr>

		@include('mp4.grid-12')

	@else
		&nbsp;<hr>
		<h3 class="text-center">{{ $first_name }} poko gen videyo.</h3>

	@endif

</div>

@stop