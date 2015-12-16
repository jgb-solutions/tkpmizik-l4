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

	@include('modules.latest-musics')
	@include('modules.latest-videos')
</div>

@stop