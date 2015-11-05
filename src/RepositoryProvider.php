<?php

namespace GridPrinciples\Repository;

use Illuminate\Support\ServiceProvider;

class RepositoryProvider extends ServiceProvider {

	public function register()
	{
        $this->mergeConfigFrom(
            __DIR__.'/../config/repositories.php', 'repositories'
        );
	}

	public function boot()
	{
		$loadRepositories = config('repositories.load');

		if(!empty($loadRepositories)) {
			foreach($loadRepositories as $repository) {
				$this->app->singleton(class_basename($repository), function ($app) use ($repository) {
				    return new $repository;
				});
			}
		}
	}

}