<?php

class MP4Controller extends BaseController
{
	public function index()
	{
		$mp4s = MP4::orderBy('created_at', 'desc')->paginate(10);

		return View::make('mp4.index')
			->withMp4s($mp4s)
			->withTitle('Navige Tout Videyo Yo');
	}

	public function getCreate()
	{
		$categories = Category::orderBy('name')->get();

		return View::make('mp4.up')
					->withCategories($categories)
					->withTitle('Mete Yon Videyo YouTube');
	}

	public function store()
	{
		// return Input::all();
		$rules = array(
			'name' 	=> 'required|min:6',
			'url' 	=> 'required|url|min:11',
		);

		$messages = [
			'name.required' 	=> 'Non an obligatwa. Fòk ou mete li.',
			'name.min'			=> 'Fòk non an pa pi piti pase 6 karaktè. Ajoute plis pase 6.',
			'url.required'		=> 'Fòk ou antre yon lyen. Li obligatwa.',
			'url.url'			=> 'Fòk ou antre yon bon lyen. Sa ou mete a pa bon.',
			'url.min'			=> 'Fòk lyen an pa pi piti pase 11 karaktè. Ajoute plis pase 11.'
		];

		$validator = Validator::make(Input::all(), $rules, $messages);

		if ( $validator->fails() )
		{
			return Redirect::back()
							->withErrors($validator)
							->withInput();
		}

		// Extracts the YouTube ID from various URL structures
		$name = Input::get('name');
		$url = Input::get('url');

		if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match))
		{
	    	$id 		=	$match[1];
	    	$image_url 	=	"http://img.youtube.com/vi/$id/hqdefault.jpg";
		} else
		{
			return Redirect::back()
							->withMessage( Config::get('site.message.youtube-failed'));
		}

		// Check if there's a user logged in. If not, use the admin ID.
		$admin_id = User::whereAdmin(1)->first()->id;
		$user_id = ( Auth::check() ) ? Auth::user()->id : $admin_id;

		// Insert the infos in the database
		$mp4 				= new MP4;
		$mp4->name 			= Input::get('name');
		$mp4->youtube_id  	= $id;
		$mp4->image 		= $image_url;
		$mp4->user_id 		= $user_id;
		$mp4->category_id 	= Input::get('cat');
		$mp4->save();

		return Redirect::to('mp4/' . $mp4->id );
	}

	public function show($id)
	{
		$mp4 = MP4::find($id);

		$mp4->views += 1;
		$mp4->save();

		$related = MP4::whereCategoryId($mp4->category_id)
						->where('id', '!=', $mp4->id)
						->orderByRaw('RAND()') // get random rows from the DB
						// ->orderBy('id', true)
						->take( 3 )
						// ->toSql();
						->get(['id', 'name', 'image', 'download', 'views']);
		// return $related;

		$author = $mp4->user->name . ' &mdash; ';

		return View::make('mp4.show')
			    ->withMp4($mp4)
			    ->withTitle($mp4->name)
			    ->withRelated($related)
			    ->withAuthor($author);
	}

	public function edit($id)
	{
		$mp4 = MP4::whereId($id)->first();
		$cats = Category::orderBy('name')->get();

		if ( Auth::check() )
		{
			$user = Auth::user();

			if ( $user->id == $mp4->user_id || $user->is_admin() )
			{
				return View::make('mp4.put')
				    ->with( 'mp4', $mp4 )
				    ->with( 'title', $mp4->name )
				    ->with( 'cats', $cats );
			} else
			{
				return Redirect::to('/mp4')
								->withMessage('Ou pa gen dwa pou w modifye videyo a.');
			}
		}

		return Redirect::to('/mp4')
				->with('message', 'Fòk ou konekte w pou w ka aksede ak paj ou vle a.');
	}

	public function update($id)
	{
		$rules = array(
			'name' 		=> 'min:6',
			'image'		=> 'image'
		);

		$messages = [
			'name.min'			=> 'Fòk non an pa pi piti pase 6 karaktè. Ajoute plis pase 6.',
			'image.image'		=> 'Fòk ou chwazi yon bon imaj.'
		];

		$validator = Validator::make( Input::all(), $rules );

		if ( $validator->fails() ) {
			return Redirect::to( Request::url() )
				->withErrors( $validator );
		}

		$name = Input::get('name');
		$description = Input::get('description');
		$category = Input::get('cat');

		$mp4 = MP4::find( $id );

		if ( !empty( $name ) ) $mp4->name = $name;
		if ( !empty( $description ) )$mp4->description = $description;
		if ( !empty( $image ) ) $mp4->image = $imagename;
		if ( !empty( $category) ) $mp4->category_id = $category;

		$mp4->save();

		return Redirect::to('/mp4/' . $mp4->id )
			->with('message', 'Updated successfully!');
	}

	public function destroy( $id )
	{
		if ( Auth::check() ) {

			$mp4 = MP4::find( $id );

			if ( Auth::user()->id == $mp4->user_id || User::is_Admin() )
			{
				if ( $mp4 )
				{
					$mp4->delete();

					File::delete( Config::get('site.image_upload_path') . '/' . $mp4->image );
					File::delete( Config::get('site.image_upload_path') . '/thumbs/' . $mp4->image );
					File::delete( Config::get('site.image_upload_path') . '/tiny/' . $mp4->image );

					return Redirect::to('/mp4');
				} else
				{
					return 'Could not be deleted. Sorry!';
				}
			}
		}

		return Redirect::to('/mp4')
			->with('message', 'You don\'t have the rights to edit this video');

	}

	public function getMP4( $id )
	{
		$mp4 = MP4::find( $id );

		$mp4->download += 1;
		$mp4->save();

		if ( $mp4 )
		{
			$yt_url = 'http://savefrom.net/#url=' . urlencode( 'https://www.youtube.com/watch?v=' . $mp4->youtube_id );
			return Redirect::to($yt_url);
		} else
		{
			return Redirect::to('/mp4')
							->withMessage('Nou regrèt, men ou pa ka telechaje videyo ou vle a.');
		}
	}

}