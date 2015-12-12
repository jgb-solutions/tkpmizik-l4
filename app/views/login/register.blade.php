@extends('layout.nosidebar')

@section('content')

	<div class="col-sm-8 col-sm-offset-2">
	<h1 class="text-center">Register A New Account</h1>

	<hr>

	@if ( Session::has('message') )
		<div class="alert alert-warning fade in" role="alert">
      		<button type="button" class="close" data-dismiss="alert">
      			<span aria-hidden="true">×</span>
      			<span class="sr-only">Close</span>
      		</button>
      		<h2>{{ Session::get('message') }}</h2>
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

	@include('login.form-register')

	<br>
</div>

@stop