@include('modules.latest-musics')
@include('modules.latest-videos')
@include('modules.categories')

<div class="col-sm-12 bg-success padding1">
	<div class="row">
		@include('modules.top-musics')
		@include('modules.top-videos')
		@include('modules.top-users')
	</div>
</div>