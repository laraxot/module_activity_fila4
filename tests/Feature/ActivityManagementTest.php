<?php

declare(strict_types=1);

use Modules\Activity\Models\Activity;
use Modules\User\Models\User;

test('user can create activity', function () {
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
        'name' => 'Updated Activity',
        'description' => 'Updated Description',
    ]);
<<<<<<< HEAD

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
});
