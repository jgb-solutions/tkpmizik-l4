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
			$categories = Category::orderBy('name')->get();

			return View::make('cats.create')
						->with('categories', $categories )
						->with('title', 'Kreye Yon Nouvo Kategori');
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

		$name = Input::get('name');
		$slug = Str::slug( Input::get('slug', '-') );

		$category 		= new Category;
		$category->name = $name;
		$category->slug = $slug;
		$category->save();

		return Redirect::to('/admin/cat');

	}

	public function getShow( $slug )
	{
		$type = Input::get('type');

		if ( isset( $type ) && ! empty( $type ) )
		{
			$fn = 'cat' . $type;
			return $this->$fn( $slug );
		}

		$cat = Category::whereSlug( $slug )->first();

		if ( $cat )
		{
			$mp3s = MP3::wherePublish(1)->whereCategoryId( $cat->id )->take( 20 )->get();
			$mp4s = MP4::whereCategoryId( $cat->id )->take( 20 )->get();

			$mp3s->each( function( $mp3 )
			{
				$mp3->type = 'mp3';
				$mp3->icon = 'music';
			});

			$mp4s->each( function( $mp4 )
			{
				$mp4->type = 'mp4';
				$mp4->icon = 'facetime-video';
			});

			$results = $mp3s->merge( $mp4s );
			$results = $results->shuffle();

			return View::make('cats.show')
						->with('results', $results )
						->with('cat', $cat )
						->with('title', $cat->name )
						->with('mp3count', $mp3s->count() )
						->with('mp4count', $mp4s->count() );
		}

		return Redirect::to('/');
	}

	public function catMP3( $slug )
	{
		$cat = Category::whereSlug( $slug )->first();

		$mp3s = MP3::wherePublish(1)->whereCategoryId( $cat->id )->paginate( 10 );

		return View::make('cats.mp3')
					->with('cat', $cat )
					->with('mp3s', $mp3s )
					->with('title', $cat->name );
	}

	public function catMP4( $slug )
	{
		$cat = Category::whereSlug( $slug )->first();

		$mp4s = MP4::whereCategoryId( $cat->id )->paginate( 10 );

		return View::make('cats.mp4')
					->with('cat', $cat )
					->with('mp4s', $mp4s )
					->with('title', $cat->name );
	}

	public function getEdit( $id )
	{
		$category 	= Category::find( $id );
		$categories = Category::orderBy('name')->get();
		return View::make('cats.edit')
						->with('category', $category )
						->with('categories', $categories )
						->with('title', 'Modifye Kategori ' . $category->name );
	}

	public function putEdit()
	{
		$category = Category::find( Input::get('id') );

		$category->name = Input::get('name');
		$category->slug = Str::slug( Input::get('slug'), '-');
		$category->save();

		return Redirect::to('/cat/create');
	}

	public function getDelete( $id )
	{
		Category::find($id)->delete();

		return Redirect::back();
	}

}