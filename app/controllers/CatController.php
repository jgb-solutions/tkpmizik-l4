<?php

class CatController extends BaseController
{
	public function getIndex()
	{
		return Redirect::to('/');
	}

	public function getCreate()
	{
		if ( Auth::check() && User::is_Admin() )
		{
			$data = [
				'categories' => Category::orderBy('name')->get(),
				'title' => 'Kreye Yon Nouvo Kategori'
			];

			return View::make('cats.create', $data);
		}

		return Redirect::to('/login')
						->with('message', 'Ou dwe administratè pou ou kapap kreye kategori.');
	}

	public function postCreate()
	{
		$rules = ['name' => 'required', 'slug' => 'required'];

		$messages = [
			'name.required' => Config::get('site.validate.name.required'),
			'slug.required' => Config::get('site.validate.slug.required')
		];

		$validator = Validator::make( Input::all(), $rules, $messages );

		if ( $validator->fails() )
		{
			return Redirect::to('/admin/cat')
							->withErrors( $validator );
		}

		Category::create([
			'name' => Input::get('name'),
			'slug' => Str::slug( Input::get('slug', '-') )
		]);

		Cache::flush();

		return Redirect::to('/admin/cat');
	}

	public function getShow($slug)
	{
		$cat = Category::remember(120)->whereSlug($slug)->first();

		if ($cat)
		{
			$mp3s = $cat->mp3s()->remember(120)->published()->latest()->take(20)->get();
			$mp4s = $cat->mp4s()->remember(120)->latest()->take(20)->get();

			$mp3s->each( function($mp3)
			{
				$mp3->type = 'mp3';
				$mp3->icon = 'music';
			});

			$mp4s->each( function($mp4)
			{
				$mp4->type = 'mp4';
				$mp4->icon = 'facetime-video';
			});

			$merged = $mp3s->merge($mp4s);

			$data = [
				'results' => $merged->shuffle(),
				'cat' => $cat,
				'title' => "Navige Tout $cat->name Yo",
				'mp3count' => $mp3s->count(),
				'mp4count' => $mp4s->count(),
				'author' => ''
			];

			return View::make('cats.show', $data);
		}

		return Redirect::to('/');
	}

	public function catMP3($slug)
	{
		$cat = Category::remember(120)->whereSlug($slug)->first();

		$data = [
			'cat' 	=> $cat,
			'mp3s' 	=> $cat->mp3s()->remember(120)->published()->latest()->paginate(10),
			'title' => $cat->name
		];

		return View::make('cats.mp3', $data);
	}

	public function catMP4($slug)
	{
		$cat = Category::remember(120)->whereSlug($slug)->first();

		$data = [
			'cat' 	=> $cat,
			'mp4s' 	=> $cat->mp4s()->remember(120)->latest()->paginate(10),
			'title' => $cat->name
		];

		return View::make('cats.mp4', $data);
	}

	public function getEdit($id)
	{
		$category 	= Category::findOrFail($id);

		$data = [
			'category' 	 => $category,
			'categories' => Category::orderBy('name')->get(),
			'title' 	 => 'Modifye Kategori ' . $category->name
		];

		return View::make('cats.edit', $data);
	}

	public function putEdit()
	{
		$id = Input::get('id');

		$rules = ['name' => 'required', 'slug' => 'required'];

		$messages = [
			'name.required' => Config::get('site.validate.name.required'),
			'slug.required' => Config::get('site.validate.slug.required')
		];

		$validator = Validator::make( Input::all(), $rules, $messages );

		if ( $validator->fails() )
		{
			return Redirect::to('/admin/cat/edit/' . $id)
							->withErrors($validator);
		}

		$category = Category::findOrFail($id);

		$category->name = Input::get('name');
		$category->slug = Str::slug( Input::get('slug'), '-');
		$category->save();

		Cache::flush();

		return Redirect::to('/admin/cat');
	}

	public function getDelete($id)
	{
		Category::find($id)->delete();

		Cache::flush();

		return Redirect::back();
	}

}