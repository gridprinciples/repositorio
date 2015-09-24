<?php

namespace GridPrinciples\Tests\Mocks;

use GridPrinciples\EloquentRepository;

class GameRepository extends EloquentRepository {
    protected static $model = \GridPrinciples\Tests\Mocks\Game::class;

    public static function allByCountry()
    {
        return self::newModel()
            ->all()
            ->groupBy('country');
    }
}
