<?php

class MP3Sold extends Eloquent
{
	protected $table = 'sold_mp3s';

	public $timestamps = false;

	protected $fillable = ['mp3_id', 'user_id'];
}