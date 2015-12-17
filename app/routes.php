<?php

Route::get('/', 'PageController@getIndex');
Route::get('/p/{slug}', 'PageController@getPage');
Route::get('/search', 'SearchController@getIndex');

Route::get('login', 'UserController@getLogin');
Route::post('login', 'UserController@postLogin');
Route::get('/logout', 'UserController@getLogout');
Route::get('/register', 'UserController@getRegister');
Route::post('/register', 'UserController@postRegister');

Route::group(array(
	'prefix' => 'user',
	'before' => 'auth'),
	function()
	{
		Route::get('/', 'UserController@getuser');
		Route::get('/mp3', 'UserController@getUserMP3s');
		Route::get('/mp4', 'UserController@getUserMP4s');
		Route::get('/edit', 'UserController@getUserEdit');
		Route::put('/edit', 'UserController@putUser');
		Route::get('delete/{id}', 'UserController@deleteUser');
	}
);

Route::group(['prefix' => 'cat'], function()
{
	Route::get('{slug}', 'CatController@getShow');
	Route::get('{slug}/mp3', 'CatController@catMP3');
	Route::get('{slug}/mp4', 'CatController@catMP4');
});

Route::get('/mp3/get/{id}', 'MP3Controller@getMP3')->where('id', '[0-9]+');

Route::get('/mp3/delete/{id}', array(
	'before' => 'auth',
	'uses' => 'MP3Controller@destroy'
));

Route::get('/mp3/up', 'MP3Controller@getMP3Up');
Route::get('/mp3/play/{id}', 'MP3Controller@getPlayMP3');
Route::resource('mp3', 'MP3Controller');

Route::get('/mp4/get/{id}', 'MP4Controller@getMP4')->where('id', '[0-9]+');

Route::get('/mp4/delete/{id}', array(
	'before' => 'auth',
	'uses' => 'MP4Controller@destroy'
));

Route::get('/mp4/up', 'MP4Controller@getCreate');
Route::get('/mp4/play/{id}', 'MP4Controller@getPlayMP4');
Route::resource('mp4', 'MP4Controller');


Route::controller('cat', 'CatController');

Route::any('ajax', 'AJAXController@postIndex');

Route::get('/u/{id}', 'UserController@getUserPublic');

Route::get('/tweet', function()
{
    return Twitter::postTweet(array('status' => Input::get('message'), 'format' => 'json'));
    // return Twitter::getUserTimeline(array('screen_name' => 'tikwenpam', 'count' => 1, 'format' => 'json'));
});

// Route::get('/vote', function()
// {
// 	return Vote::all();
// });



// Route::get('fbposts', function()
// {
// 	return View::make('fbposts');
// });

// Route::get('events', function()
// {
// 	Event::fire('sendMail', array('email' => 'jgbneatdesign@gmail.com') );
// });

// Event::listen('sendMail', function( $email )
// {
// 	$data['name'] 			= 'Ti Kwen Pam Mizik';
// 	$data['email'] 			= $email;
// 	$data['mailMessage'] 	= 'Message send from TKPMizik';

// 	Mail::queue('mail', $data, function( $message ) use ($data)
// 	{
// 		$message->to( $data['email'], $data['name'] )
// 				->subject('Ou gen yon nouvo imel Ti Kwen Pam Mizik.')
// 				->replyTo( $data['email'] );
// 	});
// });

Route::group(['prefix' => 'admin', 'before' => 'auth.admin'], function()
{
	Route::get('cat', 'CatController@getCreate');
	Route::get('cat/delete/{id}', 'CatController@getDelete');
	Route::get('cat/edit/{id}', 'CatController@getEdit');
	Route::put('cat/edit', 'CatController@putEdit');

	Route::get('user/edit/{id}', 'UserController@getUserEdit');
	Route::put('user/edit/{id}', 'UserController@putUser');
	Route::get('user/delete/{id}', 'UserController@deleteUser');

	Route::controller('/', 'AdminController');
});