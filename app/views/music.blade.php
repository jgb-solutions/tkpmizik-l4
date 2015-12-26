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
		<span class="glyphicon glyphicon-music"></span>
		Dènye Mizik Yo
		</h2>
	</div>

	<hr>

	@include('mp3.grid-6')

	<p class="text-center">
		<a href="/mp3" class="btn btn-lg btn-primary">
			<span class="glyphicon glyphicon-music"></span>
			Navige Tout Mizik Yo
		</a>
	</p>

	@endif
	<hr/>
</div>