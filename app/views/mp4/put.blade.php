@extends('layout.nosidebar')

@section('content')

<div class="col-sm-8 col-sm-offset-2">
	<h1 class="text-center">Editing '{{ $mp4->name }}'</h1>

	{{ Form::open(array('url' => "/mp4/$mp4->id", 'method' => 'PUT', 'enctype' => 'multipart/form-data' )) }}

		<div class="form-group">
			<label for="regname">Name the Video</label>
			<input name="name" type="name" class="form-control" id="regname" placeholder="Give a name to your video" value="{{ $mp4->name }}">
		</div>

		<div class="form-group">
			<label for="url">Enter Your YouTube Video Link</label>
			<input name="url" type="url" class="form-control" id="url" placeholder="Enter Your YouTube Video Link" value="{{ $mp4->url }}">
		</div>

		<div class="form-group">
			<label for="category">Video Category</label>
			<select class="form-control" name="cat">

			@foreach( $cats as $cat )
				<option
					value="{{ $cat->id }}"
					{{ $cat->id == $mp4->category_id ? 'selected' : '' }}>
					{{ $cat->name }}
				</option>
			@endforeach
			</select>
		</div>

		<div class="form-group">
			<label for="description">Video Description</label>
				<textarea name="description" id="description" class="form-control">{{ $mp4->description }}</textarea>
		</div>

		<button type="submit" class="btn btn-primary">Update Video</button>

	{{ Form::close() }}

	<br>

</div>

@stop