@extends('layout.main')

@section('content')

	<div class="col-sm-8">

		<div class="row bg-black">
			<h2 class="text-center">Navige tout videyo {{ $cat->name }} yo</h2>
		</div>

		<hr>

		@if( count( $mp4s ) > 0 )

		@include('mp4.table')

		<div class="text-center">
			{{ $mp4s->links() }}
		</div>

		@else

		<h3 class="text-center">No {{ $cat->name }} Videos yet</h3>

		@endif

	</div>

@stop