@extends('layout.nosidebar')

@section('title')
	{{ $title }}
@stop

@section('content')

	<div class="col-sm-8 col-sm-offset-2">
		<h1 class="text-center">
			<span class="glyphicon glyphicon-music"></span>
			{{ $title }}
		</h1>

		<hr>


			@if( count( $errors ) > 0 )

			<div class="panel panel-default">
				<ul class="list-group bg-danger">
					@foreach ( $errors->all('<li class="list-group-item transparent"><b>:message</b></li>') as $error )
						{{ $error }}
					@endforeach
				</ul>
			</div>

			@endif


		{{ Form::open(['method' => 'POST', 'url' => '/mp3', 'files' => true, 'class' => 'form-horizontal']) }}

			<div class="form-group">
				<label for="name" class="col-sm-4 control-label">Mete Non Mizik la</label>
				<div class="col-sm-8">
					<input required type="text" name="name" class="form-control" id="name" placeholder="Bay mizik la yon tit" value="{{ Input::old('name') }}" >
				</div>
			</div>

			<div class="form-group">
				<label for="mp3" class="col-sm-4 control-label">Chwazi Mizik MP3 a</label>
				<div class="col-sm-8">
					<input required name="mp3" class="form-control" type="file" >
				</div>
			</div>

			<div class="form-group">
				<label for="mp3" class="col-sm-4 control-label">Chwazi Yon Imaj</label>
				<div class="col-sm-8">
					<input required name="image" class="form-control" type="file" >
				</div>
			</div>

			<div class="form-group">
				<label for="category" class="col-sm-4 control-label">Kategori Mizik la</label>
				<div class="col-sm-8">
					<select class="form-control" name="cat">

					@foreach( $cats as $cat )

						<option
							value="{{ $cat->id }}"
							{{ $cat->slug == 'rap' ? 'selected' : '' }}>
							{{ $cat->name }}
						</option>

					@endforeach

					</select>
				</div>
			</div>

			<div class="col-sm-8 col-sm-offset-4">
				<p>
					<button type="submit" class="btn btn-primary btn-lg">
						<span class="glyphicon glyphicon-upload"></span>
						Mete Mizik la
					</button>
				</p>
			</div>

		{{ Form::close() }}

		<br>
	</div>

@stop