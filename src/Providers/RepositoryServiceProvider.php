<?php

namespace GridPrinciples\Repositorio\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
//        $this->mergeConfigFrom(
//            __DIR__.'/../../config/repositories.php', 'repositories'
//        );
    }

    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        // Publish configuration
//        $this->publishes([
//            __DIR__.'/../../config/repositories.php' => config_path('repositories.php'),
//        ], 'config');
    }
}
