@extends('layout.main')

@section('content')

	<div class="col-sm-8">

		<div class="row bg-black">
			<h2 class="text-center">
				<i class="fa fa-music"></i>
				Navige tout mizik {{ $cat->name }} yo
			</h2>
		</div>

		<hr>

		@if( count( $mp3s ) > 0 )

		@include('mp3.grid-12')

		<div class="text-center">
			{{ $mp3s->links() }}
		</div>

		@else

		<h3 class="text-center">Po gen mizik {{ $cat->name }}</h3>

		@endif

	</div>

@stop