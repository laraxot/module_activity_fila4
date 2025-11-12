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
        ->and($activity->name)
        ->toBe('Test Activity')
        ->and($activity->description)
        ->toBe('Test Description');
=======
        ->and($activity->name)->toBe('Test Activity')
        ->and($activity->description)->toBe('Test Description');
>>>>>>> 0a00ff2 (.)
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
    
    $activity->delete();
    
>>>>>>> 0a00ff2 (.)
    expect($activity->trashed())->toBeTrue();
});

test('activity factory creates valid instances', function () {
    $activity = Activity::factory()->make();
<<<<<<< HEAD

    expect($activity)->toBeActivity()->and($activity->name)->toBeString()->and($activity->description)->toBeString();
=======
    
    expect($activity)
        ->toBeActivity()
        ->and($activity->name)->toBeString()
        ->and($activity->description)->toBeString();
>>>>>>> 0a00ff2 (.)
});
