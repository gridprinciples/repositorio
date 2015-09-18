<?php

namespace GridPrinciples\Repositorio\Tests;

use GridPrinciples\Repositorio\Tests\Cases\DatabaseTestCase;
use GridPrinciples\Repositorio\Tests\Mocks\GameRepository;

class RepositoryBasics extends DatabaseTestCase
{
    public function test_it_can_create_a_record()
    {
        GameRepository::save([
            'name' => 'Super Mario Bros.',
        ]);

        $this->seeInDatabase('games', ['name' => 'Super Mario Bros.']);
    }
}
