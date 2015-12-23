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


		@include('inc.errors')


		{{ Form::open(['method' => 'POST', 'url' => '/mp3', 'files' => true, 'class' => 'form-horizontal', 'id' => 'upForm']) }}

			@if ( Auth::user() )
				@include('inc.free-paid')
			@endif

			<div class="form-group">
				<label for="name" class="col-sm-4 control-label">Mete Non Mizik la</label>
				<div class="col-sm-8">
					<input required type="text" name="name" class="form-control" id="name" placeholder="Bay mizik la yon tit" value="{{ Input::old('name') }}" >
				</div>
			</div>

			<div class="form-group">
				<label for="mp3file" class="col-sm-4 control-label">Chwazi Mizik MP3 a</label>
				<div class="col-sm-8">
					<input required name="mp3" class="form-control" type="file" id="mp3file">
				</div>
			</div>

			<div class="form-group">
				<label for="imagefile" class="col-sm-4 control-label">Chwazi Yon Imaj</label>
				<div class="col-sm-8">
					<input required name="image" class="form-control" type="file" id="imagefile">
				</div>
			</div>

			<div class="form-group">
				<label for="category" class="col-sm-4 control-label">Kategori Mizik la</label>
				<div class="col-sm-8">
					<select class="form-control" name="cat" id="category">

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

			<div class="form-group">
				<div class="col-sm-8 col-sm-offset-4">
					<p>
						<button type="submit" class="btn btn-primary btn-lg" id="submitButton">
							<span class="glyphicon glyphicon-upload"></span>
							Mete Mizik la
						</button>
					</p>
				</div>
			</div>

			<div class="form-group" id="progress">
				<div class="col-sm-12">
					@include('inc.progress-bar')
				</div>
			</div>

			<div class="panel panel-default">
				<ul class="list-group bg-danger" id="upMessage">
				</ul>
			</div>

		{{ Form::close() }}

		<br>
	</div>

@stop