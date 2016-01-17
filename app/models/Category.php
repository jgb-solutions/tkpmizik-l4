<?php

class Category extends Eloquent
{
	protected $table = 'categories';

	protected $fillable = array('name', 'slug');

	public $timestamps = false;

	public function mp3s()
	{
		return $this->hasMany('MP3');
	}

	public function mp4s()
	{
		return $this->hasMany('MP4');
	}

	public function getTcountAttribute()
	{
		return $this->mp3s()->remember(120)->count() + $this->mp4s()->remember(120)->count();
	}
}