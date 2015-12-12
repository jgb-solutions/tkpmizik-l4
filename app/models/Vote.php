<?php

class Vote extends Eloquent
{
	protected $table = 'vote_user';

	public $timestamps = false;

	protected $fillable = array('vote', 'user_id', 'obj_id', 'obj');
}