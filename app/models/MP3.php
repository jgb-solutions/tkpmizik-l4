<?php

class MP3 extends Eloquent
{
	protected $table = 'mp3s';

	protected $fillable = [
		'name', 'mp3name', 'image', 'user_id', 'description', 'category_id', 'size'
	];

	public function user()
	{
		return $this->belongsTo('User', 'user_id');
	}

	public function category()
	{
		return $this->belongsTo('Category');
	}

	public function scopePublished($query)
	{
		$query->wherePublish(1);
	}

	public function scopeSearch($query, $term)
	{
		$query->where('name', 'like', "%$term%");
	}

	public function scopePaid($query)
	{
		$query->wherePrice('paid');
	}

	public function scopeRand($query)
	{
		$query->orderByRaw('RAND()');
	}
}