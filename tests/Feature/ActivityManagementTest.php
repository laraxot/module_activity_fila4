<?php

declare(strict_types=1);

use Modules\Activity\Models\Activity;
use Modules\User\Models\User;

test('user can create activity', function () {
    $user = User::factory()->create();
<<<<<<< HEAD
<<<<<<< HEAD

=======
    
>>>>>>> 0a00ff2 (.)
=======

>>>>>>> 18dcd64 (.)
    $activityData = [
        'name' => 'Test Activity',
        'description' => 'Test Description',
        'user_id' => $user->id,
    ];
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> 18dcd64 (.)

    $activity = createActivity($activityData);

    expect($activity)
        ->toBeActivity()
        ->and($activity->name)
        ->toBe('Test Activity')
        ->and($activity->user_id)
        ->toBe($user->id);
<<<<<<< HEAD
=======
    
    $activity = createActivity($activityData);
    
    expect($activity)
        ->toBeActivity()
        ->and($activity->name)->toBe('Test Activity')
        ->and($activity->user_id)->toBe($user->id);
>>>>>>> 0a00ff2 (.)
=======
>>>>>>> 18dcd64 (.)
});

test('activity can be updated', function () {
    $activity = createActivity();
<<<<<<< HEAD
<<<<<<< HEAD

=======
    
>>>>>>> 0a00ff2 (.)
=======

>>>>>>> 18dcd64 (.)
    $activity->update([
        'name' => 'Updated Activity',
        'description' => 'Updated Description',
    ]);
<<<<<<< HEAD
<<<<<<< HEAD

    expect($activity->fresh())->name->toBe('Updated Activity')->description->toBe('Updated Description');
=======
    
    expect($activity->fresh())
        ->name->toBe('Updated Activity')
        ->description->toBe('Updated Description');
>>>>>>> 0a00ff2 (.)
=======

    expect($activity->fresh())->name->toBe('Updated Activity')->description->toBe('Updated Description');
>>>>>>> 18dcd64 (.)
});

test('activity can be deleted', function () {
    $activity = createActivity();
<<<<<<< HEAD
<<<<<<< HEAD

    $activity->delete();

=======
    
    $activity->delete();
    
>>>>>>> 0a00ff2 (.)
=======

    $activity->delete();

>>>>>>> 18dcd64 (.)
    expect(Activity::find($activity->id))->toBeNull();
});

test('activity belongs to user', function () {
    $user = User::factory()->create();
    $activity = createActivity(['user_id' => $user->id]);
<<<<<<< HEAD
<<<<<<< HEAD

    expect($activity->user)->toBeInstanceOf(User::class)->and($activity->user->id)->toBe($user->id);
=======
    
    expect($activity->user)
        ->toBeInstanceOf(User::class)
        ->and($activity->user->id)->toBe($user->id);
>>>>>>> 0a00ff2 (.)
=======

    expect($activity->user)->toBeInstanceOf(User::class)->and($activity->user->id)->toBe($user->id);
>>>>>>> 18dcd64 (.)
});
