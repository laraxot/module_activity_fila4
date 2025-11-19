<?php

declare(strict_types=1);

use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Event;
use Modules\Activity\Listeners\LoginListener;
use Modules\Activity\Models\Activity;
use Modules\User\Models\User;

test('login listener is registered for login event', function (): void {
    Event::fake();

    Event::assertListening(Login::class, LoginListener::class);
});

test('login listener handles login event and creates activity', function (): void {
    /* @phpstan-ignore-next-line method.nonObject */
    $user = User::factory()->create();
    assert($user instanceof User);
    $event = new Login('web', $user, false);

    $listener = new LoginListener();
    $listener->handle($event);

    $activity = Activity::where('causer_type', User::class)
        ->where('causer_id', $user->id)
        ->where('event', 'login')
        ->first();

    expect($activity)->not->toBeNull();

    if ($activity instanceof Activity) {
        expect($activity->description)->toContain('login');
        expect($activity->causer_id)->toBe($user->id);
        expect($activity->causer_type)->toBe(User::class);
        expect($activity->properties)->toHaveKey('guard', 'web');
    }
});

test('login listener creates activity with correct properties', function (): void {
    /* @phpstan-ignore-next-line method.nonObject */
    $user = User::factory()->create();
    assert($user instanceof User);
    $event = new Login('api', $user, true);

    $listener = new LoginListener();
    $listener->handle($event);

    $activity = Activity::where('causer_id', $user->id)->latest()->first();

    expect($activity)->toBeInstanceOf(Activity::class);
    if ($activity instanceof Activity) {
        expect($activity->properties)->toHaveKey('guard', 'api');
        expect($activity->properties)->toHaveKey('remember', true);
        expect($activity->properties)->toHaveKey('ip_address');
        expect($activity->properties)->toHaveKey('user_agent');
    }
});

test('login listener handles multiple login events correctly', function (): void {
    /* @phpstan-ignore-next-line method.nonObject */
    $user1 = User::factory()->create();
    assert($user1 instanceof User);
    /* @phpstan-ignore-next-line method.nonObject */
    $user2 = User::factory()->create();
    assert($user2 instanceof User);

    $event1 = new Login('web', $user1, false);
    $event2 = new Login('api', $user2, true);

    $listener = new LoginListener();
    $listener->handle($event1);
    $listener->handle($event2);

    $activities = Activity::whereIn('causer_id', [$user1->id, $user2->id])->get();

    expect($activities)->toHaveCount(2);

    $user1Activity = $activities->where('causer_id', $user1->id)->first();
    $user2Activity = $activities->where('causer_id', $user2->id)->first();

    expect($user1Activity)->toBeInstanceOf(Activity::class);
    expect($user2Activity)->toBeInstanceOf(Activity::class);

    if ($user1Activity instanceof Activity && $user2Activity instanceof Activity) {
        expect($user1Activity->properties['guard'] ?? null)->toBe('web');
        expect($user2Activity->properties['guard'] ?? null)->toBe('api');
        expect($user1Activity->properties['remember'] ?? null)->toBeFalse();
        expect($user2Activity->properties['remember'] ?? null)->toBeTrue();
    }
});

test('login listener includes request information in activity properties', function (): void {
    /* @phpstan-ignore-next-line method.nonObject */
    $user = User::factory()->create();
    assert($user instanceof User);
    $event = new Login('web', $user, false);

    $listener = new LoginListener();
    $listener->handle($event);

    $activity = Activity::where('causer_id', $user->id)->first();

    expect($activity)->toBeInstanceOf(Activity::class);
    if ($activity instanceof Activity) {
        expect($activity->properties)->toHaveKey('ip_address');
        expect($activity->properties)->toHaveKey('user_agent');
        expect($activity->properties)->toHaveKey('timestamp');
    }
});

test('login listener uses correct log name for activities', function (): void {
    /* @phpstan-ignore-next-line method.nonObject */
    $user = User::factory()->create();
    assert($user instanceof User);
    $event = new Login('web', $user, false);

    $listener = new LoginListener();
    $listener->handle($event);

    $activity = Activity::where('causer_id', $user->id)->first();

    expect($activity)->toBeInstanceOf(Activity::class);
    if ($activity instanceof Activity) {
        expect($activity->log_name)->toBe('auth');
    }
});

test('login listener handles event without user gracefully', function (): void {
    /** @phpstan-ignore-next-line argument.type */
    $event = new Login('web', null, false);

    $listener = new LoginListener();

    expect(fn () => $listener->handle($event))->not->toThrow(Exception::class);

    $activities = Activity::where('event', 'login')->get();
    expect($activities)->toBeEmpty();
});

test('login listener creates unique activities for same user different sessions', function (): void {
    /* @phpstan-ignore-next-line method.nonObject */
    $user = User::factory()->create();
    assert($user instanceof User);

    $event1 = new Login('web', $user, false);
    $event2 = new Login('web', $user, true);

    $listener = new LoginListener();
    $listener->handle($event1);
    $listener->handle($event2);

    $activities = Activity::where('causer_id', $user->id)->get();

    expect($activities)->toHaveCount(2);

    $firstActivity = $activities->first();
    $lastActivity = $activities->last();

    expect($firstActivity)->toBeInstanceOf(Activity::class);
    expect($lastActivity)->toBeInstanceOf(Activity::class);

    if ($firstActivity instanceof Activity && $lastActivity instanceof Activity) {
        expect($firstActivity->properties['remember'] ?? null)->toBeFalse();
        expect($lastActivity->properties['remember'] ?? null)->toBeTrue();
        expect($firstActivity->id)->not->toBe($lastActivity->id);
    }
});
