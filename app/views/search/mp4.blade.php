@extends('layout.main')

@section('content')

	<div class="col-sm-8">

		@if( count( $results ) > 0 )

		<h2 class="text-center">Nou jwenn {{ $results->count() }} Videyo pou: "{{ $query }}"</h2>

		@include('mp4.grid-12')

		@else

		<h2 class="text-center">Nou pa jwenn videyo ki rele: "{{ $query }}"</h2>

		@endif

		<div class="text-center">
			{{ $results->links() }}
		</div>


	</div>

@stop