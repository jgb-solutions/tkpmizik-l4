<div class="col-sm-4">
	<h2 class="text-center">

		@if( $user->image )
		<img
			class="img-responsive img-circle img-bordered img-centered"
			src="/uploads/images/thumbs/{{ $user->image}}"
		>
		@endif
		<small>{{ ucwords( $user->name ) }}</small>
	</h2>
	<hr>

	<ul class="list-group">
	  	<li class="list-group-item disabled">
	  		<span class="glyphicon glyphicon-stats"></span>
	    	Music Activity
	  	</li>
		<li class="list-group-item">
			<span class="glyphicon glyphicon-eye-open"></span>
			View{{ $mp3ViewsCount > 1 ? 's' : '' }}
			<span class="pull-right badge">{{ $mp3ViewsCount }}</span>
		</li>
		<li class="list-group-item">
			<span class="glyphicon glyphicon-facetime-video"></span>
			Music{{ $mp3count > 1 ? 's' : '' }}
			<span class="pull-right badge">{{ $mp3count }}</span>
		</li>
		<li class="list-group-item">
			<span class="glyphicon glyphicon-play"></span>
			Total Plays
			<span class="pull-right badge">{{ $mp3playcount }}</span>
		</li>
		<li class="list-group-item">
			<span class="glyphicon glyphicon-download-alt"></span>
			Total Downloads
			<span class="pull-right badge">{{ $mp3downloadcount }}</span>
		</li>


		<li class="list-group-item disabled">
			<span class="glyphicon glyphicon-stats"></span>
	    	Video Activity
	  	</li>
	  	<li class="list-group-item">
			<span class="glyphicon glyphicon-eye-open"></span>
			View{{ $mp4ViewsCount > 1 ? 's' : '' }}
			<span class="pull-right badge">{{ $mp4ViewsCount }}</span>
		</li>
		<li class="list-group-item">
			<span class="glyphicon glyphicon-facetime-video"></span>
			Video{{ $mp4count > 1 ? 's' : '' }}
			<span class="pull-right badge">{{ $mp4count }}</span>
		</li>
		<li class="list-group-item">
			<span class="glyphicon glyphicon-download-alt"></span>
			Total Downloads
			<span class="pull-right badge">{{ $mp4downloadcount }}</span>
		</li>
	</ul>

	<p class="text-center">
		<a href="/mp3/up" class="btn btn-primary btn-lg">
			<span class="glyphicon glyphicon-music"></span>
			Upload Music
		</a>
	</p>
	<p class="text-center">
		<a href="/mp4/up" class="btn btn-danger btn-lg">
			<span class="glyphicon glyphicon-facetime-video"></span>
			Upload Video
		</a>
	</p>
</div>