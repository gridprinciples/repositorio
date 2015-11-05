<?php

namespace GridPrinciples\Repository\Tests\Cases;

use GridPrinciples\Repository\RepositoryProvider;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    /**
     * Boots the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        $app = require __DIR__ . '/../../vendor/laravel/laravel/bootstrap/app.php';

        $app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

        $app['config']->set('repositories.load', [
            \GridPrinciples\Repository\Tests\Mocks\GameRepository::class,
        ]);

        $app->register(RepositoryProvider::class);

        return $app;
    }
}
