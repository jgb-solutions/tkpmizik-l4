<div class="col-sm-12">

	@include('inc.ads.bottom')

	@if( count( $mp4s ) > 0 )

	<div class="row bg-black">
		<h2 class="text-center text-uppercase">
			<i class="fa fa-video-camera"></i> Dènye Videyo
		</h2>
	</div>
	<hr>

	<div class="row">

	@foreach ( $mp4s as $mp4 )

		<div class="col-sm-6">
			<div class="thumbnail noPadding4 maxHeight228">
				<a href="/mp4/{{ $mp4->id }}">
				  	<img
						class="img-reponsive full-width lazy"
						alt="{{ $mp4->name }}"
						data-original="{{ $mp4->image }}">
				</a>
			  	<div class="caption text-center">
			    	<h4><a href="/mp4/{{ $mp4->id }}">{{ $mp4->name }}</a></h4>
			    	<p class="text-muted">
			    		<i class="fa fa-eye"></i> Afichaj:
			    		{{ $mp4->views }} <br>
			    		<i class="fa fa-download"></i> Telechajman:
			    		{{ $mp4->download }}
			    	</p>
			  	</div>
			</div>
		</div>

	@endforeach

	</div>

	<p class="text-center">
		<a href="/mp4" class="btn btn-lg btn-danger">
			<i class="fa fa-video-camera"></i>
			Navige Tout Videyo Yo
		</a>
	</p>

	@endif

</div>