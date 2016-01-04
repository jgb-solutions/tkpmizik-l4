@extends('layout.admin')

@section('title')
	{{ $title }}
@stop

@section('search-results')
@stop

@section('content')

<div class="col-sm-12">
	<div class="row bg-black">
		<h1 class="text-center"><i class="fa fa-bar-chart"></i> {{ $title }}</h1>
	</div>
	<hr>
	<div class="row">

		<div class="col-sm-6">
			<div class="row bg-black">
				<h3 class="text-center">
					<a
						href="/admin/mp3"
						>
						<i class="fa fa-music"></i>
						Mizik ({{ $mp3s_count }})
					</a>
				</h3>
			</div>
			<hr>

			@include('admin.modules.musics')

			<p class="text-center">
				<a href="/mp3/up" class="btn btn-primary btn-lg">
					<i class="fa fa-music"></i> Ajoute Mizik
				</a>
			</p>

			<hr>

			<div class="row bg-black">
				<h3 class="text-center">
					<a
						href="/admin/mp4"
						>
						<i class="fa fa-video-camera"></i>
						Videyo ({{ $mp4s_count }})
					</a>
				</h3>
			</div>
			<hr>

			@include('admin.modules.videos')

			<p class="text-center">
				<a href="/mp4/up" class="btn btn-primary btn-lg">
					<i class="fa fa-video-camera"></i> Ajoute Videyo
				</a>
			</p>

		</div>

		<div class="col-sm-6">
			<div class="row bg-black">
				<h3 class="text-center">
					<a
						href="/admin/cat"
						>
						<i class="fa fa-th-list"></i>
						Kategori ({{ $cats_count }})
					</a>
				</h3>
			</div>
			<hr>

			@include('admin.modules.categories')

			<p class="text-center">
				<a href="/admin/cat" class="btn btn-primary btn-lg">
					<i class="fa fa-th-list"></i> Kreye Kategori
				</a>
			</p>

			<hr>
			<div class="row bg-black">
				<h3 class="text-center">
					<a href="/admin/users">
						<i class="fa fa-user"></i>
						Itilizatè ({{ $users_count }})
					</a>
				</h3>
			</div>
			<hr>
			@include('admin.modules.users')

			<hr>
			<div class="row bg-black">
				<h3 class="text-center">
					<a href="/admin/pages">
						<i class="fa fa-file-o"></i>
						Paj ({{ $pages_count }})
					</a>
				</h3>
			</div>
			<hr>
			@include('admin.modules.pages')

			<p class="text-center">
				<a href="/admin/pages/create" class="btn btn-primary btn-lg">
					<i class="fa fa-file"></i> Kreye Paj
				</a>
			</p>
		</div>
	</div>
</div>

@stop