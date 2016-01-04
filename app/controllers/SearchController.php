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

		$mp3results->each( function( $mp3 )
		{
			$mp3->icon = 'music';
			$mp3->type = 'mp3';
		});

		$mp4results->each( function( $mp4 )
		{
			$mp4->icon = 'facetime-video';
			$mp4->type = 'mp4';
		});

		$results = $mp3results->merge( $mp4results )->shuffle();
		// dd($results);

		return View::make('search.index')
			->with( 'results', $results )
			->with( 'query', $query )
			->with( 'title', 'Rezilta pou: ' . $query );
	}

	public function searchMP3($query)
	{
		$mp3s = MP3::where('name', 'like', '%' . $query . '%')->paginate(20, ['id', 'name', 'play', 'download', 'image'] );

		$mp3s->each( function( $mp3 )
		{
			$mp3->icon = 'music';
			$mp3->type = 'mp3';
		});

		return View::make('search.mp3')
			->with( 'mp3s', $mp3s )
			->with( 'query', $query )
			->with( 'title', $query );
	}

	public function searchMP4( $query )
	{
		$mp4results = MP4::where('name', 'like', '%' . $query . '%')->paginate( 20, ['id', 'name', 'download', 'image'] );

		$mp4results->each( function( $mp4 )
		{
			$mp4->icon = 'facetime-video';
			$mp4->type = 'mp4';
		});

		return View::make('search.mp4')
			->with( 'results', $mp4results )
			->with( 'query', $query )
			->with( 'title', $query );
	}
}