@extends('layout.main')

@section('content')

<div class="col-sm-8">

	<h2 class="text-center">Navige Tout Videyo Yo</h2>

	@if ( count( $mp4s ) > 0 )

	@include('mp4.grid-12')

	@endif

	<div class="text-center">
		{{ $mp4s->links() }}
	</div>

</div>

@stop