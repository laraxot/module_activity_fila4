<?php

declare(strict_types=1);

namespace Modules\Activity\Tests\Unit\Models;

<<<<<<< HEAD
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Activity\Models\BaseModel;
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

/**
 * @internal
 *
 * @coversNothing
 */
class TestActivityBaseModel extends BaseModel
{
    /** @var string */
    protected $table = 'test_activity_table';
}

uses(TestCase::class, RefreshDatabase::class);

test('base model extends eloquent model', function (): void {
    $baseModel = new TestActivityBaseModel();
    expect($baseModel)->toBeInstanceOf(Model::class);
});

test('base model has correct table name', function (): void {
    $baseModel = new TestActivityBaseModel();
    expect($baseModel->getTable())->toBe('test_activity_table');
});

test('base model can be instantiated', function (): void {
    $baseModel = new TestActivityBaseModel();
    expect($baseModel)->toBeInstanceOf(BaseModel::class);
});

test('base model has proper inheritance chain', function (): void {
    $baseModel = new TestActivityBaseModel();
    expect($baseModel)->toBeInstanceOf(BaseModel::class);
    expect($baseModel)->toBeInstanceOf(Model::class);
});

test('base model has timestamps enabled', function (): void {
    $baseModel = new TestActivityBaseModel();
    expect($baseModel->timestamps)->toBeTrue();
});
