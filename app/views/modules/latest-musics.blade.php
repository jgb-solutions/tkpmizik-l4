<div class="list-group">
  	<a href="/mp3" class="list-group-item active">
    	<h4><i class="fa fa-music"></i> Dènye Mizik</h4>
  	</a>

  	<?php $mp3s = MP3::orderBy('created_at', 'desc')->take(10)->get(); ?>

	@if ( $mp3s && count( $mp3s ) > 0 )
		<ul class="list-unstyled">

			@foreach( $mp3s as $mp3 )

			<strong>
				<a class="list-group-item" href="/mp3/{{ $mp3->id }}">
					<i class="fa fa-music"></i> {{ $mp3->name }}
				</a>
			</strong>

			@endforeach
		</ul>
	@endif
</div>