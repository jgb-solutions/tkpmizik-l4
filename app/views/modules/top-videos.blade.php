<div class="list-group">
  	<li class="list-group-item bg-black">
    	<h4><span class="glyphicon glyphicon-facetime-video"></span> Tòp Videyo Popilè</h4>
  	</li>

  	<?php
  		$mp4s = MP4::orderBy('views', 'desc')
					->orderBy('download', 'desc')
					->take( 10 )->get();
	?>

	@if ( $mp4s && count( $mp4s ) > 0 )

		@foreach( $mp4s as $mp4 )

		<strong>
			<a class="list-group-item" href="/mp4/{{ $mp4->id }}">
				<span class="badge">
						{{ $mp4->views }}
						<span class="glyphicon glyphicon-eye-open"></span>
						-
						{{ $mp4->download }}
						<span class="glyphicon glyphicon-download"></span>
					</span>
				{{ $mp4->name }}
			</a>
		</strong>

		@endforeach

	@endif
</div>