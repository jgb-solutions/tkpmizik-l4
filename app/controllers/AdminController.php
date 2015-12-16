<?php

class AdminController extends BaseController
{
	public function get_index()
	{
		$admin = Auth::user();

		$mp3s = MP3::take(10)->get();
		$mp4s = MP4::take(10)->get();
		$users = User::take(10)->get();

		$title = 'Byenvini Admin ' . $admin->name;

		return View::make('admin.index')
					->withAdmin($admin)
					->withMp3s($mp3s)
					->withMp4s($mp4s)
					->withUsers($users)
					->withTitle($title);
	}

	public function get_users()
	{
		return 'viewing all users';
	}
}