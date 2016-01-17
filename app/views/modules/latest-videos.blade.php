<div class="list-group">
  	<a href="/mp4" class="list-group-item active">
    	<h4><i class="fa fa-video-camera"></i> Videyo Resan</h4>
  	</a>
  	<?php $mp4s = MP4::remember(120)->latest()->take(5)->get(); ?>

	@if ($mp4s && count($mp4s))
		<ul class="list-unstyled">

			@foreach($mp4s as $mp4)

			<strong>
				<a class="list-group-item" href="/mp4/{{ $mp4->id }}">
					<i class="fa fa-video-camera"></i> {{ $mp4->name }}
				</a>
			</strong>

			@endforeach
		</ul>
	@endif
</div>