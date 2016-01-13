<div class="list-group">
  	<li class="list-group-item bg-black">
    	<h4>
    		<i class="fa fa-user"></i> Tòp Itilizatè</h4>
  	</li>

  	<?php

	if (Cache::has('top.users'))
	{
		$sliced_users = Cache::get('top.users');
	} else
	{
		$users = User::all();

		$users->each( function($user)
		{
			$user->mp3count 	= $user->mp3s()->count();
			$user->mp4count 	= $user->mp4s()->count();
			$user->totalcount 	= $user->mp3count + $user->mp4count;
		});

		$users->sort( function($a, $b)
		{
			$a = (int) $a->totalcount;
			$b = (int) $b->totalcount;

			if ( $a === $b )
			{
				return 0;
			}

			return ($a > $b) ? 1 : -1;
		});

		$reverse_users = $users->reverse();

		$sliced_users = $reverse_users->slice(0, 10);

		Cache::put('top.users', $sliced_users, 120);
	}?>

	@foreach ($sliced_users as $user)

	@if ($user->totalcount > 0)

		<a href="/u/{{ $user->id }}" class="list-group-item">
	  	 	<div class="row">
	  	 		<div class="col-xs-4">

	  	 			@if ($user->image)

	  	 			<img
	  	 				src="/{{ Config::get('site.image_upload_path') }}/thumbs/{{ $user->image }}"
	  	 				class="pull-left img-thumbnail img-responsive"
	  	 			>
	  	 			@else

	  	 				<h3 class="list-group-item-heading">
	  	 					<i class="fa fa-user"></i>
	  	 				</h3>

	  	 			@endif
	  	 		</div>
	  	 		<div class="col-xs-8">
	    			<h4 class="list-group-item-heading">{{ $user->name }}</h4>
	    			<p class="list-group-item-text">
	    				gen {{ $user->mp3count }}
	    				<span class="visible-xs-inline">
	    					Mizik
	    				</span>
	    				<i class="fa fa-music"></i>
	    				ak {{ $user->mp4count }}
	    				<span class="visible-xs-inline">
	    					Videyo
	    				</span>
	    				<i class="fa fa-video-camera"></i>
	    			</p>
	    		</div>
	    	</div>
	  	</a>

	@endif

	@endforeach
</div>
