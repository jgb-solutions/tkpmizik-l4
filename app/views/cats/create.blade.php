@extends('layout.admin')

@section('title')
	{{ $title }}
@stop

@section('content')

<div class="col-sm-8 col-sm-offset-2">

	<h2 class="text-center">{{ $title }}</h2>
	<hr>

	@include('inc.errors')

	<div class="row">
		<div class="col-sm-6">
			{{ Form::open(array('url' => '/cat/create', 'method' => 'POST', 'id' => 'form-category-create', 'class' => 'form-horizontal')) }}

				<div class="form-group">
					<label for="name" class="control-label col-sm-3">Non</label>
					<div class="col-sm-9">
						<input name="name" type="name" class="form-control" id="name" placeholder="Non kategori a">
					</div>
				</div>

				<div class="form-group">
					<label for="slug" class="control-label col-sm-3">Slug</label>
					<div class="col-sm-9">
						<input name="slug" type="name" class="form-control" id="slug" placeholder="Slug kategori a">
					</div>
				</div>

				<div class="form-group">
					<div class="col-sm-9 col-sm-offset-3">
						<button type="submit" class="btn btn-primary">
							<span class="glyphicon glyphicon-th"></span>
							Kreye
						</button>
					</div>
				</div>

			{{ Form::close() }}
		</div>

		@include('inc.catLists')
	</div>
</div>

@stop