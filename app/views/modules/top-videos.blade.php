<div class="list-group">
  	<li class="list-group-item bg-black">
    	<h4>
    		<i class="fa fa-video-camera"></i> Tòp Videyo Popilè
    	</h4>
  	</li>

  	<?php
  		$mp4s = MP4::latest('download')
					->latest('vote_up')
					->latest('views')
					->take(10)
					->get();
	?>

	@if ( $mp4s && count($mp4s) > 0 )

		@foreach($mp4s as $mp4)

		<strong>
			<a class="list-group-item" href="/mp4/{{ $mp4->id }}">
				<span class="badge">
						{{ $mp4->views }}
						<i class="fa fa-eye"></i>
						-
						{{ $mp4->download }}
						<i class="fa fa-download"></i>
						-
						{{ $mp4->vote_up }}
						<i class="fa fa-thumbs-up"></i>
					</span>
				{{ $mp4->name }}
			</a>
		</strong>

		@endforeach

	@endif
</div>