# Repository
A basic Eloquent Repository for [Laravel 5.1](http://laravel.com). [![Build Status](https://travis-ci.org/gridprinciples/repository.svg?branch=master)](https://travis-ci.org/gridprinciples/repository)

## Installation
1. Run `composer require gridprinciples/repository` from your project directory.
1. Add the following to the `providers` array in `config/app.php`:  
    ```php
    GridPrinciples\Friendly\Providers\FriendlyServiceProvider::class,
    ```

1. Make a Repositories folder somewhere in your application, such as `app/Repositories`.

## Usage


1. Make a new Repository by extending GridPrinciples\Repository:

    ```php
    <?php

    namespace App\Repositories;

    use GridPrinciples\Repository;

    class FooRepository extends Repository {
        protected static $model = \App\Foo::class;
    }

    ```
