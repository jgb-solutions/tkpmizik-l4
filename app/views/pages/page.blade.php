@extends('layout.main')

@section('title')
	{{ $page->title }}
@stop

@section('content')

<div class="col-sm-8">

	<h1 class="text-center">{{ $page->title }}</h1>
	<hr>

	<div id="page-content">{{ $page->content }}</div>
	<p>&nbsp;</p>

</div>

@stop