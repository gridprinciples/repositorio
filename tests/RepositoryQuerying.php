<?php

namespace GridPrinciples\Tests;

use GridPrinciples\Tests\Cases\DatabaseTestCase;
use GridPrinciples\Tests\Mocks\GameRepository;

class RepositoryQuerying extends DatabaseTestCase
{
    public function test_it_can_run_queries()
    {
        GameRepository::save([
            'name' => 'Dark Souls',
        ]);

        $result = GameRepository::where('name', 'Dark Souls')
            ->first();

        $this->assertEquals('Dark Souls', $result->name);
    }
}
