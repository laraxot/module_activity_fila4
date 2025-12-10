<?php

declare(strict_types=1);

use Modules\Activity\Models\Activity;

describe('Activity Business Logic', function () {
    test('activity has correct connection configured', function () {
        $activity = new Activity();
<<<<<<< HEAD

=======
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD

=======
        
>>>>>>> a12f125f4a (.)
=======

>>>>>>> b93ef594b4 (.)
=======
        
>>>>>>> origin/develop
>>>>>>> b1cd7fc (.)
        expect($activity->getConnectionName())->toBe('activity');
    });

    test('activity has expected fillable fields', function () {
        $activity = new Activity();
        $expectedFillable = [
            'id',
            'log_name',
            'description',
            'subject_type',
            'event',
            'subject_id',
            'causer_type',
            'causer_id',
            'properties',
            'batch_uuid',
            'created_at',
            'updated_at',
        ];
<<<<<<< HEAD

=======
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD

=======
        
>>>>>>> a12f125f4a (.)
=======

>>>>>>> b93ef594b4 (.)
=======
        
>>>>>>> origin/develop
>>>>>>> b1cd7fc (.)
        expect($activity->getFillable())->toEqual($expectedFillable);
    });

    test('activity extends spatie activity functionality', function () {
        expect(is_subclass_of(Activity::class, \Spatie\Activitylog\Models\Activity::class))->toBeTrue();
    });

    test('activity has in log scope method', function () {
        expect(method_exists(Activity::class, 'scopeInLog'))->toBeTrue();
    });

    test('activity has for event scope method', function () {
        expect(method_exists(Activity::class, 'scopeForEvent'))->toBeTrue();
    });

    test('activity has batch scope method', function () {
        expect(method_exists(Activity::class, 'scopeHasBatch'))->toBeTrue();
    });
<<<<<<< HEAD
});
=======
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
});
=======
});
>>>>>>> a12f125f4a (.)
=======
});
>>>>>>> b93ef594b4 (.)
=======
});
>>>>>>> origin/develop
>>>>>>> b1cd7fc (.)
