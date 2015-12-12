@extends('layout.main')

@section('content')

	<div class="col-sm-8">

		<h2 class="text-center">Navige tout mizik {{ $cat->name }} yo</h2>

		<hr>

		@if( count( $mp3s ) > 0 )

		@include('mp3.grid-12')

		<div class="text-center">
			{{ $mp3s->links() }}
		</div>

		@else

		<h3 class="text-center">No {{ $cat->name }} Musics yet</h3>

		@endif

	</div>

@stop