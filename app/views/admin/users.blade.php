@extends('layout.admin')

@section('title')
	{{ $title }}
@stop

@section('search-results')
@stop

@section('content')

<div class="col-sm-12">
	<h1 class="text-center">{{ $title }}</h1>
	<hr>
	<div class="row">

		<div class="col-sm-6 col-sm-offset-3">
			@include('admin.modules.users')
		</div>
	</div>
</div>

@stop