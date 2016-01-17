<div class="col-sm-12">

	@if ( Session::has('message') )
		<div class="alert alert-success fade in" role="alert">
	      <button type="button" class="close" data-dismiss="alert">
	      	<span aria-hidden="true">×</span>
	      	<span class="sr-only">Fèmen</span>
	      </button>
	      <strong>{{ Session::get('message') }}</strong>
	    </div>
	@endif

	@if( count( $mp3s ) > 0 )

	<div class="row bg-black">
		<h2 class="text-center text-uppercase">
		<i class="fa fa-music"></i>
		Mizik Resan
		</h2>
	</div>

	<hr>

	{{-- @include('mp3.grid-6') --}}

	<div class="row">
		@foreach ( $mp3s as $mp3 )
		<div class="col-sm-4">
				<div class="thumbnail noPadding4 maxHeight228">
					<a href="/mp3/{{ $mp3->id }}">
					  	<img
							class="img-reponsive full-width lazy"
							alt="{{ $mp3->name }}"
							data-original="{{ TKPM::asset($mp3->image, 'thumbs') }}">
					</a>
				  	<div class="caption text-center">
				    	<h4><a href="/mp3/{{ $mp3->id }}">{{ $mp3->name }}</a></h4>
				    	<p class="text-muted">
				    		<i class="fa fa-eye"></i> Afichaj:
				    		{{ $mp3->views }} <br>
				    		<i class="fa fa-download"></i> Telechajman:
				    		{{ $mp3->download }}
				    	</p>
				  	</div>
				</div>
			</div>
		@endforeach
	</div>

	<div class="col-sm-12">
		<p class="text-center">
			<a href="/mp3" class="btn btn-lg btn-primary">
				<i class="fa fa-music"></i>
				Navige Tout Mizik Yo
			</a>
		</p>
	</div>

	@endif
	<hr/>
</div>