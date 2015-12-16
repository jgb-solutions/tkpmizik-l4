<div class="col-sm-4">
	<div class="list-group">
	  	<a href="/mp3" class="list-group-item active">
	    	<h4><span class="glyphicon glyphicon-music"></span> Dènye Mizik</h4>
	  	</a>

	  	<?php $mp3s = MP3::orderBy('id', 'desc')->take( 10 )->get(); ?>

		@if ( $mp3s && count( $mp3s ) > 0 )
			<ul class="list-unstyled">

				@foreach( $mp3s as $mp3 )

				<strong>
					<a class="list-group-item" href="/mp3/{{ $mp3->id }}">
						<span class="glyphicon glyphicon-music"></span> {{ $mp3->name }}
					</a>
				</strong>

				@endforeach
			</ul>
		@endif
	</div>
</div>