<?php

class MP3 extends Eloquent
{
	protected $table = 'mp3s';

	protected $fillable = array('name', 'mp3name', 'image', 'user_id', 'description', 'category_id', 'play', 'download', 'size');

	public function user()
	{
		return $this->belongsTo('User', 'user_id');
	}

	public function category()
	{
		return $this->belongsTo('Category');
	}
}