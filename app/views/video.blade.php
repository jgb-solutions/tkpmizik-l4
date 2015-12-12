<div class="col-sm-12">

	@if( count( $mp4s ) > 0 )

	<h2 class="text-center text-uppercase"> <span class="glyphicon glyphicon-facetime-video"></span> Dènye Videyo</h2>
	<hr>

	<div class="row">

	@foreach ( $mp4s as $mp4 )

		<div class="col-sm-3 col-xs-6">
			<div class="thumbnail noPadding4 maxHeight228">
				<a href="/mp4/{{ $mp4->id }}">
				  	<img
				  		src="/uploads/images/{{ $mp4->image }}"
				  		alt="{{ $mp4->name }}"
						class="img-reponsive ">
				</a>
			  	<div class="caption">
			    	<h4><a href="/mp4/{{ $mp4->id }}">{{ $mp4->name }}</a></h4>
			    	<p class="text-muted">
			    		<span class="glyphicon glyphicon-eye-open"></span> Views:
			    		{{ $mp4->views }} <br>
			    		<span class="glyphicon glyphicon-download-alt"></span> Download:
			    		{{ $mp4->download }}
			    	</p>
			  	</div>
			</div>
		</div>

	@endforeach

	</div>

	<p class="text-center">
		<a href="/mp4" class="btn btn-lg btn-danger">
			<span class="glyphicon glyphicon-facetime-video"></span>
			View All The Videos
		</a>
	</p>

	@endif

</div>