<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class TKPMServiceProvider extends ServiceProvider {

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
		View::composer('nav', 'App\Composers\ViewComposer@navigation');
		View::composer('modules.latest-musics', 'App\Composers\ViewComposer@latestMusicsModule');
		View::composer('modules.latest-videos', 'App\Composers\ViewComposer@latestVideosModule');
		View::composer('modules.latest-users', 'App\Composers\ViewComposer@latestUsersModule');
		View::composer('modules.top-musics', 'App\Composers\ViewComposer@topMusicsModule');
		View::composer('modules.top-videos', 'App\Composers\ViewComposer@topVideosModule');
		View::composer('modules.top-users', 'App\Composers\ViewComposer@topUsersModule');
		View::composer('cats.list-cats', 'App\Composers\ViewComposer@catModule');
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register(){}
}