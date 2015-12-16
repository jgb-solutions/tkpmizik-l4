<?php

class UserController extends BaseController
{
	public function getLogin()
	{
		if ( ! Auth::check() )
		{
			return View::make('login.login');
		}
;
		return Redirect::to('/');
	}

	public function postLogin()
	{
		$credentials = Input::only('email', 'password');

		if ( Auth::attempt( $credentials ) )
		{
			return Redirect::to( '/user' )
				->with('message', 'Byenvini ankò, ' . explode(' ', Auth::user()->name )[0] . '!');
		} else {
			return Redirect::to('/login')
				->with('error', 'Imel oubyen Modpas la pa kòrèk. Tanpri rantre yo epi eseye ankò.')
				->withInput();
		}
	}

	public function getLogout()
	{
		Auth::logout();

		return Redirect::to('/');
	}

	public function postRegister()
	{
		$rules = array(
			'name' 		=> 'required|min:6',
			'email' 	=> 'required|email|different:name',
			'password' 	=> 'required|same:password_confirm|min:6',
			'telephone'	=> 'numeric'
		);

		$messages = [
			'name.required' 	=> Config::get('site.validate.name.required'),
			'name.min'			=> Config::get('site.validate.name.min'),
			'email.required' 	=> Config::get('site.validate.email.required'),
			'email.email' 		=> Config::get('site.validate.email.email'),
			'email.different' 	=> Config::get('site.validate.email.different'),
			'password.required' => Config::get('site.validate.password.required'),
			'password.min' 		=> Config::get('site.validate.password.min')		,
			'password.same' 	=> Config::get('site.validate.password.same'),
			'telephone.numeric' => Config::get('site.validate.telephone.numeric')
		];

		$validator = Validator::make( Input::all(), $rules, $messages );

		if ( $validator->fails() )
		{
			return Redirect::to('/register')
							->withErrors( $validator )
							->withInput();
		}

		$name 		= Input::get('name');
		$email 		= Input::get('email');
		$password 	= Input::get('password');
		$telephone 	= Input::get('telephone');

		$test_email = User::where('email', $email )->first();

		if ( $test_email )
		{
			return Redirect::to('/register')
							->withInput()
							->with('message', 'Imel sa a itilize deja. Si se pou ou li ye, tanpri <a href="/login">konekte ou</a>. Sinon chwazi yon lòt imel.');
		}

		$user = new User;

		$user->name 		= $name;
		$user->password 	= Hash::make( $password );
		$user->email 		= $email;
		$user->telephone 	= $telephone;

		$user->save();

		$credentials = [ 'email' => $email, 'password' => $password ];

		if ( Auth::attempt( $credentials ) )
		{
			$message = 'Byenvini, ' . explode(' ', Auth::user()->name )[0] . '! <small>Ajoute yon <a href="/user/edit">foto pwofil</a></small>';
			return Redirect::to( '/user' )
							->with('message', $message);
		} else
		{
			return Redirect::to('/login')
							->with('error', 'Imel oubyen modpas ou pa kòrèk. Tanpri antre yo byen epi eseye konekte w ankò.')
							->withInput();
		}

	}

	public function getRegister()
	{
		if ( Auth::check() ) {
			return Redirect::to('/');
		}

		return View::make('login.register');
	}

	public function getUser()
	{
		$user 				= Auth::user();

		$mp3s 				= MP3::whereUserId( $user->id )->orderBy('created_at', 'desc')->take( 5 )->get();
		$mp4s 				= MP4::whereUserId( $user->id )->orderBy('created_at', 'desc')->take( 5 )->get();
		$mp3count 			= MP3::whereUserId( $user->id )->count();
		$mp4count 			= MP4::whereUserId( $user->id )->count();
		$mp3ViewsCount 		= MP3::whereUserId( $user->id )->sum('views');
		$mp4ViewsCount 		= MP4::whereUserId( $user->id )->sum('views');
		$mp3playcount 		= MP3::whereUserId( $user->id )->sum('play');
		$mp3downloadcount 	= MP3::whereUserId( $user->id )->sum('download');
		$mp4downloadcount 	= MP4::whereUserId( $user->id )->sum('download');
		$firstname 			= explode(' ', $user->name )[0];

		return View::make('user.profile')
					->with('user', $user )
					->with('title', 'Pwofil ou' )
					->with( 'mp3s', $mp3s )
					->with( 'mp4s', $mp4s )
					->with( 'firstname', $firstname )
					->with( 'mp3count', $mp3count )
					->with( 'mp4count', $mp4count )
					->with( 'mp3playcount', $mp3playcount )
					->with( 'mp3downloadcount', $mp3downloadcount )
					->with( 'mp4downloadcount', $mp4downloadcount )
					->with('mp3ViewsCount', $mp3ViewsCount)
					->with('mp4ViewsCount', $mp4ViewsCount);
	}

	public function getUserMP3s()
	{
		$user 				= Auth::user();

		$mp3count 			= MP3::whereUserId( $user->id )->count();
		$mp4count 			= MP4::whereUserId( $user->id )->count();
		$mp3s 				= MP3::whereUserId( $user->id )->orderBy('created_at', 'desc')->paginate( 10 );
		$mp3playcount 		= MP3::whereUserId( $user->id )->sum('play');
		$mp3downloadcount 	= MP3::whereUserId( $user->id )->sum('download');
		$mp4downloadcount 	= MP4::whereUserId( $user->id )->sum('download');
		$mp3ViewsCount 		= MP3::whereUserId( $user->id )->sum('views');
		$mp4ViewsCount 		= MP4::whereUserId( $user->id )->sum('views');

		$firstname 			= explode(' ', $user->name )[0];

		return View::make('user.mp3')
					->with('title', 'Navige Tout Mizik Ou Yo' )
					->with( 'mp3s', $mp3s )
					->with( 'firstname', $firstname )
					->with( 'mp3count', $mp3count )
					->with( 'mp4count', $mp4count )
					->with( 'mp3playcount', $mp3playcount )
					->with( 'mp3downloadcount', $mp3downloadcount )
					->with( 'mp4downloadcount', $mp4downloadcount )
					->with('mp3ViewsCount', $mp3ViewsCount)
					->with('mp4ViewsCount', $mp4ViewsCount)
					->with( 'user', $user );
	}

	public function getUserMP4s()
	{
		$user 	 			= Auth::user();

		$mp3count 			= MP3::whereUserId( $user->id )->count();
		$mp4count 			= MP4::whereUserId( $user->id )->count();
		$mp4s 				= MP4::whereUserId( $user->id )->orderBy('created_at', 'desc')->paginate( 10 );
		$mp3playcount 		= MP3::whereUserId( $user->id )->sum('play');
		$mp3downloadcount 	= MP3::whereUserId( $user->id )->sum('download');
		$mp4downloadcount 	= MP4::whereUserId( $user->id )->sum('download');
		$mp3ViewsCount 		= MP3::whereUserId( $user->id )->sum('views');
		$mp4ViewsCount 		= MP4::whereUserId( $user->id )->sum('views');

		$firstname 			= explode(' ', $user->name )[0];

		return View::make('user.mp4')
			->with('title', 'Navige Tout Videyo Ou Yo')
			->with('mp4s', $mp4s)
			->with('firstname', $firstname)
			->with('mp3count', $mp3count)
			->with('mp4count', $mp4count)
			->with('mp3playcount', $mp3playcount)
			->with('mp3downloadcount', $mp3downloadcount)
			->with('mp4downloadcount', $mp4downloadcount)
			->with('mp3ViewsCount', $mp3ViewsCount)
			->with('mp4ViewsCount', $mp4ViewsCount)
			->with('user', $user);
	}

	public function getUserEdit()
	{
		$user = Auth::user();

		return View::make('user.profile-edit')
			->with( 'title', 'Modifye Pwofil Ou')
			->withUser( $user );
	}

	public function putUser()
	{
		$rules = [
			'name' 		=> 'required|min:6',
			'email' 	=> 'required|email|different:name',
			'password' 	=> 'min:6|same:password_confirm',
			'image'		=> 'image',
			'telephone'	=> 'numeric'
		];

		$messages = [
			'name.required' 	=> Config::get('site.validate.name.required'),
			'name.min'			=> Config::get('site.validate.name.min'),
			'email.required' 	=> Config::get('site.validate.email.required'),
			'email.email' 		=> Config::get('site.validate.email.email'),
			'email.different' 	=> Config::get('site.validate.email.different'),
			'password.min' 		=> Config::get('site.validate.password.min'),
			'password.same' 	=> Config::get('site.validate.password.same'),
			'image.image'		=> Config::get('site.validate.image.image'),
			'telephone.numeric'	=> Config::get('site.validate.telephone.numeric')
		];

		$validator = Validator::make( Input::all(), $rules, $messages );

		if ( $validator->fails() )
		{
			$user = Auth::user();

			return Redirect::to( Request::url() )
							->withErrors( $validator );
		}

		$name 		= Input::get('name');
		$email 		= Input::get('email');
		$password 	= Input::get('password');
		$image 		= Input::file('image');
		$telephone	= Input::get('telephone');

		if ( isset( $image ) )
		{
			$imageext = $image->getClientOriginalExtension();
			$imagename = Str::slug( $name, '-' ) . '-' . Str::random( 32 ) . '.' . $imageext;
			$imageuploadpath = Config::get('site.image_upload_path');
			$imagesuccess = $image->move( $imageuploadpath, $imagename );

			if ( $imagesuccess )
			{
				Image::make( $imageuploadpath . '/' . $imagename )
					->resize( 200, 200 )
					->save( $imageuploadpath . '/thumbs/' . $imagename );

				Image::make( $imageuploadpath . '/' . $imagename )
					->resize( 50, 50, function( $constraint )
					{
						$constraint->aspectratio();
					})
					->save( $imageuploadpath . '/thumbs/profile/' . $imagename );
			}
		}

		$user = User::find( Auth::user()->id );

		if ( !empty( $name ) )
			$user->name = $name;

		if ( !empty( $email ) )
			$user->email = $email;

		if ( !empty( $password ) )
			$user->password = Hash::make( $password );

		if ( !empty( $image ) )
			$user->image = $imagename;

		if ( !empty( $telephone ) )
			$user->telephone = $telephone;

		$user->save();

		return Redirect::to('/user')
			->with('message', 'Pwofil ou mete a jou avèk siskè!');

	}

	public function getUserPublic( $id )
	{
		$user 				= User::find( $id );

		$mp3count 			= MP3::whereUserId( $user->id )->count();
		$mp4count 			= MP4::whereUserId( $user->id )->count();
		$mp3s 				= MP3::whereUserId( $user->id )->get();
		$mp4s 				= MP4::whereUserId( $user->id )->get();
		$mp3playcount 		= MP3::whereUserId( $user->id )->sum('play');
		$mp3ViewsCount 		= MP3::whereUserId( $user->id )->sum('views');
		$mp4ViewsCount 		= MP4::whereUserId( $user->id )->sum('views');
		$mp3downloadcount 	= MP3::whereUserId( $user->id )->sum('download');
		$mp4downloadcount 	= MP4::whereUserId( $user->id )->sum('download');

		$firstname 			= ucwords( explode(' ', $user->name )[0] );

		return View::make('user.profile-public')
					->with(	'user', $user )
					->with(	'title', "Pwofil $user->name" )
					->with( 'mp3s', $mp3s )
					->with( 'mp4s', $mp4s )
					->with( 'firstname', $firstname )
					->with( 'mp3count', $mp3count )
					->with( 'mp4count', $mp4count )
					->with( 'mp3playcount', $mp3playcount )
					->with( 'mp3downloadcount', $mp3downloadcount )
					->with( 'mp4downloadcount', $mp4downloadcount )
					->with('mp3ViewsCount', $mp3ViewsCount)
					->with('mp4ViewsCount', $mp4ViewsCount);
	}
}