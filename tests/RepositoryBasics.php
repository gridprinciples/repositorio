<?php

namespace GridPrinciples\Repositorio\Tests;

use GridPrinciples\Repositorio\Tests\Cases\DatabaseTestCase;
use GridPrinciples\Repositorio\Tests\Mocks\GameRepository;

class RepositoryBasics extends DatabaseTestCase
{
    public function test_it_can_create_a_record()
    {
        $game = GameRepository::save([
            'name' => 'Super Mario Bros.',
        ]);

        $this->seeInDatabase('games', ['name' => 'Super Mario Bros.']);
        $this->assertEquals('Super Mario Bros.', $game->name);
    }

    public function test_it_can_select_a_record()
    {
        GameRepository::save([
            'name' => 'Super Mario Maker',
        ]);

        $mario = GameRepository::get(1);

        $this->assertEquals('Super Mario Maker', $mario->name);
    }

    public function test_it_can_update_multiple_records()
    {
        GameRepository::save(['name' => 'Mass Effect']);

        $games = [
            GameRepository::save(['name' => 'Final Fantasy']),
            GameRepository::save(['name' => 'Final Fantasy VI']),
            GameRepository::save(['name' => 'Final Fantasy VII']),
        ];

        GameRepository::save([
            'country' => 'jp',
        ], $games);

        $allGames = GameRepository::all();
        $gamesByCountry = $allGames->groupBy('country');

        $this->assertCount(3, array_get($gamesByCountry, 'jp'));
    }

    public function test_it_can_delete_records()
    {
        $game = GameRepository::save(['name' => 'Bonestorm']);

        GameRepository::delete($game);

        $this->notSeeInDatabase('games', ['name' => 'Bonestorm']);
    }
}
