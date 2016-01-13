@extends('layout.nosidebar')

@section('title')
{{ $title }}
@stop

@section('content')

<div class="col-sm-12">
	<div class="row bg-black">
		<h1 class="text-center">
			<i class="fa fa-video-camera"></i>
			{{ $title }}
		</h1>
	</div>
	<hr>
</div>
<div class="col-sm-8 col-sm-offset-2">

	{{ Form::open(array('url' => "/mp4/$mp4->id", 'method' => 'PUT', 'enctype' => 'multipart/form-data', 'class' => 'form-horizontal' )) }}

		<div class="form-group">
			<label for="name" class="control-label col-sm-4">Non Videyo a</label>
			<div class="col-sm-8">
				<input
					name="name"
					type="name"
					class="form-control"
					id="name"
					placeholder="Antre non videyo a" value="{{ $mp4->name }}">
			</div>
		</div>

		<div class="form-group">
			<label for="category" class="control-label col-sm-4">Kategori</label>
			<div class="col-sm-8">
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
		</div>

		<div class="form-group">
			<label for="description" class="control-label col-sm-4">Deskripsyon</label>
			<div class="col-sm-8">
				<textarea name="description" id="description" class="form-control">{{ $mp4->description }}</textarea>
			</div>
		</div>

		<div class="form-group">
			<div class="col-sm-8 col-sm-offset-4">
				<button type="submit" class="btn btn-primary btn-lg">
					<i class="fa fa-cloud-upload"></i>
					Mete Videyo a
				</button>
			</div>
		</div>
	{{ Form::close() }}

	<br>

</div>

@stop