<?php

declare(strict_types=1);

use Modules\Activity\Models\Activity;
use Modules\User\Models\User;

test('user can create activity', function () {
<<<<<<< HEAD
    $user = User::factory()->create(); // @phpstan-ignore-line method.nonObject
    \assert($user instanceof User);
    expect($user)->not->toBeNull();

    $activity = Activity::factory()->create([ // @phpstan-ignore-line method.nonObject
        'log_name' => 'test',
        'description' => 'Test Description',
        'causer_type' => User::class,
        'causer_id' => $user->id,
    ]);
    \assert($activity instanceof Activity);
    expect($activity)->not->toBeNull();

    expect($activity)
        ->toBeInstanceOf(Activity::class)
        ->and($activity->description)->toBe('Test Description')
        ->and($activity->causer_id)->toBe($user->id);
});

test('activity can be updated', function () {
    $activity = Activity::factory()->create([ // @phpstan-ignore-line method.nonObject
        'log_name' => 'test',
        'description' => 'Original Description',
    ]);
    \assert($activity instanceof Activity);
    expect($activity)->not->toBeNull();
=======
    $user = User::factory()->create();
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
    $activityData = [
        'name' => 'Test Activity',
        'description' => 'Test Description',
        'user_id' => $user->id,
    ];
<<<<<<< HEAD
=======
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
>>>>>>> b1cd7fc (.)

    $activity = createActivity($activityData);

    expect($activity)
        ->toBeActivity()
        ->and($activity->name)
        ->toBe('Test Activity')
        ->and($activity->user_id)
        ->toBe($user->id);
<<<<<<< HEAD
=======
=======
    
=======

>>>>>>> b93ef594b4 (.)
    $activity = createActivity($activityData);

    expect($activity)
        ->toBeActivity()
<<<<<<< HEAD
        ->and($activity->name)->toBe('Test Activity')
        ->and($activity->user_id)->toBe($user->id);
>>>>>>> a12f125f4a (.)
=======
        ->and($activity->name)
        ->toBe('Test Activity')
        ->and($activity->user_id)
        ->toBe($user->id);
>>>>>>> b93ef594b4 (.)
=======
    
    $activity = createActivity($activityData);
    
    expect($activity)
        ->toBeActivity()
        ->and($activity->name)->toBe('Test Activity')
        ->and($activity->user_id)->toBe($user->id);
>>>>>>> origin/develop
>>>>>>> b1cd7fc (.)
});

test('activity can be updated', function () {
    $activity = createActivity();
<<<<<<< HEAD
>>>>>>> 0b410a6 (.)

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
    $activity->update([
        'description' => 'Updated Description',
    ]);
<<<<<<< HEAD

<<<<<<< HEAD
    $freshActivity = $activity->fresh();
    \assert($freshActivity instanceof Activity);
    expect($freshActivity)->not->toBeNull();
    expect($freshActivity->description)->toBe('Updated Description');
});

test('activity can be deleted', function () {
    $activity = Activity::factory()->create([ // @phpstan-ignore-line method.nonObject
        'log_name' => 'test',
        'description' => 'Test Description',
    ]);
    \assert($activity instanceof Activity);
    expect($activity)->not->toBeNull();
=======
    expect($activity->fresh())->name->toBe('Updated Activity')->description->toBe('Updated Description');
=======
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD

    expect($activity->fresh())->name->toBe('Updated Activity')->description->toBe('Updated Description');
=======
=======
>>>>>>> origin/develop
    
    expect($activity->fresh())
        ->name->toBe('Updated Activity')
        ->description->toBe('Updated Description');
<<<<<<< HEAD
>>>>>>> a12f125f4a (.)
=======

    expect($activity->fresh())->name->toBe('Updated Activity')->description->toBe('Updated Description');
>>>>>>> b93ef594b4 (.)
=======
>>>>>>> origin/develop
>>>>>>> b1cd7fc (.)
});

test('activity can be deleted', function () {
    $activity = createActivity();
<<<<<<< HEAD
>>>>>>> 0b410a6 (.)

    $activityId = $activity->id;
    $activity->delete();

<<<<<<< HEAD
    expect(Activity::find($activityId))->toBeNull();
});

test('activity belongs to user', function () {
    $user = User::factory()->create(); // @phpstan-ignore-line method.nonObject
    \assert($user instanceof User);
    expect($user)->not->toBeNull();

    $activity = Activity::factory()->create([ // @phpstan-ignore-line method.nonObject
        'log_name' => 'test',
        'description' => 'Test Description',
        'causer_type' => User::class,
        'causer_id' => $user->id,
    ]);
    \assert($activity instanceof Activity);
    expect($activity)->not->toBeNull();

    $causer = $activity->causer;
    \assert($causer instanceof User);
    expect($causer)->not->toBeNull()
        ->toBeInstanceOf(User::class);
    expect($causer->id)->toBe($user->id);
=======
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
    expect(Activity::find($activity->id))->toBeNull();
});

test('activity belongs to user', function () {
    $user = User::factory()->create();
    $activity = createActivity(['user_id' => $user->id]);
<<<<<<< HEAD

    expect($activity->user)->toBeInstanceOf(User::class)->and($activity->user->id)->toBe($user->id);
=======
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD

    expect($activity->user)->toBeInstanceOf(User::class)->and($activity->user->id)->toBe($user->id);
=======
=======
>>>>>>> origin/develop
    
    expect($activity->user)
        ->toBeInstanceOf(User::class)
        ->and($activity->user->id)->toBe($user->id);
<<<<<<< HEAD
>>>>>>> a12f125f4a (.)
=======

    expect($activity->user)->toBeInstanceOf(User::class)->and($activity->user->id)->toBe($user->id);
>>>>>>> b93ef594b4 (.)
=======
>>>>>>> origin/develop
>>>>>>> b1cd7fc (.)
>>>>>>> 0b410a6 (.)
});
