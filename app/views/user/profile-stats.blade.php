<div class="col-sm-4">
	<h2 class="text-center">

		@if( $user->image )
		<a href="/user">
			<img
			class="img-responsive img-circle img-bordered img-centered"
			src="/uploads/images/thumbs/{{ $user->image}}">
		</a>
		@endif
		<small>
			{{ ucwords( $user->name ) }}<br>

			@if ( $user->telephone )
				<small>
					<a
						class="btn btn-success"
						href="tel:{{ $user->telephone }}"
						target="_blank">
						<strong>
						  <i class="fa fa-whatsapp fa-lg"></i> {{ $user->telephone }}
						</strong>
					</a>
				</small>
			@endif

		</small>
	</h2>

	@if ( $bought_count )
	<hr>
	<div class="list-group">
	    <a href="/user/my-bought-mp3s" class="list-group-item">
	    	<span class="badge">{{ $bought_count }}</span>
	    <strong>
	    	<span class="glyphicon glyphicon-music"></span>
	    	Mizik Ou Achte
	    	<i class="fa fa-money"></i>
	    </strong>
	    </a>
	</div>
	@endif
	<hr>

	<ul class="list-group">
	  	<li class="list-group-item disabled">
	  		<span class="glyphicon glyphicon-stats"></span>
	    	Aktivite Mizik
	  	</li>
		<li class="list-group-item">
			<span class="glyphicon glyphicon-eye-open"></span>
			Total Afichaj
			<span class="pull-right badge">{{ $mp3ViewsCount }}</span>
		</li>
		<li class="list-group-item">
			<span class="glyphicon glyphicon-music"></span>
			Total Mizik
			<span class="pull-right badge">{{ $mp3count }}</span>
		</li>
		<li class="list-group-item">
			<span class="glyphicon glyphicon-headphones"></span>
			Total Ekout
			<span class="pull-right badge">{{ $mp3playcount }}</span>
		</li>
		<li class="list-group-item">
			<span class="glyphicon glyphicon-download-alt"></span>
			Total Telechajman
			<span class="pull-right badge">{{ $mp3downloadcount }}</span>
		</li>


		<li class="list-group-item disabled">
			<span class="glyphicon glyphicon-stats"></span>
	    	Aktivite Videyo
	  	</li>
		<li class="list-group-item">
			<span class="glyphicon glyphicon-eye-open"></span>
			Total Afichaj
			<span class="pull-right badge">{{ $mp4ViewsCount }}</span>
		</li>
		<li class="list-group-item">
			<span class="glyphicon glyphicon-facetime-video"></span>
			Total Videyo
			<span class="pull-right badge">{{ $mp4count }}</span>
		</li>
		<li class="list-group-item">
			<span class="glyphicon glyphicon-download-alt"></span>
			Total Telechajman
			<span class="pull-right badge">{{ $mp4downloadcount }}</span>
		</li>
	</ul>

	<p class="text-center">
		<a href="/mp3/up" class="btn btn-primary btn-lg">
			<span class="glyphicon glyphicon-music"></span>
			Mete Yon Mizik
		</a>
	</p>
	<p class="text-center">
		<a href="/mp4/up" class="btn btn-danger btn-lg">
			<span class="glyphicon glyphicon-facetime-video"></span>
			Mete Yon Videyo
		</a>
	</p>
</div>