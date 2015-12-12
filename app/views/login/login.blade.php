@extends('layout.nosidebar')

@section('content')

<div class="col-sm-8 col-sm-offset-2">
	<h1 class="text-center">Please Login</h1>

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

		@if( Session::has('error') )
			{{ Session::get('error') }}
		@endif

	</div>

	@include('login.form-login')

	<br>
</div>

@stop