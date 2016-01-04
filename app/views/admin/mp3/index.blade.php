@extends('layout.admin')

@section('title')
	{{ $title }}
@stop

@section('search-results')
@stop

@section('content')

<div class="col-sm-12">
	<div class="row bg-black">
		<h1 class="text-center"><i class="fa fa-music"></i> {{ $title }}</h1>
	</div>
	<hr>
	<div class="row">

		<div class="col-sm-6 col-sm-offset-3">
			@include('admin.modules.musics')

			<div class="text-center">
				{{ $mp3s->links() }}
			</div>
		</div>
	</div>
</div>

@stop