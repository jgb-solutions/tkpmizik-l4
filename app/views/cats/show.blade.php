@extends('layout.main')

@section('content')

	<div class="col-sm-8">

		<div class="row bg-black">
			<h2 class="text-center">Navige Tout {{ $cat->name }} Yo</h2>
		</div>

		<hr>

		@if( $results->count() > 0 )
		@include('cats.grid-12')

		<div class="col-sm-12 text-center">

			@if ( $mp3count > 0 )

			<p>
				<a
					href="/cat/{{ $cat->slug }}/mp3"
					class="btn btn-primary btn-lg"
				>
					<i class="fa fa-music"></i>
					Tout Mizik {{ $cat->name }} Yo
				</a>
			</p>

			@endif
			@if ( $mp4count > 0 )

			<p>
				<a
					href="/cat/{{ $cat->slug }}/mp4"
					class="btn btn-danger btn-lg"
				>
					<i class="fa fa-video-camera"></i>
					Tout Videyo {{ $cat->name }} Yo
				</a>
			</p>

			@endif

		</div>

		@else

		<h3 class="text-center">Poko gen mizik {{ $cat->name }}</h3>

		@endif

	</div>

@stop