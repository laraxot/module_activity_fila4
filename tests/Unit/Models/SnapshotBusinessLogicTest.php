<?php

declare(strict_types=1);

use function Safe\class_uses;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Activity\Models\Snapshot;

describe('Snapshot Business Logic', function (): void {
    test('snapshot has correct connection configured', function (): void {
        $snapshot = new Snapshot;

        expect($snapshot->getConnectionName())->toBe('activity');
    });

    test('snapshot has expected fillable fields for event sourcing', function (): void {
        $snapshot = new Snapshot;
        $expectedFillable = [
            'id',
            'aggregate_uuid',
            'aggregate_version',
            'state',
            'created_at',
            'updated_at'
        ];

        expect($snapshot->getFillable())->toEqual($expectedFillable);
    });

    test('snapshot has factory trait for testing', function (): void {
        $traits = class_uses(Snapshot::class);

        expect($traits)->toHaveKey(HasFactory::class);
    });

   
});
