<div class="col-sm-12">

	@if( count( $mp3s ) > 0 )

	<h2 class="text-center text-uppercase"><span class="glyphicon glyphicon-music"></span> Dènye Mizik Yo</h2>
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