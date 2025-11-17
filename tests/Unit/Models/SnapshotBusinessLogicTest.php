<?php

declare(strict_types=1);

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Activity\Models\BaseSnapshot;
use Modules\Activity\Models\Snapshot;

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
            'updated_at',
        ];

        expect($snapshot->getFillable())->toEqual($expectedFillable);
    });

    test('snapshot has factory trait for testing', function (): void {
        $traits = class_uses(Snapshot::class);

        expect($traits)->toHaveKey(HasFactory::class);
    });

});
