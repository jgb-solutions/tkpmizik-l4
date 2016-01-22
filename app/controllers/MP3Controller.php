<?php

class MP3Controller extends BaseController
{
	public function index()
	{
		$data = [
			'mp3s'	=> MP3::remember(60)->latest()->published()->paginate(10),
			'title'	=> 'Navige Tout Mizik Yo'
		];

		return View::make('mp3.index')->with($data);
	}

	public function listBuy()
	{
		$data = [
			'mp3s'	=> MP3::remember(120)->latest()->published()->paid()->paginate(10),
			'title'	=> 'Mizik Pou Vann'
		];

		return View::make('mp3.list-buy')->with($data);

	}

	public function store()
	{
		$rules = [
			'name' 	=> 'required|min:6',
			'mp3' 	=> 'required|mimes:mpga|max:100000000',
			'image' => 'required|image'
		];

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

		$storedMP3 = MP3::whereName(Input::get('name'))->first();

		if ($storedMP3)
		{
			if ( Request::ajax() )
	        {
	        	$response = [];

	        	$response['success']  = true;
	        	$response['url'] = $storedMP3->price == 'paid' ? "/mp3/{$storedMP3->id}/edit" : "/mp3/{$storedMP3->id}";

	        	return $response;
	        }

			return Redirect::to("mp3/{$storedMP3->id}");
		}


		/****** MP3 Uploading *******/
		$price 			= Input::get('price');
		$name 			= Input::get('name');
		$mp3 			= Input::file('mp3');
		$mp3size 		= TKPM::size($mp3->getClientsize());
		$mp3ext 		= $mp3->getClientOriginalExtension();
		$mp3name 		= Str::slug( $name, '-') . '-' . Str::random( 32 ) . '.' . $mp3ext;
		$mp3uploadpath 	= Config::get('site.mp3_upload_path');

		$mp3success 	= $mp3->move( $mp3uploadpath, $mp3name );

		/************ Image Uploading *****************/
		$image 			 = Input::file('image');
		$img_type		= $image->getMimeType();
		$imageext 		 = $image->getClientOriginalExtension();
		$imagename 		 = Str::slug( $name, '-' ) . '-' . Str::random( 32 ) . '.' . $imageext;
		$imageuploadpath = Config::get('site.image_upload_path');
		$imagesuccess 	 = $image->move($imageuploadpath, $imagename);

		if ($imagesuccess)
		{
			TKPM::image($imagename, 250, 250, 'thumbs');
			TKPM::image($imagename, 100, null, 'thumbs/tiny');
			TKPM::image($imagename, 640, 360, 'show');
		}

		$admin_id = User::whereAdmin(1)->first()->id;
		$user_id  = ( Auth::check() ) ? Auth::user()->id : $admin_id;

		if ( $mp3success && $imagesuccess )
		{
			$mp3 			 = new MP3;
			$mp3->name 		 = ucwords($name);
			$mp3->mp3name	 = $mp3name;
			$mp3->image 	 = $imagename;
			$mp3->user_id 	 = $user_id;
			$mp3->category_id = Input::get('cat');
			$mp3->size 		 = $mp3size;

			if ($price == 'free')
			{
				$mp3->publish = 1;
				$mp3->price = $price;
			}

			if (! $price)
			{
				$mp3->publish = 1;
				$mp3->price = 'free';
			}

			if ($price == 'paid')
			{
				$mp3->price = $price;
			}

			$mp3->description = Input::get('description');

			$mp3->save();


			/*********** GETID3 **************/
			TKPM::tag($mp3, $imagename, $img_type);

			/******* Flush the cache ********/
			Cache::flush();

			if ($mp3->price == 'paid')
			{
				// Send a  email to the new user letting them know their music has been uploaded
				$data = [
					'mp3' 		=> $mp3,
					'subject' 	=> 'Felisitasyon!!! Ou fèk mete yon nouvo mizik pou vann.'
				];

				TKPM::sendMail('emails.user.buy', $data, 'mp3');
			} else
			{
				// Send a  email to the new user letting them know their music has been uploaded
				$data = [
					'mp3' 		=> $mp3,
					'subject' 	=> 'Felisitasyon!!! Ou fèk mete yon nouvo mizik'
				];

				TKPM::sendMail('emails.user.mp3', $data, 'mp3');
			}


			if ( App::environment() == 'production')
			{
				TKPM::tweet($mp3, 'mp3');
			}

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

	        Cache::forget('latest.musics');

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
		$key = '_mp3_show_' . $id;

		if (Cache::has($key))
		{
			$data = Cache::get($key);
			return View::make('mp3.show')->with($data);
		}

		$mp3 = MP3::with('user', 'category')->findOrFail($id);

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

		// $mp3->views += 1;
		// $mp3->save();

		$related = MP3::remember(120)->related($mp3)
						->get(['id', 'name', 'image', 'play', 'download', 'views']);
		// return $related;

		$author = $mp3->user->username ? '@' . $mp3->user->username . ' &mdash;' : $mp3->user->name . ' &mdash; ';

		$data = [
			'mp3' 		=> $mp3,
			'title'		=> $mp3->name,
			'related'	=> $related,
			'author'	=> $author
		];

		Cache::put($key, $data, 120);
		return View::make('mp3.show')->with($data);
	}

	public function edit($id)
	{
		if ( Auth::check() )
		{
			$mp3 = MP3::whereId($id)->first();

			if ($mp3)
			{
				if ( Auth::user()->id == $mp3->user_id || User::is_admin() )
				{
					$data = [
						'mp3'	=> $mp3,
						'title'	=> 'Modifye ' . $mp3->name,
						'cats'	=> Category::orderBy('name')->get()
					];

					return View::make('mp3.put')->with($data);
				}
			}
		}

		return Redirect::to('/login')
				->withMessage( Config::get('site.message.login') );
	}

	public function update( $id )
	{
		Cache::flush();

		$rules = [
			'name' 		=> 'min:6',
			'image'		=> 'image'
		];

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

		if ( $mp3->price == 'paid')
		{
			$rules = [
				'code'	=> 'required|min:8'
			];

			$messages = [
				'code.required'	=> Config::get('site.validate.code.required'),
				'code.min'		=> Config::get('site.validate.code.min')
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

		if ( isset($image) )
		{
			$imageext = $image->getClientOriginalExtension();
			$imagename = Str::slug( $name, '-' ) . '-' . Str::random( 32 ) . '.' . $imageext;
			$imageuploadpath = Config::get('site.image_upload_path');
			$imagesuccess = $image->move( $imageuploadpath, $imagename );

			if ($imagesuccess)
			{
				TKPM::image($imagename, 250, 250, 'thumbs');
				TKPM::image($imagename, 100, null, 'thumbs/tiny');
				TKPM::image($imagename, 640, 360, 'show');
			}
		}

		if ( !empty( $name ) )
			$mp3->name = $name;

		if ( !empty( $description ) )
		{
			$mp3->description = $description;
		}

		if ( !empty( $image ) )
		{
			$mp3->image = $imagename;
		}

		if ( !empty( $category) )
		{
			$mp3->category_id = $category;
		}

		if ( ! empty( $price ) )
		{
			$mp3->price = $price;
		}

		if ( $publish && $price == 'paid')
		{
			$mp3->publish = 1;
		}

		elseif ( ! $publish && $price == 'paid')
		{
			$mp3->publish = 0;
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

	public function destroy($id)
	{
		Cache::flush();

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
					File::delete( Config::get('site.image_upload_path') . '/show/' . $mp3->image );

					if ( Auth::user()->is_admin() ) return Redirect::to('/admin/mp3');

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
		$mp3 = MP3::published()->whereId($id)->first();

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

				if ( ! $bought && ! $user->is_admin() )
				{
					return Redirect::to("/mp3/buy/$mp3->id")
									->withMessage( Config::get('site.message.must-buy') );
				}

			}
		}

		TKPM::download($mp3);
	}

	public function getPlayMP3($id)
	{
		$mp3 = MP3::published()->whereId($id)->first();

		if ($mp3->price == 'paid')
		{
			return Redirect::to("/mp3/buy/$mp3->id")
							->withMessage( Config::get('site.message.cant-play') );
		}

		TKPM::stream($mp3);
	}

	public function getMP3Up()
	{
		$data = [
			'title'	=> 'Mete Mizik',
			'cats'	=> Category::remember(120, 'categories')->orderBy('name')->get()
		];

		return View::make('mp3.up')->with($data);
	}


	public function getBuy($id)
	{
		$key = '_mp3_buy_' . $id;

		if (Cache::has($key))
		{
			$data = Cache::get($key);
			return View::make('mp3.buy')->with($data);
		}

		$mp3 = MP3::with('user', 'category')
				->published()
				->paid()
				->findOrFail($id);

		// $mp3->views += 1;
		// $mp3->save();

		$data = [];
		$data['bought'] = '';

		if ( Auth::check() )
		{
			$user = Auth::user();

			$data['bought'] = $user->bought()->whereMp3Id($mp3->id)->first();
		}

		$data['related'] = MP3::remember(120)->related($mp3)
						->get(['id', 'name', 'image', 'play', 'download', 'views']);

		$data['author'] = $mp3->user->name . ' &mdash; ';
		$data['title'] = "Achte $mp3->name";
		$data['mp3']	= $mp3;

		Cache::put($key, $data, 120);

		return View::make('mp3.buy')->with($data);
	}

	public function postBuy($id)
	{
		$code = Input::get('code');

		if ( Auth::check() )
		{
			$mp3 = MP3::find($id);
			$user = Auth::user();

			if ($user->id == $mp3->user_id)
			{
				return Redirect::back()
								->withMessage( Config::get('site.message.cant-buy') );
			}

			$bought = MP3Sold::whereUserId($user->id)
							  ->whereMp3Id($mp3->id)
							  ->first();

			if ($bought)
			{
				return Redirect::to('/user/my-bought-mp3s')
								->withMessage( Config::get('site.message.bought-already') );
			}

			if ($code == $mp3->code)
			{
				$sold = new MP3Sold;
				$sold->user_id 	= $user->id;
				$sold->mp3_id 	= $mp3->id;
				$sold->save();

				$mp3->buy_count += 1;
				$mp3->save();

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