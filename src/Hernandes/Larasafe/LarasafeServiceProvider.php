<?php namespace Hernandes\Larasafe;

use Illuminate\Support\ServiceProvider;

class LarasafeServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->package('hernandes/larasafe');
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
        $this->app['command.backup'] = $this->app->share(function($app)
        {
            return new Commands\BackupCommand();
        });

        $this->commands('command.backup');
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array();
	}

}
