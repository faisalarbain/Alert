<?php namespace FaisalArbain\Alert;

use Illuminate\Support\ServiceProvider;

class AlertServiceProvider extends ServiceProvider {


	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	public function boot()
	{
		$this->package('faisalarbain/alert');
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		// Register the AlertsMessageBag class.
		$this->app['alert'] = $this->app->share(function($app){
			return new BootstrapAlert($app['session']);
		});
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array('alert');
	}

}