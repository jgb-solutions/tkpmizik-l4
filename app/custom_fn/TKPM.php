<?php

class TKPM
{
	public static function vote( $obj, $obj_id, $vote_up, $vote_down )
	{
		$btn1 = 'default';
		$disabled1 = '';
		$btn2 = 'default';
		$disabled2 = '';

		if ( Auth::check() )
		{
			$user_id = Auth::user()->id;

			$vote = Vote::where('user_id', $user_id)
						->where('obj_id', $obj_id)
						->where('obj', $obj)
						->first();
			if ( $vote )
			{
				if ( $vote->vote == 1 )
				{
					$btn1 = 'success';
					$disabled2 = 'disabled="disabled"';
				} elseif( $vote->vote == -1 )
				{
					$btn2 = 'danger';
					$disabled1 = 'disabled="disabled"';
				}
			}
		} ?>

		<div class="btn-group btn-group-lg" id="vote-btn">
			<button
				class="btn btn-<?= $btn1 ?>"
				id="voteUp" <?= $disabled1 ?> >
				<i class="fa fa-thumbs-o-up fa-lg"></i>
				<small>
					<span class="vote-num" id="vote-up-num">
						<?= $vote_up != 0 ? $vote_up : '' ?>
					</span>
				</small>
			</button>
			<button
				class="btn btn-<?= $btn2 ?>"
				id="voteDown" <?= $disabled2 ?> >
				<i class="fa fa-thumbs-o-down fa-lg"></i>
				<small>
					<span class="vote-num" id="vote-down-num">
						<?= $vote_down != 0 ? $vote_down : '' ?>
					</span>
				</small>
			</button>
		</div>

	<?php
	}


	public static function image($in, $width = null, $height = null, $out)
	{
		Image::make( Config::get('site.image_upload_path') . '/' . $in )
			->resize( $width, $height, function($constraint)
			{
				$constraint->aspectratio();
			})
			->save( Config::get('site.image_upload_path') . "/$out/" . $in );
	}

	public static function size($size, $round = 2)
	{
	    $sizes = [' B', ' KB', ' MB'];

	    $total = count( $sizes ) - 1 ;

	    for ($i = 0; $size > 1024 && $i < $total; $i++)
	    {
	        $size /= 1024;
	    }

	    return round($size, $round) . $sizes[$i];
	}

	public static function tag($mp3, $image_name, $type)
	{
		$mp3_handler = new \getID3;
        $mp3_handler->setOption(['encoding'=> 'UTF-8']);

        $mp3_writter 					= new \getid3_writetags;

        $mp3_writter->filename          = Config::get('site.mp3_upload_path') . '/' . $mp3->mp3name;
        $mp3_writter->tagformats        = array('id3v1', 'id3v2.3');
        $mp3_writter->overwrite_tags    = true;
        $mp3_writter->tag_encoding      = 'UTF-8';
        $mp3_writter->remove_other_tags = true;

        $mp3_data['title'][]   = $mp3->name;
        $mp3_data['artist'][]  = Config::get('site.name') . ' ' . Config::get('site.separator') . ' ' . Config::get('site.url'); //$mp3_artist;
        $mp3_data['album'][]   = Config::get('site.name') . ' ' . Config::get('site.separator') . ' ' . Config::get('site.url');
        // $mp3_data['year'][]    = $mp3_year;
        // $mp3_data['genre'][]   = $mp3_genre;
        $mp3_data['comment'][] = Config::get('site.name') . ' ' . Config::get('site.separator') . Config::get('site.url');

        if ($mp3->price == 'paid')
        {
	        $mp3_data['attached_picture'][0]['data'] 			= file_get_contents(Config::get('site.image_upload_path') . '/thumbs/' . $image_name);
	        $mp3_data['attached_picture'][0]['picturetypeid'] 	= $type;
        	$mp3_data['attached_picture'][0]['mime'] 			= $type;
        } else
        {
	        $mp3_data['attached_picture'][0]['data']		 	= file_get_contents(Config::get('site.logo'));
	        $mp3_data['attached_picture'][0]['picturetypeid'] 	= "image/jpg";
	        $mp3_data['attached_picture'][0]['mime'] 			= "image/jpg";
        }

        $mp3_data['attached_picture'][0]['description'] = Config::get('site.name') . ' ' . Config::get('site.separator') . ' ' .  Config::get('site.description');

        $mp3_writter->tag_data = $mp3_data;
        return $mp3_writter->WriteTags();
	}

	public static function download($mp3)
	{
		$mp3->download += 1;
		$mp3->save();

		if ($mp3)
		{
			$mp3name = Config::get('site.mp3_upload_path') . '/' . $mp3->mp3name;
			header('Content-Description: File Transfer');
		    header('Content-Type: application/octet-stream');
		    header('Content-Disposition: attachment; filename=' . $mp3->name . '.mp3' );
		    header('Expires: 0');
		    header('Cache-Control: must-revalidate');
		    header('Pragma: public');
		    header('Content-Length: ' . filesize($mp3name) );
		    readfile($mp3name) ;
		    exit;

		} else
		{
			return 'Nou regrèt men nou pa jwenn mizik ou ap eseye telechaje a.';
		}
	}

	public static function stream($mp3)
	{
		$mp3->play += 1;
		$mp3->save();

		$mp3name = Config::get('site.mp3_upload_path') . '/' . $mp3->mp3name;

		header("Content-Type: audio/mpeg");
	    header("Content-Length: " . filesize($mp3name) );
	    header('Content-Disposition: filename=' . $mp3->name . '.mp3' );
	    header('X-Pad: avoid browser bug');
	    header('Cache-Control: no-cache');
	    readfile( $mp3name );
	}

	public static function sendMail($view, 	$data, $type)
	{
		if ($type == 'user')
		{
			Mail::queue($view, $data, function($m) use ($data)
			{
				extract($data);

				$m->to($user->email, $user->name)
					->subject($data['subject'])
					->replyTo(Config::get('site.email'));
			});
		}
	}

	public static function seo($object, $type, $author)
	{
		if ($type === 'user')
		{
			$image = URL::to("/uploads/images/{$object->image}");

			if ($object->username)
			{
				$url = URL::to("/@{$object->username}");
			} else
			{
				$url = URL::to("/u/$object->id");
			}
		}

		if ($type === 'mp3' || $type === 'mp4')
		{
			$url = URL::to("/$type/$object->id");
			if ( $type === 'mp3')
			{
				$image = TKPM::asset($object->image, 'images');
			} else {
				$image = TKPM::asset($object->image);
			}
		}

		if ($type === 'cat')
		{
			$url = URL::to("/$type/$object->slug");
			$image = '';
		}


	?>

	<link rel="canonical" href="<?= $url ?>" />
	<meta name="description" content="<?= $object->description ?>"/>

	<!-- Open Graph -->
	<meta property="og:title" content="<?= $author ?> <?= $object->name ?>" />
	<meta property="og:description" content="<?= $object->description ?>" />
	<meta property="og:url" content="<?= $url ?>" />
	<meta property="og:image" content="<?= $image ?>" />
	<!-- / Open Graph -->


	<?php }

	public static function firstName($name)
	{
		return explode(' ', $name)[0];
	}

	public static function tweet($obj, $type)
	{
		if ( $type === 'mp3' )
		{
			$status = '#NouvoMizik ';
		} elseif ( $type === 'mp4' )
		{
			$status = '#NouvoVideyo ';
		}

		$status .= "$obj->name " . URL::to("/$type/{$obj->id}") . " via @TKPMizik | @TiKwenPam #" . $obj->category->slug;

		//Auto-Post Tweet
        Twitter::postTweet([
        	'status' => $status,
        	'format' => 'json'
        ]);
	}

	public static function asset($asset, $size = 'null')
	{
		$imgSize = [
			'thumbs' 	=> 'uploads/images/thumbs/',
			'images' 	=> 'uploads/images/',
			'show'  	=> 'uploads/images/show/',
			'tiny' 		=> 'uploads/images/thumbs/tiny/',
			'profile' 	=> 'uploads/images/thumbs/profile/',
			'null'		=> ''
		];

		$relativeUrl = $imgSize[$size] . $asset;

		if (App::isLocal())
		{
			return asset($relativeUrl);
		}

		$cdnUrl = 'http://tkpmizik.jgbcdn.ml/';

		return url($cdnUrl . $relativeUrl);
	}

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

}