@extends('layout.admin')

@section('title')
	{{ $title }}
@stop

@section('search-results')
@stop

@section('content')

<div class="col-sm-12">
	<div class="row bg-black">
		<h1 class="text-center"><i class="fa fa-file"></i> {{ $title }}</h1>
	</div>
	<hr>
	<div class="row">

		<div class="col-sm-6 col-sm-offset-3">
			@include('admin.modules.pages')

			<div class="text-center">
				{{ $pages->links() }}
			</div>

			<p class="text-center">
				<a href="/admin/pages/create" class="btn btn-primary btn-lg">
					<i class="fa fa-file"></i> Kreye Paj
				</a>
			</p>
		</div>
	</div>
</div>

@stop