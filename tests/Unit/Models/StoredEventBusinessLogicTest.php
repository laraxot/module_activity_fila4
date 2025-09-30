<?php

declare(strict_types=1);

<<<<<<< HEAD
use Spatie\EventSourcing\StoredEvents\Models\EloquentStoredEvent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
=======
<<<<<<< HEAD
use Spatie\EventSourcing\StoredEvents\Models\EloquentStoredEvent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
=======
>>>>>>> origin/develop
>>>>>>> b1cd7fc (.)
use Modules\Activity\Models\StoredEvent;

describe('StoredEvent Business Logic', function () {
    test('stored event has correct connection configured', function () {
        $storedEvent = new StoredEvent();
<<<<<<< HEAD

=======
<<<<<<< HEAD

=======
        
>>>>>>> origin/develop
>>>>>>> b1cd7fc (.)
        expect($storedEvent->getConnectionName())->toBe('activity');
    });

    test('stored event has correct table configured', function () {
        $storedEvent = new StoredEvent();
<<<<<<< HEAD

=======
<<<<<<< HEAD

=======
        
>>>>>>> origin/develop
>>>>>>> b1cd7fc (.)
        expect($storedEvent->getTable())->toBe('stored_events');
    });

    test('stored event has expected fillable fields for event sourcing', function () {
        $storedEvent = new StoredEvent();
        $expectedFillable = [
            'id',
            'aggregate_uuid',
            'aggregate_version',
            'event_version',
            'event_class',
            'event_properties',
            'meta_data',
            'created_at',
            'updated_by',
            'created_by',
        ];
<<<<<<< HEAD

=======
<<<<<<< HEAD

=======
        
>>>>>>> origin/develop
>>>>>>> b1cd7fc (.)
        expect($storedEvent->getFillable())->toEqual($expectedFillable);
    });

    test('stored event extends eloquent stored event for event sourcing', function () {
<<<<<<< HEAD
=======
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> b93ef594b4 (.)
>>>>>>> b1cd7fc (.)
        expect(is_subclass_of(
            StoredEvent::class,
            EloquentStoredEvent::class,
        ))->toBeTrue();
<<<<<<< HEAD
=======
<<<<<<< HEAD
=======
        expect(is_subclass_of(StoredEvent::class, EloquentStoredEvent::class))->toBeTrue();
>>>>>>> a12f125f4a (.)
=======
>>>>>>> b93ef594b4 (.)
=======
        expect(is_subclass_of(StoredEvent::class, \Spatie\EventSourcing\StoredEvents\Models\EloquentStoredEvent::class))->toBeTrue();
>>>>>>> origin/develop
>>>>>>> b1cd7fc (.)
    });

    test('stored event has factory trait for testing', function () {
        $traits = class_uses(StoredEvent::class);
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

    test('stored event has after version scope method', function () {
        expect(method_exists(StoredEvent::class, 'scopeAfterVersion'))->toBeTrue();
    });

    test('stored event has where aggregate root scope method', function () {
        expect(method_exists(StoredEvent::class, 'scopeWhereAggregateRoot'))->toBeTrue();
    });

    test('stored event has where event scope method', function () {
        expect(method_exists(StoredEvent::class, 'scopeWhereEvent'))->toBeTrue();
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
