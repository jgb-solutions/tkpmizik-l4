<?php

class MP3Controller extends BaseController
{
	public function index()
	{
		$mp3s = MP3::orderBy('id', 'desc')->paginate( 10 );

		return View::make('mp3.index')
					->with( 'mp3s', $mp3s )
					->with('title', 'Navige Tout Mizik Yo');
	}

	public function store()
	{

		$rules = array(
			'name' 	=> 'required|min:6',
			'mp3' 	=> 'required',
			'image' => 'required|image'
		);

		$messages = [
			'name.required' 	=> 'Non an obligatwa. Fòk ou mete li.',
			'name.min'			=> 'Fòk non an pa pi piti pase 6 karaktè. Ajoute plis pase 6.',
			'mp3.required' 		=> 'Fòk ou chwazi yon fichye MP3.',
			'image.required' 	=> 'Fòk ou chwazi yon imaj pou asosye ak mizik la.',
			'image.image'		=> 'Fòk ou chwazi yon bon imaj.'
		];

		$validator = Validator::make( Input::all(), $rules, $messages );

		if ( $validator->fails() || strtolower( Input::file('mp3')->getClientOriginalExtension() ) != 'mp3' ) {
			return Redirect::to('/mp3/up')->withErrors( $validator )->withInput();
		}


		/****** MP3 Uploading *******/
		$name 			= Input::get('name');
		$mp3 			= Input::file('mp3');
		$mp3size 		= $this->friendly_size( $mp3->getClientsize() );
		$mp3ext 		= $mp3->getClientOriginalExtension();
		$mp3name 		= Str::slug( $name, '-') . '-' . Str::random( 32 ) . '.' . $mp3ext;
		$mp3uploadpath 	= Config::get('site.mp3_upload_path');

		$mp3success 	= $mp3->move( $mp3uploadpath, $mp3name );

		/************ Image Uploading *****************/
		$image 			 = Input::file('image');
		$imageext 		 = $image->getClientOriginalExtension();
		$imagename 		 = Str::slug( $name, '-' ) . '-' . Str::random( 32 ) . '.' . $imageext;
		$imageuploadpath = Config::get('site.image_upload_path');
		$imagesuccess 	 = $image->move( $imageuploadpath, $imagename );

		if ( $imagesuccess ) {
			Image::make( $imageuploadpath . '/' . $imagename )
				->resize( 250, 250, function( $constraint )
				{
					$constraint->aspectratio();
				})
				->save( $imageuploadpath . '/thumbs/' . $imagename );

			Image::make( $imageuploadpath . '/' . $imagename )
				->resize( 100, null, function( $constraint )
				{
					$constraint->aspectratio();
				})
				->save( $imageuploadpath . '/thumbs/tiny/' . $imagename );
		}

		$admin_id = User::where('admin', 1)->first()->id;
		$user_id = ( Auth::check() ) ? Auth::user()->id : $admin_id;

		if ( $mp3success && $imagesuccess )
		{

			$mp3 = MP3::create(array(
				'name' 			=> $name,
				'mp3name'		=> $mp3name,
				'image' 		=> $imagename,
				'user_id'		=> $user_id,
				'category_id' 	=> Input::get('cat'),
				'size'			=> $mp3size
			));


			/*********** GETID3 **************/
	        $mp3_handler = new \getID3;
	        $mp3_handler->setOption( array('encoding'=> 'UTF-8') );

	        $mp3_writter = new getid3_writetags;
	        $mp3_writter->filename          = Config::get('site.mp3_upload_path') . '/' . $mp3->mp3name;
	        $mp3_writter->tagformats        = array('id3v1', 'id3v2.3');
	        $mp3_writter->overwrite_tags    = true;
	        $mp3_writter->tag_encoding      = 'UTF-8';
	        $mp3_writter->remove_other_tags = true;


	        $mp3_data['title'][]   = $mp3->name;
	        $mp3_data['artist'][]  = Config::get('site.name') . ' --|-- ' . Config::get('site.url'); //$mp3_artist;
	        $mp3_data['album'][]   = Config::get('site.name') . ' --|-- ' . Config::get('site.url');
	        // $mp3_data['year'][]    = $mp3_year;
	        // $mp3_data['genre'][]   = $mp3_genre;
	        $mp3_data['comment'][] = Config::get('site.name') . ' --|-- ' . Config::get('site.url');


	        $mp3_data['attached_picture'][0]['data'] = file_get_contents('images/logo_tkp.jpg' );
	        $mp3_data['attached_picture'][0]['picturetypeid'] = "image/jpg";
	        $mp3_data['attached_picture'][0]['description'] = "Ti Kwen Pam --|-- Mizik, Videyo, News!";
	        $mp3_data['attached_picture'][0]['mime'] = "image/jpg";


	        $mp3_writter->tag_data = $mp3_data;
	        $mp3_writter->WriteTags();

	        // Fireing the Twitter event to tweet automatically
	        Event::fire('tweet_music', [ $mp3 ]);

			return Redirect::to('mp3/' . $mp3->id );

		} else {
			return Redirect::to( Request::url() )
				->with('message', 'Nou regrèt men nou pa reyisi mete mizik ou a. Eseye ankò.');
		}

	}

	public function show( $id )
	{
		$mp3 = MP3::findOrFail( $id );
		$mp3->views += 1;
		$mp3->save();

		$related = MP3::where('category_id', $mp3->category_id)
						->where('id', '!=', $mp3->id)
						->orderByRaw('RAND()') // get random rows from the DB
						// ->orderBy('id', true)
						->take( 3 )
						// ->toSql();
						->get(array('id', 'name', 'image', 'play', 'download', 'views'));
		// return $related;
		$authorName = '';

		if ( Auth::user() )
		{
			$user = Auth::user();
			$authorName = $user->name ? $user->name . ' &mdash; ' : '';
		}


		return View::make('mp3.show')
			    ->with('mp3', $mp3)
			    ->with('title', $authorName .  $mp3->name)
			    ->with('related', $related);
	}

	public function edit( $id )
	{
		$mp3 = MP3::whereId( $id )->first();
		$cats = Category::orderBy('name')->get();

		if( Auth::check() && Auth::user()->id == $mp3->user_id || User::is_Admin() ) {
			return View::make('mp3.put')
			    ->with( 'mp3', $mp3 )
			    ->with( 'title', $mp3->name )
			    ->with( 'cats', $cats );
		}

		return Redirect::to('/mp3')
				->with('message', 'You don\'t have the rights to edit this music');
	}

	public function update( $id )
	{
		$rules = array(
			'name' 		=> 'min:6',
			'image'		=> 'image'
		);

		$messages = [
			'name.min'			=> 'Fòk non an pa pi piti pase 6 karaktè. Ajoute plis pase 6.',
			'image.image'		=> 'Fòk ou chwazi yon bon imaj.'
		];

		$validator = Validator::make( Input::all(), $rules, $messages );

		if ( $validator->fails() ) {
			return Redirect::to( Request::url() )
				->withErrors( $validator );
		}

		$name = Input::get('name');
		$description = Input::get('description');
		$category = Input::get('cat');

		$image = Input::file('image');

		if ( isset( $image ) ) {
			$imageext = $image->getClientOriginalExtension();
			$imagename = Str::slug( $name, '-' ) . '-' . Str::random( 32 ) . '.' . $imageext;
			$imageuploadpath = Config::get('site.image_upload_path');
			$imagesuccess = $image->move( $imageuploadpath, $imagename );

			if ( $imagesuccess ) {
				Image::make( $imageuploadpath . '/' . $imagename )
					->resize( 250, 250, function( $constraint )
					{
						$constraint->aspectratio();
					})
					->save( $imageuploadpath . '/thumbs/' . $imagename );
			}
		}

		$mp3 = MP3::find( $id );

		if ( !empty( $name ) )
			$mp3->name = $name;

		if ( !empty( $description ) )
			$mp3->description = $description;

		if ( !empty( $image ) )
			$mp3->image = $imagename;

		if ( !empty( $category) )
			$mp3->category_id = $category;

		$mp3->save();

		return Redirect::to('/mp3/' . $mp3->id )
			->with('message', 'Mizik la mete a jou avèk sisksè!');
	}

	public function destroy( $id )
	{
		if ( Auth::check() ) {

			$mp3 = MP3::find( $id );

			if ( Auth::user()->id == $mp3->user_id || User::is_Admin() )
			{
				if ( $mp3 )
				{
					Vote::whereObj('MP3')
						->whereObjId( $mp3->id )
						->whereUserId( Auth::user()->id )
						->delete();

					$mp3->delete();

					File::delete( Config::get('site.mp3_upload_path') . '/' . $mp3->mp3name );
					File::delete( Config::get('site.image_upload_path') . '/' . $mp3->image );
					File::delete( Config::get('site.image_upload_path') . '/thumbs/' . $mp3->image );
					File::delete( Config::get('site.image_upload_path') . '/tiny/' . $mp3->image );

					return Redirect::to('/mp3');
				} else
				{
					return 'Nou regrèt men nou pa reyisi efase mizik la.';
				}
			}
		}

		return Redirect::to('/mp3')
			->with('message', 'Ou pa gen dwa pou ou modifye mizik la.');

	}

	public function getMP3( $id )
	{
		$mp3 = MP3::find( $id );

		$mp3->download = $mp3->download + 1;
		$mp3->save();

		if ( $mp3 )
		{
			$mp3name = Config::get('site.mp3_upload_path') . '/' . $mp3->mp3name;
			header('Content-Description: File Transfer');
		    header('Content-Type: application/octet-stream');
		    header('Content-Disposition: attachment; filename=' . $mp3->name . '.mp3' );
		    header('Expires: 0');
		    header('Cache-Control: must-revalidate');
		    header('Pragma: public');
		    header('Content-Length: ' . filesize( $mp3name ) );
		    readfile( $mp3name ) ;
		    exit;

		} else
		{
			return 'Nou regrèt men nou pa jwenn mizik ou ap eseye telechaje a.';
		}
	}

	public function getPlayMP3( $id )
	{
		$mp3 = MP3::find( $id );
		$mp3->play = $mp3->play + 1;
		$mp3->save();

		$mp3name = Config::get('site.mp3_upload_path') . '/' . $mp3->mp3name;
		header("Content-Type: audio/mpeg");
	    header("Content-Length: " . filesize( $mp3name ) );
	    header('Content-Disposition: filename=' . $mp3->name . '.mp3' );
	    header('X-Pad: avoid browser bug');
	    header('Cache-Control: no-cache');
	    readfile( $mp3name );
	}

	public function getMP3Up()
	{
		$cats = Category::orderBy('name')->get();

		return View::make('mp3.up')
			->with('cats', $cats)
			->with('title', 'Mete Yon Mizik');
	}

	private function friendly_size( $size, $round = 2 )
	{
	    $sizes = array(' B', ' KB', ' MB');
	    $total = count( $sizes ) - 1 ;

	    for ( $i = 0; $size > 1024 && $i < $total; $i++ )
	    {
	        $size /= 1024;
	    }

	    return round( $size, $round ) . $sizes[ $i ];
	}

	public function eventListener()
	{
		Event::listen('tweet_music', function( $mp3 )
		{
			//Auto-Post Tweet
	        Twitter::postTweet(array(
	        	'status' => $mp3->name . ' ' . Config::get('site.url') . '/mp3/' . $mp3->id,
	        	'format' => 'json'
	        ));
		});

		Event::listen('sendMail', function( $email )
		{
			$data['name'] 			= 'Ti Kwen Pam Mizik';
			$data['email'] 			= $email;
			$data['mailMessage'] 	= 'Message send from TKPMizik';

			Mail::queue('mail', $data, function( $message ) use ($data)
			{
				$message->to( Config::get('site.email'), Config::get('site.name') )
						->subject('Ou gen yon nouvo imel KG.')
						->replyTo( $data['email'] );
			});
		});
	}
}