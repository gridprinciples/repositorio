<?php

namespace GridPrinciples\Repository\Tests;

use GridPrinciples\Repository\Tests\Cases\DatabaseTestCase;
use GridPrinciples\Repository\Tests\Mocks\GameRepository;

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

    public function test_it_can_select_an_index()
    {
        GameRepository::save(['name' => 'Mega Man X']);
        GameRepository::save(['name' => 'Mega Man X2']);
        GameRepository::save(['name' => 'Mega Man X3']);

        $index = GameRepository::index();

        $this->assertCount(3, $index->all());
        $this->assertEquals('LengthAwarePaginator', class_basename($index));
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

        GameRepository::save(['name' => 'Tony Hawk\'s Pro Skater 3', 'country' => 'us']);
        GameRepository::save(['name' => 'Tony Hawk\'s Pro Skater 4', 'country' => 'us']);

        $gamesByCountry = GameRepository::allByCountry();

        $this->assertCount(3, array_get($gamesByCountry, 'jp'));
        $this->assertCount(2, array_get($gamesByCountry, 'us'));
        $this->assertCount(1, array_get($gamesByCountry, ''));
    }

    public function test_it_can_delete_records()
    {
        $game = GameRepository::save(['name' => 'Bonestorm']);

        GameRepository::delete($game);

        $this->notSeeInDatabase('games', ['name' => 'Bonestorm']);
    }
}
