@extends('layout.nosidebar')

@section('content')

@section('title')
	{{ $title }}
@stop

<div class="col-sm-8 col-sm-offset-2">

	<h2 class="text-center">{{ $title }}</h2>
	<div class="row">
		<div class="col-sm-6">
			{{ Form::open(array('url' => '/cat/edit', 'method' => 'PUT', 'id' => 'form-category-create')) }}

				<div class="form-group">
					<label for="name">Non Kategori a</label>
					<input name="name" type="name" class="form-control" id="name" placeholder="Bay Kategori a Yon Non" value="{{ $category->name }}">
				</div>

				<div class="form-group">
					<label for="slug">Slòg Kategori a</label>
					<input name="slug" type="name" class="form-control" id="slug" placeholder="Chwazi Yon Slòg Pou Kategori a" value="{{ $category->slug }}">
				</div>

				<input type="hidden" value="{{ $category->id }}" name="id">

				<p><button type="submit" class="btn btn-primary">Modifye Kategori a</button></p>

			{{ Form::close() }}
		</div>

		@include('inc.catLists')

	</div>
</div>

@stop