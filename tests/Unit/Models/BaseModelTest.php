<?php

declare(strict_types=1);

namespace Modules\Activity\Tests\Unit\Models;

use Modules\Activity\Models\BaseModel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Database\Eloquent\Model;
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

<<<<<<< HEAD
test('base model extends eloquent model', function (): void {
    $baseModel = new TestActivityBaseModel;
    expect($baseModel)->toBeInstanceOf(Model::class);
=======
beforeEach(function () {
    $this->baseModel = new class extends BaseModel
    {
        protected $table = 'test_activity_table';
    };
>>>>>>> 9baa519 (.)
});

test('base model has correct table name', function (): void {
    $baseModel = new TestActivityBaseModel;
    expect($baseModel->getTable())->toBe('test_activity_table');
});

test('base model can be instantiated', function (): void {
    $baseModel = new TestActivityBaseModel;
    expect($baseModel)->toBeInstanceOf(BaseModel::class);
});

test('base model has proper inheritance chain', function (): void {
    $baseModel = new TestActivityBaseModel;
    expect($baseModel)->toBeInstanceOf(BaseModel::class);
    expect($baseModel)->toBeInstanceOf(Model::class);
});

test('base model has timestamps enabled', function (): void {
    $baseModel = new TestActivityBaseModel;
    expect($baseModel->timestamps)->toBeTrue();
});
