@extends('layout.main')

@section('content')

	<div class="col-sm-8">

		@if( count( $results ) > 0 )

		<h2 class="text-center">Nou jwenn {{ $results->count() }} rezilta pou: "{{ $query }}"</h2>

		@include('search.grid-12')

		@else

		<h2 class="text-center">Nou pa jwenn anyen pou: "{{ $query }}"</h2>

		@endif

		<div class="text-center">
			{{-- {{ $results->links() }} --}}
		</div>


	</div>

@stop