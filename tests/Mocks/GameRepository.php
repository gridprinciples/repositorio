<?php

namespace GridPrinciples\Tests\Mocks;

use GridPrinciples\Repository;

class GameRepository extends Repository {
    protected static $model = \GridPrinciples\Tests\Mocks\Game::class;

    public static function allByCountry()
    {
        return static::all()
            ->groupBy('country');
    }
}
