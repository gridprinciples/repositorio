<?php

namespace GridPrinciples\Repositorio\Tests\Mocks;

use GridPrinciples\Repositorio\Repository;

class GameRepository extends Repository {
    protected static $model = \GridPrinciples\Repositorio\Tests\Mocks\Game::class;

    public static function allByCountry()
    {
        return static::all()
            ->groupBy('country');
    }
}
