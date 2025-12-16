<?php

declare(strict_types=1);

namespace Modules\Activity\Tests\Unit\Models;

<<<<<<< HEAD
use Illuminate\Database\Eloquent\Model;
use Modules\Activity\Models\BaseModel;
<<<<<<< HEAD
use Modules\Activity\Tests\TestCase;
=======
=======
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Activity\Models\BaseModel;
=======
use Modules\Activity\Models\BaseModel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Database\Eloquent\Model;
>>>>>>> a12f125f4a (.)
=======
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Activity\Models\BaseModel;
>>>>>>> b93ef594b4 (.)
=======
use Modules\Activity\Models\BaseModel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Database\Eloquent\Model;
>>>>>>> origin/develop
>>>>>>> b1cd7fc (.)
use Tests\TestCase;
>>>>>>> 0b410a6 (.)

uses(TestCase::class);

/**
 * Helper that returns an anonymous BaseModel configured for assertions.
 */
function makeTestActivityModel(): BaseModel
{
    return new class extends BaseModel
    {
        protected $table = 'test_activity_table';
    };
}

test('base model extends eloquent model', function (): void {
    $model = makeTestActivityModel();

    expect($model)->toBeInstanceOf(Model::class);
});

test('base model has correct table name', function (): void {
    $model = makeTestActivityModel();

    expect($model->getTable())->toBe('test_activity_table');
});

test('base model can be instantiated', function (): void {
    $model = makeTestActivityModel();

    expect($model)->toBeInstanceOf(BaseModel::class);
});

test('base model has proper inheritance chain', function (): void {
    $model = makeTestActivityModel();

    expect($model)->toBeInstanceOf(BaseModel::class);
    expect($model)->toBeInstanceOf(Model::class);
});

test('base model has timestamps enabled', function (): void {
    $model = makeTestActivityModel();

    expect($model->usesTimestamps())->toBeTrue();
});
