<?php

class SearchController extends BaseController
{
	public function getIndex()
	{
		$query = Input::get('q');

		$type = Input::get('type');

		if ( isset($type) && ! empty($type) )
		{
			$fn = 'search' . $type;
			return $this->$fn( $query );
		}

		$mp3results = MP3::where('name', 'like', '%' . $query . '%')
						  ->take( 20 )->get(['id', 'name', 'play', 'download', 'image']);
		$mp3s = [];

		$mp4results = MP4::where('name', 'like', '%' . $query . '%')->take( 20 )->get(['id', 'name', 'download', 'image']);
		$mp4s = [];

		$mp3results->each( function($mp3)
		{
			$mp3->icon = 'music';
			$mp3->type = 'mp3';
		});

		$mp4results->each( function($mp4)
		{
			$mp4->icon = 'facetime-video';
			$mp4->type = 'mp4';
		});

		$results = $mp3results->merge($mp4results)->shuffle();
		// dd($results);

		$data = [
			'results' => $results,
			'query'		=> $query,
			'title'		=> 'Rezilta pou: ' . $query
		];

		return View::make('search.index')->with($data);
	}

	public function searchMP3($query)
	{
		$mp3s = MP3::where('name', 'like', '%' . $query . '%')->paginate(20, ['id', 'name', 'play', 'download', 'image'] );

		$mp3s->each( function($mp3)
		{
			$mp3->icon = 'music';
			$mp3->type = 'mp3';
		});

		$data = [
			'mp3s' => $mp3s,
			'query' => $query,
			'title' => $query
		];

		return View::make('search.mp3')->with($data);
	}

	public function searchMP4($query)
	{
		$mp4s = MP4::where('name', 'like', '%' . $query . '%')->paginate( 20, ['id', 'name', 'download', 'image'] );

		$mp4s->each( function($mp4)
		{
			$mp4->icon = 'facetime-video';
			$mp4->type = 'mp4';
		});

		$data = [
			'mp4s' => $mp4s,
			'query' => $query,
			'title' => $query
		];

		return View::make('search.mp4')->with($data);
	}
}