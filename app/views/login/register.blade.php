@extends('layout.nosidebar')

@section('title')
	{{ $title }}
@stop

@section('content')

<div class="col-sm-12">
	<div class="row bg-black">
		<h1 class="text-center"><i class="fa fa-user"></i> {{ $title }}</h1>
	</div>
	<hr>
</div>

	<div class="col-sm-8 col-sm-offset-2">

	@if ( Session::has('message') )
		<div class="alert alert-warning fade in" role="alert">
      		<button type="button" class="close" data-dismiss="alert">
      			<span aria-hidden="true">×</span>
      			<span class="sr-only">Fèmen</span>
      		</button>
      		<h2>{{ Session::get('message') }}</h2>
    	</div>
	@endif

	@if( count( $errors ) > 0 )

	<div class="panel panel-default">
		<ul class="list-group bg-danger">
			@foreach ( $errors->all('<li class="list-group-item transparent"><b>:message</b></li>') as $error )
				{{ $error }}
			@endforeach
		</ul>
	</div>

	@endif

	@include('login.form-register')

	<br>
</div>

@stop