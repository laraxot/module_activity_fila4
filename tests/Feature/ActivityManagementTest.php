<?php

declare(strict_types=1);

use Modules\Activity\Models\Activity;
use Modules\User\Models\User;

test('user can create activity', function (): void {
    /* @phpstan-ignore-next-line method.nonObject */
    $user = User/** @phpstan-ignore-line */ ::factory()->create();
    assert($user instanceof User);

    $activityData = [
        'name' => 'Test Activity',
        'description' => 'Test Description',
        'user_id' => $user->id,
    ];

    $activity = createActivity($activityData);

    /* @phpstan-ignore-next-line argument.templateType */
    expect($activity)->toBeInstanceOf(Activity::class);
    /* @phpstan-ignore-next-line property.notFound */
    expect($activity->name)->toBe('Test Activity');
    /* @phpstan-ignore-next-line property.notFound */
    expect($activity->user_id)->toBe($user->id);
});

test('activity can be updated', function (): void {
    $activity = createActivity();

    $activity->update([
        'name' => 'Updated Activity',
        'description' => 'Updated Description',
    ]);

    $freshActivity = $activity->fresh();
    /* @phpstan-ignore-next-line argument.templateType */
    expect($freshActivity)->toBeInstanceOf(Activity::class);
    assert($freshActivity instanceof Activity);

    /* @phpstan-ignore-next-line property.notFound */
    expect($freshActivity->name)->toBe('Updated Activity');
    /* @phpstan-ignore-next-line property.notFound */
    expect($freshActivity->description)->toBe('Updated Description');
});

test('activity can be deleted', function (): void {
    $activity = createActivity();

    $activity->delete();

    expect(Activity::find($activity->id))->toBeNull();
});

test('activity belongs to user', function (): void {
    /* @phpstan-ignore-next-line method.nonObject */
    $user = User/** @phpstan-ignore-line */ ::factory()->create();
    assert($user instanceof User);
    $activity = createActivity(['user_id' => $user->id]);

    expect($activity->user)->toBeInstanceOf(User::class);

    $activityUser = $activity->user;
    if ($activityUser instanceof User) {
        expect($activityUser->id)->toBe($user->id);
    }
});
