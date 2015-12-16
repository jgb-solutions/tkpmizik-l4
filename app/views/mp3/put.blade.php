@extends('layout.nosidebar')

@section('title')
	{{ $title }}
@stop

@section('content')

<div class="col-sm-8 col-sm-offset-2">
	<h1 class="text-center">{{ $title }}</h1>
	<hr>

	{{ Form::open(['url' => "/mp3/$mp3->id", 'method' => 'PUT', 'enctype' => 'multipart/form-data', 'class' => 'form-horizontal' ]) }}

		<div class="form-group">
			<label for="regname" class="control-label col-sm-4">Non Mizik la</label>
			<div class="col-sm-8">
				<input name="name" type="name" class="form-control" id="regname" placeholder="Antre non mizik la" value="{{ $mp3->name }}">
			</div>
		</div>

		<div class="form-group">
			<label for="image" class="control-label col-sm-4">Imaj</label>
			<div class="col-sm-8">
				<input type="file" name="image" id="image" class="form-control">
			</div>
		</div>

		<div class="form-group">
			<label for="category" class="control-label col-sm-4">Kategori</label>
			<div class="col-sm-8">
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
		</div>

		<div class="form-group">
			<label for="description" class="control-label col-sm-4">Deskripsyon</label>
			<div class="col-sm-8">
				<textarea name="description" id="description" class="form-control">{{ $mp3->description }}</textarea>
			</div>
		</div>

		<div class="form-group">
			<div class="col-sm-8 col-sm-offset-4">
				<button type="submit" class="btn btn-primary btn-lg">
					<span class="glyphicon glyphicon-edit"></span> Modifye
				</button>
			</div>
		</div>

	{{ Form::close() }}

	<br>

</div>

@stop