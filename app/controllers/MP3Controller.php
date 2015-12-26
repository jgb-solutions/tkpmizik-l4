<?php

class MP3Controller extends BaseController
{
	public function index()
	{
		$mp3s = MP3::orderBy('id', 'desc')->wherePublish(1)->paginate( 10 );

		return View::make('mp3.index')
					->with( 'mp3s', $mp3s )
					->with('title', 'Navige Tout Mizik Yo');
	}

	public function store()
	{

		$rules = array(
			'name' 	=> 'required|min:6',
			'mp3' 	=> 'required|mimes:mpga|max:100000000',
			'image' => 'required|image'
		);

		$messages = [
			'name.required' 	=> Config::get('site.validate.name.required'),
			'name.min'			=> Config::get('site.validate.name.min'),
			'mp3.required' 		=> Config::get('site.validate.mp3.required'),
			'mp3.mimes' 		=> Config::get('site.validate.mp3.mimes'),
			'mp3.size' 			=> Config::get('site.validate.mp3.size'),
			'image.required' 	=> Config::get('site.validate.image.required'),
			'image.image'		=> Config::get('site.validate.image.image')
		];

		$validator = Validator::make( Input::all(), $rules, $messages );

		if ( $validator->fails() )
		{
			if ( Request::ajax() )
			{
				$response = [];

	        	$response['success'] = false;
	        	$response['errors']	= $validator->messages();

	        	return $response;
			}

			return Redirect::to('/mp3/up')->withErrors( $validator )->withInput();
		}


		/****** MP3 Uploading *******/
		$price 			= Input::get('price');
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

			Image::make( $imageuploadpath . '/' . $imagename )
				->resize( 640, 360, function( $constraint )
				{
					$constraint->aspectratio();
				})
				->save( $imageuploadpath . '/show/' . $imagename );
		}

		$admin_id = User::whereAdmin(1)->first()->id;
		$user_id  = ( Auth::check() ) ? Auth::user()->id : $admin_id;

		if ( $mp3success && $imagesuccess )
		{
			$mp3 			 = new MP3;
			$mp3->name 		 = ucwords( $name );
			$mp3->mp3name	 = $mp3name;
			$mp3->image 	 = $imagename;
			$mp3->user_id 	 = $user_id;
			$mp3->category_id = Input::get('cat');
			$mp3->size 		 = $mp3size;

			if ( $price == 'free' )
			{
				$mp3->publish = 1;
				$mp3->price = $price;
			}

			if ( ! $price )
			{
				$mp3->publish = 1;
				$mp3->price = 'free';
			}

			if ( $price == 'paid')
			{
				$mp3->price = $price;
			}

			$mp3->save();


			/*********** GETID3 **************/
	        $mp3_handler = new \getID3;
	        $mp3_handler->setOption(['encoding'=> 'UTF-8']);

	        $mp3_writter 					= new getid3_writetags;
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

	        if ( Request::ajax() )
	        {
	        	$response = [];

	        	$response['success']  = true;
	        	$response['url'] = $price == 'paid' ? "/mp3/{$mp3->id}/edit" : "/mp3/{$mp3->id}";

	        	return $response;
	        }

	        if ( $price == 'paid')
	        {
				return Redirect::to("mp3/{$mp3->id}/edit");
	        }

			return Redirect::to('mp3/' . $mp3->id );

		} else
		{
			if ( Request::ajax() )
	        {
	        	$response = [];

	        	$response['success'] = false;
	        	$response['message']	= 'Nou regrèt men nou pa reyisi mete mizik ou a. Eseye ankò.';

	        	return $response;
	        }

			return Redirect::to( Request::url() )
				->with('message', 'Nou regrèt men nou pa reyisi mete mizik ou a. Eseye ankò.');
		}

	}

	public function show($id)
	{
		$mp3 = MP3::find($id);

		if ( $mp3 )
		{
			if ( $mp3->price == 'paid' && $mp3->publish )
			{
				return Redirect::to("/mp3/buy/{$mp3->id}");
			}

			if ( $mp3->price == 'paid' && ! $mp3->publish )
			{
				if ( ! Auth::check() )
				{
					return Redirect::to('/404');
				}

				if ( Auth::check() && Auth::user()->id == $mp3->user_id )
				{
					return Redirect::to("/mp3/{$mp3->id}/edit");
				}

			}
		}

		$mp3 = MP3::wherePublish(1)->whereId( $id )->first();

		if ( $mp3 )
		{
			$mp3->views += 1;
			$mp3->save();

			$related = MP3::whereCategoryId($mp3->category_id)
							->whereId($mp3->id)
							->wherePublish(1)
							->orderByRaw('RAND()') // get random rows from the DB
							// ->orderBy('id', true)
							->take( 3 )
							// ->toSql();
							->get(array('id', 'name', 'image', 'play', 'download', 'views'));
			// return $related;

			$author = $mp3->user->name . ' &mdash; ';

			return View::make('mp3.show')
				    ->withMp3($mp3)
				    ->withTitle($mp3->name)
				    ->withRelated($related)
				    ->withAuthor($author);
		}

		return Redirect::to('/404');
	}

	public function edit( $id )
	{
		if ( Auth::check() )
		{
			$mp3 = MP3::whereId( $id )->first();

			if ($mp3)
			{
				if ( Auth::user()->id == $mp3->user_id || User::is_admin() )
				{
					$cats = Category::orderBy('name')->get();

					$title = 'Modifye ' . $mp3->name;
					return View::make('mp3.put')
					    ->with( 'mp3', $mp3 )
					    ->with( 'title', $title )
					    ->with( 'cats', $cats );
				}
			}
		}

		return Redirect::to('/login')
				->withMessage( Config::get('site.message.login') );
	}

	public function update( $id )
	{
		$rules = array(
			'name' 		=> 'min:6',
			'image'		=> 'image'
		);

		$messages = [
			'name.min'			=> Config::get('site.validate.name.min'),
			'image.image'		=> Config::get('site.validate.image.image'),
		];

		$validator = Validator::make( Input::all(), $rules, $messages );

		if ( $validator->fails() ) {
			return Redirect::back()
							->withErrors( $validator );
		}

		$mp3 	= MP3::find($id);

		$code 	= Input::get('code');
		$price 	= Input::get('price');

		if ( $mp3->price == 'paid' && $price == 'paid')
		{
			$rules = [
				'code'	=> 'required|min:8'
			];

			$messages = [
				'code.required'		=> Config::get('site.validate.code.required'),
				'code.min'			=> Config::get('site.validate.code.min')
			];

			$validator = Validator::make( Input::all(), $rules, $messages );

			if ( $validator->fails() )
			{
				return Redirect::back()
								->withErrors( $validator );
			}

			if ( ! empty( $code ) )
			{
				$mp3->code = $code;
			}
		}

		$name = Input::get('name');
		$description = Input::get('description');
		$category = Input::get('cat');
		$publish = Input::get('publish');


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

		if ( !empty( $name ) )
			$mp3->name = $name;

		if ( !empty( $description ) )
			$mp3->description = $description;

		if ( !empty( $image ) )
			$mp3->image = $imagename;

		if ( !empty( $category) )
			$mp3->category_id = $category;

		if ( ! empty( $price ) )
			$mp3->price = $price;

		if ( $publish && $price == 'paid')
		{
			$mp3->publish = 1;
		}

		elseif ( ! $publish && $price == 'paid')
		{
			$mp3->publish = 0;
		}

		else
		{
			$mp3->publish = 1;
		}


		$mp3->save();

		if ( $mp3->price == 'paid' && ! $mp3->publish )
		{
			return Redirect::back()
							->withMessage( Config::get('site.message.update') );
		}

		else if ( $mp3->price == 'paid' && $mp3->publish )
		{
			if ( ! $mp3->code )
			{
				return Redirect::back();
			}

			return Redirect::to("/mp3/buy/{$mp3->id}")
							->withMessage( Config::get('site.message.update') );
		}

		return Redirect::to('/mp3/' . $mp3->id )
			->withMessage( Config::get('site.message.update') );
	}

	public function destroy( $id )
	{
		if ( Auth::check() )
		{
			$mp3 = MP3::find( $id );

			if ( Auth::user()->id == $mp3->user_id || User::is_admin() )
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

					if ( Auth::user()->is_admin() ) return Redirect::back();

					return Redirect::to('/mp3');
				} else
				{
					return Redirect::to('/mp3')
									->withMessage('Nou regrèt men nou pa reyisi efase mizik la.');
				}
			}
		}

		return Redirect::to('/mp3')
			->withMessage('Ou pa gen dwa pou efase mizik la.');

	}

	public function getMP3($id)
	{
		$mp3 = MP3::wherePublish(1)->whereId($id)->first();

		if ( $mp3->price == 'paid')
		{
			if ( ! Auth::check() )
			{
				return Redirect::to('/login')
								->withMessage( Config::get('site.message.login') );
			}

			if ( Auth::check() )
			{
				$user = Auth::user();

				$bought = MP3Sold::whereUserId($user->id)
								 ->whereMp3Id($mp3->id)
								 ->first();

				if ( ! $bought )
				{
					return Redirect::to("/mp3/buy/$mp3->id")
									->withMessage( Config::get('site.message.must-buy') );
				}

			}
		}

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
		$mp3 = MP3::wherePublish(1)->whereId( $id )->first();

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
			->withCats($cats)
			->withTitle('Mete Mizik');
	}

	private function friendly_size( $size, $round = 2 )
	{
	    $sizes = [' B', ' KB', ' MB'];

	    $total = count( $sizes ) - 1 ;

	    for ( $i = 0; $size > 1024 && $i < $total; $i++ )
	    {
	        $size /= 1024;
	    }

	    return round( $size, $round ) . $sizes[ $i ];
	}

	// public function eventListener()
	// {
	// 	Event::listen('tweet_music', function( $mp3 )
	// 	{
	// 		//Auto-Post Tweet
	//         Twitter::postTweet(array(
	//         	'status' => $mp3->name . ' ' . Config::get('site.url') . '/mp3/' . $mp3->id,
	//         	'format' => 'json'
	//         ));
	// 	});

	// 	Event::listen('sendMail', function( $email )
	// 	{
	// 		$data['name'] 			= 'Ti Kwen Pam Mizik';
	// 		$data['email'] 			= $email;
	// 		$data['mailMessage'] 	= 'Message send from TKPMizik';

	// 		Mail::queue('mail', $data, function( $message ) use ($data)
	// 		{
	// 			$message->to( Config::get('site.email'), Config::get('site.name') )
	// 					->subject('Ou gen yon nouvo imel KG.')
	// 					->replyTo( $data['email'] );
	// 		});
	// 	});
	// }

	public function getBuy($id)
	{
		$mp3 = MP3::wherePublish(1)
				->wherePrice('paid')
				->whereId($id)
				->first();

		if ( $mp3 )
		{
			$mp3->views += 1;
			$mp3->save();

			$bought = '';

			if ( Auth::check() )
			{
				$user = Auth::user();

				$bought = MP3Sold::whereUserId($user->id)
								  ->whereMp3Id($mp3->id)
								  ->first();
			}

			$related = MP3::whereCategoryId($mp3->category_id)
							->whereId($mp3->id)
							->wherePublish(1)
							->orderByRaw('RAND()') // get random rows from the DB
							// ->orderBy('id', true)
							->take( 3 )
							// ->toSql();
							->get(array('id', 'name', 'image', 'play', 'download', 'views'));
			// return $related;

			$author = $mp3->user->name . ' &mdash; ';

			$title = "Achte $mp3->name";
			return View::make('mp3.buy')
				    ->withMp3($mp3)
				    ->withTitle($title)
				    ->withRelated($related)
				    ->withAuthor($author)
				    ->withBought($bought);
		}

		return Redirect::to('/404');
	}

	public function postBuy($id)
	{
		$code = Input::get('code');

		if ( Auth::check() )
		{
			$mp3 = MP3::find($id);
			$user = Auth::user();

			$bought = MP3Sold::whereUserId($user->id)
							  ->whereMp3Id($mp3->id)
							  ->first();

			if ( $user->id == $mp3->user_id )
			{
				return Redirect::back()
								->withMessage( Config::get('site.message.cant-buy') );
			}

			if ( $bought )
			{
				return Redirect::to('/user/my-bought-mp3s')
								->withMessage( Config::get('site.message.bought-already') );
			}

			if ( $code == $mp3->code )
			{
				$sold = new MP3Sold;

				$sold->user_id = $user->id;
				$sold->mp3_id = $mp3->id;

				$sold->save();

				return Redirect::to("/user/my-bought-mp3s")
								->withMessage( Config::get('site.message.bought-success') );
			}
			else
			{
				return Redirect::back()
								->withMessage( Config::get('site.message.bought-failed') );
			}

		}

		return Redirect::to('/login')
						->withMessage( Config::get('site.message.login') );

	}
}