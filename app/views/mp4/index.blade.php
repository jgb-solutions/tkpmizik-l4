@extends('layout.main')

@section('title')
	{{ $title }}
@stop

@section('content')

<div class="col-sm-8">

	@if ( count( $mp4s ) > 0 )
			<div class="row bg-black">
				<h2 class="text-center">
					<i class="fa fa-video-camera"></i>
					{{ $title }}
				</h2>
			</div>
			<hr>
		@include('mp4.grid-12')

		<div class="text-center">
			{{ $mp4s->links() }}
		</div>
	@else
		<div class="row bg-black">
			<h2 class="text-center">Poko gen videyo (-_-)</h2>
		</div>
	@endif

</div>

@stop