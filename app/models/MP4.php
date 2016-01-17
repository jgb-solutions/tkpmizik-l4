<?php

class MP4 extends Eloquent
{
	protected $table = 'mp4s';

	protected $fillable = [
		'name', 'youtube_id', 'image', 'user_id', 'description', 'category_id'
	];

	public function user()
	{
		return $this->belongsTo('User', 'user_id');
	}

	public function category()
	{
		return $this->belongsTo('Category');
	}

	public function scopeSearch($query, $term)
	{
		$query->where('name', 'like', "%$term%");
	}

	public function scopeRand($query)
	{
		$query->orderByRaw('RAND()');
	}
}