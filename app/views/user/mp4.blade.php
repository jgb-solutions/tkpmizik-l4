@extends('layout.nosidebar')

@section('content')

@include('user.profile-stats')

<div class="col-sm-8">

	@if ( Session::has('message') )
		<div class="alert alert-info fade in" role="alert">
      		<button type="button" class="close" data-dismiss="alert">
      			<span aria-hidden="true">×</span>
      			<span class="sr-only">Close</span>
      		</button>
      		<h1>{{ Session::get('message') }}</h1>
    	</div>
	@endif

	<div class="bg-danger">

		@if( $errors )
			<ul class="list-unstyled">
				@foreach ( $errors->all('<li>:message</li>') as $error )
					{{ $error }}
				@endforeach
			</ul>
		@endif

	</div>
	<hr class="visible-xs">
	<h3 class="text-center">Navige Tout Videyo Ou Yo</h3>

	<hr>

	@if( $mp4count > 0 )

	@include('mp4.table')

	<div class="text-center">
		{{ $mp4s->links() }}
	</div>

	@else

	<div class="text-center">
		<h3>Nou regrèt men ou pa gen Videyo</h3>
		<p>
			<a
				href="/mp4/up"
				class="btn btn-danger btn-lg">
				<span class="glyphicon glyphicon-facetime-video"></span>
				Mete Yon Videyo
			</a>
		</p>
	</div>
	@endif
</div>

@stop