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

		$pages = Page::orderBy('created_at', 'desc')->paginate(10);
		$pages_count = Page::count();

		$title 	= 'Administrasyon';

		return View::make('admin.index')
					->withAdmin($admin)
					->withMp3s($mp3s)
					->withMp4s($mp4s)
					->withUsers($users)
					->withCategories($categories)
					->withPages($pages)
					->withTitle($title)
					->withMp3sCount($mp3scount)
					->withMp4sCount($mp4scount)
					->withUsersCount($userscount)
					->withCatsCount($catscount)
					->withPagesCount($pages_count);
	}

	public function get_mp3()
	{
		$mp3 = MP3::orderBy('created_at', 'desc')->paginate(10);
		$mp3_count = User::count();
		$title = 'Administrayon Mizik (' . $mp3_count . ')';

		return View::make('admin.mp3.index')
					->withTitle($title)
					->withMp3s($mp3)
					->withmp3Count($mp3_count);
	}

	public function get_mp4()
	{
		return 'admin mp4';
	}

	public function get_users()
	{
		$users = User::orderBy('created_at', 'desc')->paginate(10);
		$userscount = User::count();

		return View::make('admin.users.index')
					->withTitle('Administrayon Itilizatè (' . $userscount . ')')
					->withUsers($users)
					->withUsersCount($userscount);
	}

	public function get_pages($action = null, $id = null)
	{
		if ( ! is_null($action) )
		{
			$fn = 'get_' . $action;

			return $this->$fn($id);
		}

		$pages = Page::orderBy('created_at', 'desc')->paginate(10);

		$pages_count = Page::count();
		$title = 'Administrayon Paj (' . $pages_count . ')';

		return View::make('admin.pages.index')
					->withTitle($title)
					->withPages($pages)
					->withPagesCount($pages_count);
	}

	public function get_create()
	{
		$title = 'Kreye Yon Nouvo Paj';

		return View::make('admin.pages.create')
					->withTitle($title);
	}

	public function post_pages()
	{
		$rules = [
			'name'	=> 'required|min:5',
			'slug'	=> 'alpha_dash',
			'content'=> 'required'
		];

		$title = Input::get('name');
		$slug = Input::get('slug');
		$slug = isset( $slug ) ? $slug : Str::slug($title, '-');
		$content = Input::get('content');

		$v = Validator::make(Input::all(), $rules);

		if ( $v->fails() )
		{
			return Redirect::back()
							->withInput()
							->withErrors($v);
		}

		$page = new Page;

		$page->title 	= $title;
		$page->slug 	= $slug;
		$page->content 	= $content;

		$page->save();

		Cache::forget('pages');

		return Redirect::to('/admin/pages');
	}

	public function get_edit($id)
	{
		$page = Page::find($id);

		$title = 'Modifye ' . $page->title;

		return View::make('admin.pages.edit')
					->withPage($page)
					->withTitle($title);
	}

	public function put_pages_edit($id)
	{
		$rules = [
			'name'	=> 'required|min:5',
			'slug'	=> 'alpha_dash',
			'content'=> 'required'
		];

		$title = Input::get('name');
		$slug = Input::get('slug');
		$slug = isset( $slug ) ? $slug : Str::slug($title, '-');
		$content = Input::get('content');

		$v = Validator::make(Input::all(), $rules);

		if ( $v->fails() )
		{
			return Redirect::back()
							->withInput()
							->withErrors($v);
		}

		$page = Page::find($id);


		$page->title = $title;
		$page->slug = $slug;
		$page->content = $content;
		$page->save();

		Cache::forget('page_' . $slug);
		Cache::forget('pages');

		return Redirect::to('/admin/pages');
	}

	public function get_delete($id)
	{
		$page = Page::find($id);

		Cache::forget('page_' . $page->slug);
		Cache::forget('pages');

		$page->delete();

		return Redirect::to('/admin/pages');
	}
}