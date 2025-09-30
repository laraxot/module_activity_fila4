<?php

declare(strict_types=1);

<<<<<<< HEAD
use Modules\Activity\Models\BaseSnapshot;
use Illuminate\Database\Eloquent\Factories\HasFactory;
=======
<<<<<<< HEAD
use Modules\Activity\Models\BaseSnapshot;
use Illuminate\Database\Eloquent\Factories\HasFactory;
=======
>>>>>>> origin/develop
>>>>>>> b1cd7fc (.)
use Modules\Activity\Models\Snapshot;

describe('Snapshot Business Logic', function () {
    test('snapshot has correct connection configured', function () {
        $snapshot = new Snapshot();
<<<<<<< HEAD

=======
<<<<<<< HEAD

=======
        
>>>>>>> origin/develop
>>>>>>> b1cd7fc (.)
        expect($snapshot->getConnectionName())->toBe('activity');
    });

    test('snapshot has expected fillable fields for event sourcing', function () {
        $snapshot = new Snapshot();
        $expectedFillable = [
            'id',
            'aggregate_uuid',
            'aggregate_version',
            'state',
            'created_at',
<<<<<<< HEAD
            'updated_at',
        ];

=======
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
            'updated_at',
=======
            'updated_at'
>>>>>>> a12f125f4a (.)
=======
            'updated_at',
>>>>>>> b93ef594b4 (.)
        ];

=======
            'updated_at'
        ];
        
>>>>>>> origin/develop
>>>>>>> b1cd7fc (.)
        expect($snapshot->getFillable())->toEqual($expectedFillable);
    });

    test('snapshot extends base snapshot', function () {
<<<<<<< HEAD
        expect(is_subclass_of(Snapshot::class, BaseSnapshot::class))->toBeTrue();
=======
<<<<<<< HEAD
        expect(is_subclass_of(Snapshot::class, BaseSnapshot::class))->toBeTrue();
=======
        expect(is_subclass_of(Snapshot::class, \Modules\Activity\Models\BaseSnapshot::class))->toBeTrue();
>>>>>>> origin/develop
>>>>>>> b1cd7fc (.)
    });

    test('snapshot has factory trait for testing', function () {
        $traits = class_uses(Snapshot::class);
<<<<<<< HEAD

        expect($traits)->toHaveKey(HasFactory::class);
=======
<<<<<<< HEAD

        expect($traits)->toHaveKey(HasFactory::class);
=======
        
        expect($traits)->toHaveKey(\Illuminate\Database\Eloquent\Factories\HasFactory::class);
>>>>>>> origin/develop
>>>>>>> b1cd7fc (.)
    });

    test('snapshot has uuid scope method', function () {
        expect(method_exists(Snapshot::class, 'scopeUuid'))->toBeTrue();
    });

    test('snapshot can query by aggregate version', function () {
        expect(method_exists(Snapshot::class, 'whereAggregateVersion'))->toBeTrue();
    });
<<<<<<< HEAD
});
=======
<<<<<<< HEAD
});
=======
});
>>>>>>> origin/develop
>>>>>>> b1cd7fc (.)
