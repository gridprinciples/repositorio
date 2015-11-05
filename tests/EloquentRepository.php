<?php

namespace GridPrinciples\Repository\Tests;

use GridPrinciples\Repository\Tests\Cases\DatabaseTestCase;
use GridPrinciples\Repository\Tests\Mocks\GameRepository;

class RepositoryBasics extends DatabaseTestCase
{
    public function test_it_can_create_a_record()
    {
        $game = app()->make('GameRepository')->save([
            'name' => 'Super Mario Bros.',
        ]);

        $this->seeInDatabase('games', ['name' => 'Super Mario Bros.']);
        $this->assertEquals('Super Mario Bros.', $game->name);
    }

    public function test_it_can_select_a_record()
    {
        app()->make('GameRepository')->save([
            'name' => 'Super Mario Maker',
        ]);

        $mario = app()->make('GameRepository')->get(1);

        $this->assertEquals('Super Mario Maker', $mario->name);
    }

    public function test_it_can_select_an_index()
    {
        app()->make('GameRepository')->save(['name' => 'Mega Man X']);
        app()->make('GameRepository')->save(['name' => 'Mega Man X2']);
        app()->make('GameRepository')->save(['name' => 'Mega Man X3']);

        $index = app()->make('GameRepository')->index();

        $this->assertCount(3, $index->all());
        $this->assertEquals('LengthAwarePaginator', class_basename($index));
    }

    public function test_it_can_update_multiple_records()
    {
        app()->make('GameRepository')->save(['name' => 'Mass Effect']);

        $games = [
            app()->make('GameRepository')->save(['name' => 'Final Fantasy']),
            app()->make('GameRepository')->save(['name' => 'Final Fantasy VI']),
            app()->make('GameRepository')->save(['name' => 'Final Fantasy VII']),
        ];

        app()->make('GameRepository')->save([
            'country' => 'jp',
        ], $games);

        app()->make('GameRepository')->save(['name' => 'Tony Hawk\'s Pro Skater 3', 'country' => 'us']);
        app()->make('GameRepository')->save(['name' => 'Tony Hawk\'s Pro Skater 4', 'country' => 'us']);

        $gamesByCountry = app()->make('GameRepository')->allByCountry();

        $this->assertCount(3, array_get($gamesByCountry, 'jp'));
        $this->assertCount(2, array_get($gamesByCountry, 'us'));
        $this->assertCount(1, array_get($gamesByCountry, ''));
    }

    public function test_it_can_delete_records()
    {
        $game = app()->make('GameRepository')->save(['name' => 'Bonestorm']);

        app()->make('GameRepository')->delete($game);

        $this->notSeeInDatabase('games', ['name' => 'Bonestorm']);
    }
}
