<?php namespace App\Composers;

use Page;
Use Auth;
use Category;
use MP3;
use MP4;
use User;
use Cache;

class ViewComposer
{
	public function navigation($view)
	{
		$pages = Page::remember(999, 'pages')->get();

		$cUser = Auth::User();

		$view->with(compact('pages', 'cUser'));
	}

	public function catModule($view)
	{
		$cats = Category::remember(999, 'categories')->orderBy('name')->get();

		$view->with(compact('cats'));
	}

	public function latestMusicsModule($view)
	{
		$mp3s = MP3::remember(120)->latest()->take(5)->get();

		$view->with(compact('mp3s'));
	}

	public function latestVideosModule($view)
	{
  		$mp4s = MP4::remember(120)->latest()->take(5)->get();

		$view->with(compact('mp4s'));
	}

	public function latestUsersModule($view)
	{
  		$users = User::remember(120)->latest()->take(5)->get();

		$view->with(compact('users'));
	}
	public function TopMusicsModule($view)
	{
	  	$mp3s = MP3::remember(120, 'top.musics')
					->latest('download')
	  				->latest('play')
					->latest('vote_up')
					->latest('views')
					->take(5)
					->get();

		$view->with(compact('mp3s'));
	}

	public function TopVideosModule($view)
	{
  		$mp4s = MP4::remember(120, 'top.videos')
  					->latest('download')
					->latest('vote_up')
					->latest('views')
					->take(5)
					->get();

		$view->with(compact('mp4s'));
	}

	public function topUsersModule($view)
	{

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
		}

		$view->with(compact('users'));
	}
}