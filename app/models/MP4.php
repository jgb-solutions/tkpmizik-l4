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

	public function scopeRelated($query, $obj, $nb_rows = 6)
	{
		$query->whereCategoryId($obj->category_id)
				->where('id', '!=', $obj->id)
				->orderByRaw('RAND()') // get random rows from the DB
				->take($nb_rows);
	}
}