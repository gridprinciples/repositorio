<?php

namespace GridPrinciples\Repository\Tests;

use GridPrinciples\Repository\Tests\Cases\DatabaseTestCase;
use GridPrinciples\Repository\Tests\Mocks\GameRepository;

class RepositoryBasics extends DatabaseTestCase
{
    public function setUp()
    {
        parent::setUp();
        
        $this->repository = app()->make('GameRepository');
    }

    public function test_it_can_create_a_record()
    {
        $game = $this->repository->save([
            'name' => 'Super Mario Bros.',
        ]);

        $this->seeInDatabase('games', ['name' => 'Super Mario Bros.']);
        $this->assertEquals('Super Mario Bros.', $game->name);
    }

    public function test_it_can_select_a_record()
    {
        $this->repository->save([
            'name' => 'Super Mario Maker',
        ]);

        $mario = $this->repository->get(1);

        $this->assertEquals('Super Mario Maker', $mario->name);
    }

    public function test_it_can_select_an_index()
    {
        $this->repository->save(['name' => 'Mega Man X']);
        $this->repository->save(['name' => 'Mega Man X2']);
        $this->repository->save(['name' => 'Mega Man X3']);

        $index = $this->repository->index();

        $this->assertCount(3, $index->all());
        $this->assertEquals('LengthAwarePaginator', class_basename($index));
    }

    public function test_it_can_update_multiple_records()
    {
        $this->repository->save(['name' => 'Mass Effect']);

        $games = [
            $this->repository->save(['name' => 'Final Fantasy']),
            $this->repository->save(['name' => 'Final Fantasy VI']),
            $this->repository->save(['name' => 'Final Fantasy VII']),
        ];

        $this->repository->save([
            'country' => 'jp',
        ], $games);

        $this->repository->save(['name' => 'Tony Hawk\'s Pro Skater 3', 'country' => 'us']);
        $this->repository->save(['name' => 'Tony Hawk\'s Pro Skater 4', 'country' => 'us']);

        $gamesByCountry = $this->repository->allByCountry();

        $this->assertCount(3, array_get($gamesByCountry, 'jp'));
        $this->assertCount(2, array_get($gamesByCountry, 'us'));
        $this->assertCount(1, array_get($gamesByCountry, ''));
    }

    public function test_it_can_delete_records()
    {
        $game = $this->repository->save(['name' => 'Bonestorm']);

        app()->make('GameRepository')->delete($game);

        $this->notSeeInDatabase('games', ['name' => 'Bonestorm']);
    }
}
