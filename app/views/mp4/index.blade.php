@extends('layout.main')

@section('title')
	{{ $title }}
@stop

@section('content')

<div class="col-sm-8">

	@if ( count( $mp4s ) > 0 )
			<h2 class="text-center">
				<span class="glyphicon glyphicon-facetime-video"></span>
				{{ $title }}
			</h2>
			<hr>
		@include('mp4.grid-12')

		<div class="text-center">
			{{ $mp4s->links() }}
		</div>
	@else
		<h2 class="text-center">Poko gen videyo (-_-)</h2>
	@endif

</div>

@stop