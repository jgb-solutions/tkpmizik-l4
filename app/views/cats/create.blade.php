@extends('layout.nosidebar')

@section('title')
	{{ $title }}
@stop

@section('content')

<div class="col-sm-8 col-sm-offset-2">

	<h2 class="text-center">{{ $title }}</h2>
	<div class="row">
		<div class="col-sm-6">
			{{ Form::open(array('url' => '/cat/create', 'method' => 'POST', 'id' => 'form-category-create')) }}

				<div class="form-group">
					<label for="name">Name the Category</label>
					<input name="name" type="name" class="form-control" id="name" placeholder="Name your category">
				</div>

				<div class="form-group">
					<label for="slug">Category Slug</label>
					<input name="slug" type="name" class="form-control" id="slug" placeholder="Choose a slug for your category">
				</div>

				<p><button type="submit" class="btn btn-primary">Create Category</button></p>

			{{ Form::close() }}
		</div>

		@include('inc.catLists')
	</div>
</div>

@stop