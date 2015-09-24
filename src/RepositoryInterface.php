<?php

namespace GridPrinciples;

interface RepositoryInterface
{
    public static function get($targets);

    public static function index($limit = 15);

    public static function save($data, $targets = false);

    public static function delete($targets);
}
