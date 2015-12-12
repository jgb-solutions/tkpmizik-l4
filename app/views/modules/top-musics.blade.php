<div class="list-group">
  	<li class="list-group-item bg-black">
    	<h4><span class="glyphicon glyphicon-music"></span> Tòp Mizik Popilè</h4>
  	</li>
  	<?php

  	$mp3s = MP3::orderBy('play', 'desc')
					->orderBy('download', 'des')
					->take( 10 )->get();
  	?>

	@if ( $mp3s && count( $mp3s ) > 0 )
		<ul class="list-unstyled">

			@foreach( $mp3s as $mp3 )

			<strong>
				<a class="list-group-item" href="/mp3/{{ $mp3->id }}">
					<span class="badge">
						{{ $mp3->play }}
						<span class="glyphicon glyphicon-play"></span>
						-
						{{ $mp3->download }}
						<span class="glyphicon glyphicon-download"></span>

					</span>
					{{ $mp3->name }}
				</a>
			</strong>

			@endforeach

		</ul>
	@endif
</div>