@extends('layout.admin')

@section('title')
	{{ $title }}
@stop

@section('search-results')
@stop

@section('content')

<div class="col-sm-12">
	<div class="row bg-black">
		<h1 class="text-center"><i class="fa fa-key"></i> {{ $title }}</h1>
	</div>
	<hr>

	<div class="row">
		<div class="col-sm-10 col-sm-offset-1">

			@if( Session::has('error') )
			<div class="panel panel-default">
				<ul class="list-group bg-danger">
					<li class="list-group-item transparent">
						<b>{{ Session::get('error') }}</b>
					</li>
				</ul>
			</div>
			@endif

			@if( Session::has('status') )
			<div class="panel panel-default">
				<ul class="list-group bg-success">
					<li class="list-group-item transparent">
						<b>{{ Session::get('status') }}</b>
					</li>
				</ul>
			</div>
			@endif

			<form
				action="{{ action('RemindersController@postRemind') }}"
				method="POST"
				class="mainSearchForm">

				<div class="input-group">
					<input
						name="email"
						type="email"
						class="form-control"
						placeholder="Mete imel ou pou reyinisyalizasyon an"
						required>
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