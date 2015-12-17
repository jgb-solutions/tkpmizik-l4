<?php

class AdminController extends BaseController
{
	public function get_index()
	{
		$admin 		= Auth::user();

		$mp3s 		= MP3::orderBy('created_at', 'desc')->take(10)->get();
		$mp3scount 	= MP3::count();
		$mp4s 		= MP4::orderBy('created_at', 'desc')->take(10)->get();
		$mp4scount 	= MP4::count();
		$users 		= User::orderBy('created_at', 'desc')->take(10)->get();
		$userscount = User::count();
		$categories = Category::orderBy('name')->take(10)->get();
		$catscount	= Category::count();

		$title 	= 'Administrasyon';

		return View::make('admin.index')
					->withAdmin($admin)
					->withMp3s($mp3s)
					->withMp4s($mp4s)
					->withUsers($users)
					->withCategories($categories)
					->withTitle($title)
					->withMp3sCount($mp3scount)
					->withMp4sCount($mp4scount)
					->withUsersCount($userscount)
					->withCatsCount($catscount);
	}

	public function get_mp3()
	{
		return 'admin mp3';
	}

	public function get_mp4()
	{
		return 'admin mp4';
	}

	public function get_users()
	{
		$users = User::orderBy('created_at', 'desc')->paginate(10);
		$userscount = User::count();

		return View::make('admin.users')
					->withTitle('Administrayon Itilizatè (' . $userscount . ')')
					->withUsers($users)
					->withUsersCount($userscount);
	}
}