@extends('layout.main')

@section('title')
	{{ $title }}
@stop

@section('content')

<div class="col-sm-8">

	@if ( count( $mp3s ) > 0 )
			<h2 class="text-center">
				<span class="glyphicon glyphicon-music"></span>
				{{ $title }}
			</h2>
			<hr>
		@include('mp3.grid-12')

		<div class="text-center">
			{{ $mp3s->links() }}
		</div>
	@else
		<h2 class="text-center">Poko gen mizik (-_-)</h2>
	@endif

</div>

@stop