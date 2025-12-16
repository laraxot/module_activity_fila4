<?php

declare(strict_types=1);

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Activity\Models\BaseSnapshot;
use Modules\Activity\Models\Snapshot;
use Spatie\EventSourcing\Snapshots\EloquentSnapshot;

<<<<<<< HEAD
use function Safe\class_uses;

<<<<<<< HEAD
use function Safe\class_uses;

describe('Snapshot Business Logic', function (): void {
    test('snapshot has correct connection configured', function (): void {
=======
describe('Snapshot Business Logic', function () {
    test('snapshot has correct connection configured', function () {
>>>>>>> 9baa519 (.)
        $snapshot = new Snapshot;

        expect($snapshot->getConnectionName())->toBe('activity');
    });

<<<<<<< HEAD
    test('snapshot has expected fillable fields for event sourcing', function (): void {
=======
    test('snapshot has expected fillable fields for event sourcing', function () {
>>>>>>> 9baa519 (.)
        $snapshot = new Snapshot;
        $expectedFillable = [
            'id',
            'aggregate_uuid',
            'aggregate_version',
            'state',
            'created_at',
<<<<<<< HEAD
            'updated_at',
=======
            'updated_at'
>>>>>>> 0a00ff2 (.)
        ];

        expect($snapshot->getFillable())->toEqual($expectedFillable);
    });

<<<<<<< HEAD
    test('snapshot extends eloquent snapshot from spatie', function () {
        expect(is_subclass_of(Snapshot::class, EloquentSnapshot::class))->toBeTrue();
    });

    test('snapshot has factory trait for testing', function () {
=======
    test('snapshot has factory trait for testing', function (): void {
>>>>>>> 1e9f71a (.)
        $traits = class_uses(Snapshot::class);

        expect($traits)->toHaveKey(HasFactory::class);
    });

});
