@extends('layout.main')

@section('title')
	{{ $title }}
@stop

@section('content')

	<div class="col-sm-8">

		<h2 class="text-center">{{ $title }}</h2>
		<hr>

		@if( count( $mp3s ) > 0 )

		@include('mp3.grid-12')

		@endif

		<div class="text-center">
			{{ $mp3s->links() }}
		</div>


	</div>

@stop