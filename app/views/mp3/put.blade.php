@extends('layout.nosidebar')

@section('content')

<div class="col-sm-8 col-sm-offset-2">
	<h1 class="text-center">Editing '{{ $mp3->name }}'</h1>

	{{ Form::open(array('url' => "/mp3/$mp3->id", 'method' => 'PUT', 'enctype' => 'multipart/form-data' )) }}

		<div class="form-group">
			<label for="regname">Name the Music</label>
			<input name="name" type="name" class="form-control" id="regname" placeholder="Name your file" value="{{ $mp3->name }}">
		</div>

		<div class="form-group">
			<label for="image">Featured Image</label>
			<input type="file" name="image" id="image" class="form-control">
		</div>

		<div class="form-group">
			<label for="category">Music Category</label>
			<select class="form-control" name="cat">

			@foreach( $cats as $cat )
				<option
					value="{{ $cat->id }}"
					{{ $cat->id == $mp3->category_id ? 'selected' : '' }}>
					{{ $cat->name }}
				</option>
			@endforeach
			</select>
		</div>

		<div class="form-group">
			<label for="description">Music Description</label>
				<textarea name="description" id="description" class="form-control">{{ $mp3->description }}</textarea>
		</div>

		<button type="submit" class="btn btn-primary">Update Music</button>

	{{ Form::close() }}

	<br>

</div>

@stop