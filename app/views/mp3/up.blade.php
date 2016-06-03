@extends('layout.nosidebar')

@section('title')
	{{ $title }}
@stop

@section('content')

	<div class="col-sm-12">
		<div class="row bg-black">
			<h1 class="text-center">
			<i class="fa fa-music"></i>
			{{ $title }}
		</h1>
		</div>
		<hr>
	</div>

	<div class="col-sm-8 col-sm-offset-2">

		@include('inc.errors')


		{{ Form::open(['method' => 'POST', 'url' => '/mp3', 'files' => true, 'class' => 'form-horizontal', 'id' => 'upForm']) }}

			@if ( Auth::user() )
				@include('inc.free-paid')
			@endif

			@if ( Auth::guest() )
			<div class="form-group">
				<label
					for="useremail"
					class="col-sm-4 control-label">Ki Imel Ou?
				</label>
				<div class="col-sm-8">
					<input required
						type="email"
						name="email"
						class="form-control"
						id="useremail"
						placeholder="Antre Imel Ou"
						value="{{ Input::old('email') }}">
				</div>
			</div>
			@endif

			<div class="form-group">
				<label
					for="name"
					class="col-sm-4 control-label">Mete Non Mizik la
				</label>
				<div class="col-sm-8">
					<input
						required
						type="text"
						name="name"
						class="form-control"
						id="name"
						placeholder="Bay mizik la yon tit"
						value="{{ Input::old('name') }}">
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
				<label for="description" class="col-sm-4 control-label">Detay Mizik la</label>
				<div class="col-sm-8">
					<textarea
						name="description"
						class="form-control"
						id="description"
						placeholder="Bay kèk enfòmasyon sou mizik la">{{
							Input::old('description') }}</textarea>
				</div>
			</div>

			<div class="form-group">
				<div class="col-sm-8 col-sm-offset-4">
					<p>
						<button type="submit" class="btn btn-primary btn-lg" id="submitButton">
							<i class="fa fa-cloud-upload"></i>
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

			<div class="panel panel-default hide-panel">
				<ul class="list-group bg-danger" id="upMessage">
				</ul>
			</div>

		{{ Form::close() }}

		<br>
	</div>

@stop