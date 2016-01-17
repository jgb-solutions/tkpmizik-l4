<?php

class PageController extends BaseController
{
	public function getIndex()
	{
		// if ( Cache::has('homepage') )
		// {
		// 	return Cache::get('homepage');
		// }

		$mp3s = MP3::remember(120)->latest()->published()->take(3)->get();
		$mp4s = MP4::remember(120)->latest()->take(3)->get();

		$data = ['mp3s', 'mp4s'];

		$homepage = View::make('home', compact($data))->render();

		// Cache::put('homepage', $homepage, 60);

		return $homepage;
	}

	public function getPage($slug)
	{
		$page = Page::remember(60)->whereSlug($slug)->first();

		if ($page)
		{
			 return View::make("pages.page", compact('page'));
		}

		return Redirect::to('/404');
	}
}