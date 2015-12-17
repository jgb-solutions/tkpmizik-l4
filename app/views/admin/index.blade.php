@extends('layout.admin')

@section('title')
	{{ $title }}
@stop

@section('search-results')
@stop

@section('content')

<div class="col-sm-12">
	<h1 class="text-center">{{ $title }}</h1>
	<hr>
	<div class="row">

		<div class="col-sm-6">
			<h3 class="text-center">
				<a
					href="/admin/mp3"
					>
					<span class="glyphicon glyphicon-music"></span>
					Mizik ({{ $mp3s_count }})
				</a>
			</h3>
			<hr>

			@include('admin.modules.musics')

			<hr>

			<h3 class="text-center">
				<a
					href="/admin/mp4"
					>
					<span class="glyphicon glyphicon-facetime-video"></span>
					Videyo ({{ $mp4s_count }})
				</a>
			</h3>
			<hr>

			@include('admin.modules.videos')

		</div>

		<div class="col-sm-6">
			<h3 class="text-center">
				<a
					href="/admin/cat"
					>
					<span class="glyphicon glyphicon-music"></span>
					Kategori ({{ $cats_count }})
				</a>
			</h3>
			<hr>

			@include('admin.modules.categories')
			
			<hr>
			<h3 class="text-center">
				<a href="/admin/users">
					<span class="glyphicon glyphicon-user"></span>
					Itilizatè ({{ $users_count }})
				</a>
			</h3>
			<hr>
			@include('admin.modules.users')
		</div>
	</div>
</div>

@stop