<div class="list-group">
  	<li class="list-group-item bg-black">
    	<h4>
    		<i class="fa fa-music"></i> Tòp Mizik Popilè
    	</h4>
  	</li>
  	<?php

  	$mp3s = MP3::remember(120, 'top.musics')
				->latest('download')
  				->latest('play')
				->latest('vote_up')
				->latest('views')
				->take(5)
				->get();
  	?>

	@if ( $mp3s && count($mp3s) > 0 )
		<ul class="list-unstyled">

			@foreach($mp3s as $mp3)

			<strong>
				<a class="list-group-item" href="/mp3/{{ $mp3->id }}">
					<span class="badge">
						{{ $mp3->play }}
						<i class="fa fa-play"></i>
						-
						{{ $mp3->download }}
						<i class="fa fa-download"></i>
						-
						{{ $mp3->vote_up }}
						<i class="fa fa-thumbs-up"></i>

					</span>
					{{ $mp3->name }}
				</a>
			</strong>

			@endforeach

		</ul>
	@endif
</div>