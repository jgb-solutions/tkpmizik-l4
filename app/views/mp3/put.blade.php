@extends('layout.nosidebar')

@section('title')
	{{ $title }}
@stop

@section('content')

<div class="col-sm-12">
	<div class="row bg-black">
		<h1 class="text-center">
		<i class="fa fa-edit"></i>
		{{ $title }}
	</h1>
	</div>
	<hr>
</div>

<div class="col-sm-8 col-sm-offset-2">

	@if ( ! $mp3->code && $mp3->price == 'paid' )

		<div class="alert alert-warning fade in" role="alert">
	      <button type="button" class="close" data-dismiss="alert">
	      	<span aria-hidden="true">×</span>
	      	<span class="sr-only">Fèmen</span>
	      </button>
	      <strong>{{ Config::get('site.message.kod-mizik') }}</strong>
	    </div>

	@endif

	@if ( ! $mp3->publish )

		<div class="alert alert-info fade in" role="alert">
	      	<button type="button" class="close" data-dismiss="alert">
	      		<span aria-hidden="true">×</span>
	      		<span class="sr-only">Fèmen</span>
	      	</button>
	      	<strong>{{ Config::get('site.message.aktive') }}</strong>
	    </div>

	@endif

	@if ( Session::has('message') )
		<div class="alert alert-success fade in" role="alert">
	      <button type="button" class="close" data-dismiss="alert">
	      	<span aria-hidden="true">×</span>
	      	<span class="sr-only">Fèmen</span>
	      </button>
	      <strong>{{ Session::get('message') }}</strong>
	    </div>
	@endif


	@include('inc.errors')


	{{ Form::open(['url' => "/mp3/$mp3->id", 'method' => 'PUT', 'enctype' => 'multipart/form-data', 'class' => 'form-horizontal' ]) }}

		@if ( $mp3->price == 'paid' )
			<div class="form-group">
				<label for="code" class="control-label col-sm-4">Kòd mizik la</label>
				<div class="col-sm-8">
					<input name="code" type="password" class="form-control" id="code" placeholder="Antre kòd mizik la" value="{{ $mp3->code }}">
				</div>
			</div>
		@endif

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

		@if ( User::is_admin() )
			@include('inc.free-paid')
		@endif

		@if ( User::is_admin() )
			<div class="form-group">
		    	<label for="publish" class="control-label col-sm-4">
		      	 Pibliye
		    	</label>
		    	<div class="col-sm-8">
		    		<input type="checkbox" name="publish" {{ $mp3->publish ? 'checked' : '' }}>
		    	</div>
			</div>
		@endif

		<div class="form-group">
			<div class="col-sm-8 col-sm-offset-4">
				<button type="submit" class="btn btn-primary btn-lg">
					<i class="fa fa-edit"></i> Modifye
				</button>
			</div>
		</div>

	{{ Form::close() }}

	<br>

</div>

@stop