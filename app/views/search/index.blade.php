@extends('layout.main')

@section('title')
	{{ $title }}
@stop

@section('content')

	<div class="col-sm-8">

		@if( count( $results ) > 0 )

		<div class="row bg-black">
			<h2 class="text-center">
				Nou jwenn {{ $results->count() }} rezilta pou: "{{ $query }}"
			</h2>
		</div>
		<hr>

		@include('search.grid-12')

		@else

		<div class="row bg-black">
			<h2 class="text-center">Nou pa jwenn anyen pou: "{{ $query }}"</h2>
		</div>

		@endif

		<div class="text-center">
			{{-- {{ $results->links() }} --}}
		</div>


	</div>

@stop