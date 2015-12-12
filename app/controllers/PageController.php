<?php

class PageController extends BaseController
{
	public function getIndex()
	{
		$mp3s = MP3::orderBy('id', 'desc')->take( 6 )->get();
		$mp4s = MP4::orderBy('id', 'desc')->take( 6 )->get();

		return View::make('home')
			->with('mp3s', $mp3s)
			->with('mp4s', $mp4s);
	}

	public function getAbout()
	{
		return View::make('pages.about')
			->with('title', 'About Us!');
	}

	public function getContact()
	{
		return View::make('pages.contact')
			->with('title', 'Contact Us!');
	}
}