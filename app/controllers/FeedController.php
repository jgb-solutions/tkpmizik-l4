<?php

use Suin\RSSWriter\Feed;
use Suin\RSSWriter\Item;
use Suin\RSSWriter\Channel;

class FeedController extends BaseController
{
	public function mp3()
	{
		return $this->getRss('mp3');
	}

	public function mp4()
	{
		return $this->getRss('mp4');
	}

	private function getRSS($type)
	{
		$key = $type . '_rss_feed_';

		if (Cache::has($key))
		{
			return Cache::get($key);
		}

		if ($type == 'mp3')
		{
			$objs =  MP3::published()
						->latest()
						->take(10)
						->get();
			$hash = 'Mizik';
		} elseif ($type == 'mp4')
		{
			$objs = MP4::latest()
						->take(10)
						->get();
			$hash = 'Videyo';
		}

		$rss = $this->buildRssData($objs, $type, $hash);

		$rss = Response::make($rss)
				->header('Content-type', 'application/rss+xml');

		Cache::put($key, $rss, 30);

		return $rss;

	}

	/**
	* Return a string with the feed data
	*
	* @return string
	*/
	protected function buildRssData($objs, $type, $hash)
	{
		$now 		= \Carbon\Carbon::now();
		$feed 		= new Feed();
		$channel 	= new Channel();

		$channel->title(Config::get('site.name'))
				->description(Config::get('site.description'))
				->url($_ENV['SITE_URL'])
				->language('ht')
				->copyright('&copy; 2012 - ' . date('Y') . ' ' . Config::get('site.name') . ', Tout Dwa Rezève.')
				->lastBuildDate($now->timestamp)
				->appendTo($feed);

		foreach ($objs as $obj)
		{
			$item = new Item();

			$title = "#Nouvo$hash $obj->name #{$obj->category->slug} via @TKPMizik | @TiKwenPam";

			$item->title($title)
				->description($obj->description)
				->url(url("/$type/{$obj->id}"))
				->pubDate($obj->created_at->timestamp)
				->guid(url("/$type/{$obj->id}"), true)
				->appendTo($channel);
		}

		$feed = (string) $feed;
		// Replace a couple items to make the feed more compliant
		$feed = str_replace(
			'<rss version="2.0">',
			'<rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom">',
			$feed
		);

		$feed = str_replace(
			'<channel>',
			'<channel>
			<atom:link href="'. url($_ENV['SITE_URL'] . "/$type/feed") . '" rel="self" type="application/rss+xml" />',
			$feed
		);

		return $feed;
	}
}