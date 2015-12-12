<?php

class MP4 extends Eloquent
{
	protected $table = 'mp4s';

	protected $fillable = array('name', 'url', 'image', 'user_id', 'description', 'category_id');

	public function user()
	{
		return $this->belongsTo('User', 'user_id');
	}

	public function category()
	{
		return $this->belongsTo('Category');
	}
}