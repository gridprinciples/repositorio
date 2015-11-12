# Repository [![Build Status](https://travis-ci.org/gridprinciples/repository.svg?branch=master)](https://travis-ci.org/gridprinciples/repository)
A basic Eloquent Repository for [Laravel 5.1](http://laravel.com).

## Installation
1. Run `composer require gridprinciples/repository` from your project directory.
1. Add the following to the `providers` array in `config/app.php`:  
    ```php
    GridPrinciples\Repository\RepositoryServiceProvider::class,
    ```

1. Make a Repositories folder somewhere in your application, such as `app/Repositories`.

## Usage

1. Make a new Repository by extending GridPrinciples\Repository:

    ```php
    <?php

    namespace App\Repositories;

    use GridPrinciples\EloquentRepository;

    class FooRepository extends EloquentRepository {
        protected static $model = \App\Foo::class;
    }

    ```

1. (Recommended) Use your repository in your controller(s):

    ```php
    <?php

    namespace App\Http\Controllers;

    use App\Repositories\FooRepository;

    public function __construct(FooRepository $repository)
    {
        $this->repository = $repository;
    }

    public function somePage($id)
    {
        $model = $this->repository->get($id);

        if(!$model) {
            // Model not found.
            return abort(404);
        }

        return view('my_view', [
            'foo' => $model,
        ]);
    }

    ```


Some basic CRUD functionality is included with the EloquentRepository:

### Creating
You can call `save` with an array of data in order to make a new model/record.

```php
$newModel = $this->repository->save([
    'title' => 'This is indicative of a title',
    'description' => 'You might have a description field, perhaps.',
]);
```

It is recommended you populate your model's `$fillable` array in order to avoid
mass-assignment problems.

### Reading
You can select one or many records by their keys (usually `id`) using `get`:

```php
$singleModel = $this->repository->get(1);
$multipleModels = $this->repository->get([2, 3, 4]);
```

If you'd like to retrieve many models and paginate them, use the `index` method:

```php
$pageOfModels = $this->repository->index(10); // 10 records per page
```

### Updating
You can update models in a very similar way as creating, also by using the
`save` method:

```php
$data = [
    'status' => 'active',
];
$id = 1;

$this->repository->save($data, $id);
```

You can also pass an array of keys as the second argument to `save` in order to 
update many records at once.

### Deleting
Deleting models can be accomplished easily using the `delete` method:

```php
$this->repository->delete($id);
```
You can also pass an array of keys to `delete` in order to delete many records 
at once.

## License
This is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).