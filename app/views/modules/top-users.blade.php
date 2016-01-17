<div class="list-group">
  	<li class="list-group-item bg-black">
    	<h4>
    		<i class="fa fa-user"></i> Tòp Itilizatè</h4>
  	</li>

  	<?php

	if (Cache::has('top.users'))
	{
		$users = Cache::get('top.users');
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

		$users = $reverse_users->slice(0, 5);

		Cache::put('top.users', $users, 120);
	}?>

	@include('users.list')
</div>
