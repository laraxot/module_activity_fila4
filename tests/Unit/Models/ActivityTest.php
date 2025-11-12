<?php

declare(strict_types=1);

use Modules\Activity\Models\Activity;

test('activity can be created', function () {
    $activity = createActivity([
        'name' => 'Test Activity',
        'description' => 'Test Description',
    ]);

    expect($activity)
        ->toBeActivity()
<<<<<<< HEAD
=======
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> b93ef594b4 (.)
>>>>>>> b1cd7fc (.)
        ->and($activity->name)
        ->toBe('Test Activity')
        ->and($activity->description)
        ->toBe('Test Description');
<<<<<<< HEAD
=======
<<<<<<< HEAD
=======
        ->and($activity->name)->toBe('Test Activity')
        ->and($activity->description)->toBe('Test Description');
>>>>>>> a12f125f4a (.)
=======
>>>>>>> b93ef594b4 (.)
=======
        ->and($activity->name)->toBe('Test Activity')
        ->and($activity->description)->toBe('Test Description');
>>>>>>> origin/develop
>>>>>>> b1cd7fc (.)
});

test('activity has required attributes', function () {
    $activity = makeActivity();

    expect($activity)
        ->toHaveProperty('name')
        ->toHaveProperty('description')
        ->toHaveProperty('created_at')
        ->toHaveProperty('updated_at');
});

test('activity can be soft deleted', function () {
    $activity = createActivity();
<<<<<<< HEAD

    $activity->delete();

=======
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD

    $activity->delete();

=======
    
    $activity->delete();
    
>>>>>>> a12f125f4a (.)
=======

    $activity->delete();

>>>>>>> b93ef594b4 (.)
=======
    
    $activity->delete();
    
>>>>>>> origin/develop
>>>>>>> b1cd7fc (.)
    expect($activity->trashed())->toBeTrue();
});

test('activity factory creates valid instances', function () {
    $activity = Activity::factory()->make();
<<<<<<< HEAD

    expect($activity)->toBeActivity()->and($activity->name)->toBeString()->and($activity->description)->toBeString();
=======
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD

    expect($activity)->toBeActivity()->and($activity->name)->toBeString()->and($activity->description)->toBeString();
=======
=======
>>>>>>> origin/develop
    
    expect($activity)
        ->toBeActivity()
        ->and($activity->name)->toBeString()
        ->and($activity->description)->toBeString();
<<<<<<< HEAD
>>>>>>> a12f125f4a (.)
=======

    expect($activity)->toBeActivity()->and($activity->name)->toBeString()->and($activity->description)->toBeString();
>>>>>>> b93ef594b4 (.)
=======
>>>>>>> origin/develop
>>>>>>> b1cd7fc (.)
});
