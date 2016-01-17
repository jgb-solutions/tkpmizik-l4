<div class="col-sm-4">
	<h2 class="text-center">

		@if( $user->image )

				<a href="{{ $user->username ? '/@' . $user->username : '/u/' . $user->id }}">
				<img
					class="img-responsive img-circle img-bordered img-centered lazy"
					data-original="{{ TKPM::asset($user->image, 'thumbs') }}">
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

			@if ( $user->username )
			<hr>
			<form role="form">
				<label for="username">Adrès pwofil {{ $first_name }}</label>
			  	<div class="form-group">
			      	<input
			      		onclick="return this.select()"
			      		type="text"
			      		class="form-control strong"
			      		id="username"
			      		value="{{ URL::to("@$user->username") }}">
			  	</div>
			</form>
			@endif

		</small>
	</h2>

	@if ( $bought_count )
	<hr>
	<div class="list-group">
	    <a href="/user/my-bought-mp3s" class="list-group-item">
	    	<span class="badge">{{ $bought_count }}</span>
	    <strong>
	    	<i class="fa fa-music"></i>
	    	Mizik Ou Achte
	    	<i class="fa fa-money"></i>
	    </strong>
	    </a>
	</div>
	@endif
	<hr>

	<ul class="list-group">
	  	<li class="list-group-item disabled">
	  		<i class="fa fa-bar-chart-o"></i>
	    	Aktivite Mizik
	  	</li>
		<li class="list-group-item">
			<i class="fa fa-eye"></i>
			Total Afichaj
			<span class="pull-right badge">{{ $mp3ViewsCount }}</span>
		</li>
		<li class="list-group-item">
			<i class="fa fa-music"></i>
			Total Mizik
			<span class="pull-right badge">{{ $mp3count }}</span>
		</li>
		<li class="list-group-item">
			<i class="fa fa-headphones"></i>
			Total Ekout
			<span class="pull-right badge">{{ $mp3playcount }}</span>
		</li>
		<li class="list-group-item">
			<i class="fa fa-download"></i>
			Total Telechajman
			<span class="pull-right badge">{{ $mp3downloadcount }}</span>
		</li>


		<li class="list-group-item disabled">
			<i class="fa fa-bar-chart-o"></i>
	    	Aktivite Videyo
	  	</li>
		<li class="list-group-item">
			<i class="fa fa-eye"></i>
			Total Afichaj
			<span class="pull-right badge">{{ $mp4ViewsCount }}</span>
		</li>
		<li class="list-group-item">
			<i class="fa fa-video-camera"></i>
			Total Videyo
			<span class="pull-right badge">{{ $mp4count }}</span>
		</li>
		<li class="list-group-item">
			<i class="fa fa-download"></i>
			Total Telechajman
			<span class="pull-right badge">{{ $mp4downloadcount }}</span>
		</li>
	</ul>

	<p class="text-center">
		<a href="/mp3/up" class="btn btn-primary btn-lg">
			<i class="fa fa-music"></i>
			Mete Yon Mizik
		</a>
	</p>
	<p class="text-center">
		<a href="/mp4/up" class="btn btn-danger btn-lg">
			<i class="fa fa-video-camera"></i>
			Mete Yon Videyo
		</a>
	</p>
</div>