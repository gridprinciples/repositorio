<?php

namespace GridPrinciples\Repository\Tests;

use GridPrinciples\Repository\Tests\Cases\DatabaseTestCase;
use Illuminate\Support\Facades\Schema;

class DatabaseTables extends DatabaseTestCase
{
    public function test_tables_exist()
    {
        $expectedTables = [
            'games',
        ];

        foreach ($expectedTables as $table) {
            $this->assertTrue(Schema::hasTable($table));
        }
    }
}
