@extends('layout.admin')

@section('title')
	{{ $title }}
@stop

@section('search-results')
@stop

@section('content')

<div class="col-sm-12">
	<div class="row bg-black">
		<h1 class="text-center"><i class="fa fa-music"></i> {{ $title }}</h1>
	</div>
	<hr>

	<div class="row">
		<div class="col-sm-8 col-sm-offset-2">
			@if ( Session::has('status') )
			<div class="alert alert-success fade in" role="alert">
				<button type="button" class="close" data-dismiss="alert">
					<span aria-hidden="true">×</span>
					<span class="sr-only">Fèmen</span>
				</button>
				<h4>{{ Session::get('status') }}</h4>
			</div>
			@endif


			@if( Session::has('error') )
			<div class="panel panel-default">
				<ul class="list-group bg-danger">
					<li class="list-group-item transparent">
						<b>{{ Session::get('error') }}</b>
					</li>
				</ul>
			</div>
			@endif

			<form action="{{ action('RemindersController@postRemind') }}" method="POST">

				<div class="input-group">
					<input
						name="email"
						type="email"
						class="form-control"
						placeholder="Mete Imel ou vle Reyinisyalize modpas pou li a">
					<input id="typeInput" type="hidden" name="type" value="">
					<span class="input-group-btn">
						<button class="btn btn-success" type="submit">
							<i class="fa fa-key"></i>
							Reyinisyalize
						</button>
					</span>
				</div>
			</form>
		</div>
	</div>

</div>

@stop