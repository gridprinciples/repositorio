<?php

namespace GridPrinciples\Repository\Tests\Mocks;

use GridPrinciples\Repository\EloquentRepository;

class GameRepository extends EloquentRepository {
    protected static $model = \GridPrinciples\Repository\Tests\Mocks\Game::class;

    public static function allByCountry()
    {
        return self::newModel()
            ->all()
            ->groupBy('country');
    }
}
