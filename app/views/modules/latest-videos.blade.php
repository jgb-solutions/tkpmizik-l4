<div class="col-sm-4">
	<div class="list-group">
	  	<a href="/mp4" class="list-group-item active">
	    	<h4><span class="glyphicon glyphicon-facetime-video"></span> Dènye Videyo</h4>
	  	</a>
	  	<?php $mp4s = MP4::orderBy('id', 'desc')->take( 10 )->get(); ?>

		@if ( $mp4s && count( $mp4s ) > 0 )
			<ul class="list-unstyled">

				@foreach( $mp4s as $mp4 )

				<strong>
					<a class="list-group-item" href="/mp4/{{ $mp4->id }}">
						<span class="glyphicon glyphicon-facetime-video"></span> {{ $mp4->name }}
					</a>
				</strong>

				@endforeach
			</ul>
		@endif
	</div>
</div>