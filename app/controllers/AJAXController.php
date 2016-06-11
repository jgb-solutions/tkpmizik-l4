<?php

class AJAXController extends BaseController
{
	public function postIndex()
	{
		$query 	= Input::get('q');
		$fn 	= Input::get('fn');
		$id 	= Input::get('id');
		$obj 	= Input::get('obj');
		$ud		= Input::get('ud');
		$action = Input::get('action');

		// Vote system
		if ($fn == 'vote')
		{
			$fn = $fn . '_' . $ud;
			return $this->$fn($id, $obj, $action);
		}

		// default AJAX: Search...
		return $this->$fn($id, $obj, $query);
	}

	private function vpd_count($id, $o, $action = null)
	{
		$obj = $o::find($id);
		$obj->views += 1;
		$obj->save();

		$data = [
			'views' 	=> $obj->views,
			'download' 	=> $obj->download,
			'play'		=> $o == 'MP3' ? $obj->play : ''
		];

		return $data;
	}

	private function search($id, $obj, $query)
	{
		if ( ! empty( $obj ) )
		{
			$fn = 'search' . $obj;
			return $this->$fn($query);
		}

		$mp3results = MP3::published()
						->search($query)
						->orderBy('download', 'desc')
						->orderBy('play', 'desc')
						->rand() // get random rows from the DB
						->take( 10 )
						->get(['id', 'name', 'views', 'download', 'price']);

		$mp3results->each( function( $mp3 )
		{
			$mp3->type = 'mp3';
			$mp3->icon = 'music';
		});

		$mp4results = MP4::search($query)
						->orderBy('download', 'desc')
						->rand() // get random rows from the DB
						->take(10)
						->get(['id', 'views', 'name', 'download']);

		$mp4results->each( function( $mp4 )
		{
			$mp4->type = 'mp4';
			$mp4->icon = 'video-camera';
		});

		$results = $mp3results->merge( $mp4results );
		$shuffle_results = $results->shuffle();

		return $shuffle_results;
	}

	private function searchMP3( $query )
	{
		$mp3results = MP3::published()
						->search($query)
						->orderBy('play', 'desc')
						->orderBy('download', 'desc')
						->take( 20 )
						->get(['id', 'name', 'play', 'download', 'image', 'price']);

		$mp3results->each( function( $mp3 )
		{
			$mp3->icon = 'music';
			$mp3->type = 'mp3';
		});

		return $mp3results;
	}

	private function searchMP4($query)
	{
		$mp4results = MP4::search($query)
						->orderBy('play', 'desc')
						->orderBy('download', 'desc')
						->take(20)
						->get(['id', 'views', 'name', 'download']);

		$mp4results->each( function($mp4)
		{
			$mp4->icon = 'video-camera';
			$mp4->type = 'mp4';
		});

		return $mp4results;
	}

	// Vote Up and Down
	private function vote_up( $id, $obj )
	{
		if ( Auth::check() )
		{
			$user_id = Auth::user()->id;

			$vote = Vote::where('user_id', $user_id)
						->where('obj_id', $id)
						->where('obj', $obj)
						->first();

			if ( $vote )
			{
				if ( $vote->vote == 1 )
				{
					return;
				}

				$vote->vote = 1;
				$vote->save();
			} else
			{
				Vote::create([
					'vote' 		=> 1,
					'obj_id' 	=> $id,
					'user_id' 	=> $user_id,
					'obj'		=> $obj
				]);
			}

			$obj = $obj::find( $id );
			$obj->vote_up += 1;
			$obj->save();

			$arr = [];
			$arr['vote_up'] = $obj->vote_up;
			$arr['vote_down'] = $obj->vote_down;

			return $arr;
		}
	}

	private function vote_down( $id, $obj )
	{
		if ( Auth::check() )
		{
			$user_id = Auth::user()->id;

			$vote = Vote::where('user_id', $user_id)
						->where('obj_id', $id)
						->where('obj', $obj)
						->first();

			if ( $vote )
			{
				if ( $vote->vote == -1 )
				{
					return;
				}

				$vote->vote = -1;
				$vote->save();
			} else
			{
				Vote::create([
					'vote' 		=> -1,
					'obj_id' 	=> $id,
					'user_id' 	=> $user_id,
					'obj'		=> $obj
				]);
			}

			$obj = $obj::find($id);
			$obj->vote_down -= 1;
			$obj->save();

			$arr = [];
			$arr['vote_up'] = $obj->vote_up;
			$arr['vote_down'] = $obj->vote_down;

			return $arr;
		}
	}

	private function vote_null( $id, $obj, $action )
	{
		if ( Auth::check() )
		{
			$user_id = Auth::user()->id;

			$vote = Vote::where('user_id', $user_id)
						->where('obj_id', $id)
						->where('obj', $obj)
						->first()
						->delete();

			$obj = $obj::find( $id );

			if ( $action == 'up' )
			{
				$obj->vote_up -= 1;
			} elseif ( $action == 'down')
			{
				$obj->vote_down += 1;
			}

			$obj->save();

			$arr = [];
			$arr['vote_up'] = $obj->vote_up;
			$arr['vote_down'] = $obj->vote_down;

			return $arr;

		}
	}

	private function tweetMail($id, $obj, $action = null)
	{
		if ($mp3->price == 'paid')
		{
			// Send an email to the new user letting them know their music has been uploaded
			$data = [
				'mp3' 		=> $mp3,
				'subject' 	=> 'Felisitasyon!!! Ou fèk mete yon nouvo mizik pou vann.'
			];

			TKPM::sendMail('emails.user.buy', $data, 'mp3');
		}

		elseif (Auth::guest() && Input::has('email'))
		{
			$mp3->userEmail = Input::get('email');

			$data = [
				'mp3' 		=> $mp3,
				'subject' 	=> 'Felisitasyon!!! Ou fèk mete yon nouvo mizik'
			];

			TKPM::sendMail('emails.user.guest3', $data, 'guest3');
		}

		{
			// Send an email to the new user letting them know their music has been uploaded
			$data = [
				'mp3' 		=> $mp3,
				'subject' 	=> 'Felisitasyon!!! Ou fèk mete yon nouvo mizik'
			];

			TKPM::sendMail('emails.user.mp3', $data, 'mp3');
		}

		if (! App::isLocal())
		{
			TKPM::tweet($mp3, 'mp3');
		}
	}
}