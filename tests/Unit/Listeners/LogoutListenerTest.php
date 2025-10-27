<?php

declare(strict_types=1);

use Illuminate\Auth\Events\Logout;
use Illuminate\Support\Facades\Event;
use Modules\Activity\Listeners\LogoutListener;
use Modules\Activity\Models\Activity;
use Modules\User\Models\User;

test('logout listener is registered for logout event', function (): void {
    Event::fake();

    Event::assertListening(Logout::class, LogoutListener::class);
});

test('logout listener handles logout event and creates activity', function (): void {
    /* @phpstan-ignore-next-line method.nonObject */
    $user = User/** @phpstan-ignore-line */ ::factory()->create();
    assert($user instanceof User);
    $event = new Logout('web', $user);

    $listener = new LogoutListener;
    $listener->handle($event);

    $activity = Activity::where('causer_type', User::class)
        ->where('causer_id', $user->id)
        ->where('event', 'logout')
        ->first();

    expect($activity)->not->toBeNull();

    if ($activity instanceof Activity) {
        expect($activity->description)->toContain('logout');
        expect($activity->causer_id)->toBe($user->id);
        expect($activity->causer_type)->toBe(User::class);
        expect($activity->properties)->toHaveKey('guard', 'web');
    }
});

test('logout listener creates activity with correct properties', function (): void {
    /* @phpstan-ignore-next-line method.nonObject */
    $user = User/** @phpstan-ignore-line */ ::factory()->create();
    assert($user instanceof User);
    $event = new Logout('api', $user);

    $listener = new LogoutListener;
    $listener->handle($event);

    $activity = Activity::where('causer_id', $user->id)->latest()->first();

    expect($activity)->toBeInstanceOf(Activity::class);
    if ($activity instanceof Activity) {
        expect($activity->properties)->toHaveKey('guard', 'api');
        expect($activity->properties)->toHaveKey('ip_address');
        expect($activity->properties)->toHaveKey('user_agent');
        expect($activity->properties)->toHaveKey('timestamp');
    }
});

test('logout listener handles multiple logout events correctly', function (): void {
    /* @phpstan-ignore-next-line method.nonObject */
    $user1 = User/** @phpstan-ignore-line */ ::factory()->create();
    assert($user1 instanceof User);
    /* @phpstan-ignore-next-line method.nonObject */
    $user2 = User/** @phpstan-ignore-line */ ::factory()->create();
    assert($user2 instanceof User);

    $event1 = new Logout('web', $user1);
    $event2 = new Logout('api', $user2);

    $listener = new LogoutListener;
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
    }
});

test('logout listener includes session duration when available', function (): void {
    /* @phpstan-ignore-next-line method.nonObject */
    $user = User/** @phpstan-ignore-line */ ::factory()->create();
    assert($user instanceof User);

    $loginTime = now()->subHours(2);
    /* @phpstan-ignore-next-line property.notFound */
    $user->last_login_at = $loginTime;
    $user->save();

    $event = new Logout('web', $user);

    $listener = new LogoutListener;
    $listener->handle($event);

    $activity = Activity::where('causer_id', $user->id)->first();

    expect($activity)->toBeInstanceOf(Activity::class);
    if ($activity instanceof Activity) {
        expect($activity->properties)->toHaveKey('session_duration');
        $sessionDuration = $activity->properties['session_duration'] ?? 0;
        expect($sessionDuration)->toBeGreaterThanOrEqual(7200);
    }
});

test('logout listener uses correct log name for activities', function (): void {
    /* @phpstan-ignore-next-line method.nonObject */
    $user = User/** @phpstan-ignore-line */ ::factory()->create();
    assert($user instanceof User);
    $event = new Logout('web', $user);

    $listener = new LogoutListener;
    $listener->handle($event);

    $activity = Activity::where('causer_id', $user->id)->first();

    expect($activity)->toBeInstanceOf(Activity::class);
    if ($activity instanceof Activity) {
        expect($activity->log_name)->toBe('auth');
    }
});

test('logout listener handles event without user gracefully', function (): void {
    /** @phpstan-ignore-next-line argument.type */
    $event = new Logout('web', null);

    $listener = new LogoutListener;

    expect(fn () => $listener->handle($event))->not->toThrow(Exception::class);

    $activities = Activity::where('event', 'logout')->get();
    expect($activities)->toBeEmpty();
});

test('logout listener creates unique activities for same user different sessions', function (): void {
    /* @phpstan-ignore-next-line method.nonObject */
    $user = User/** @phpstan-ignore-line */ ::factory()->create();
    assert($user instanceof User);

    $event1 = new Logout('web', $user);
    $event2 = new Logout('api', $user);

    $listener = new LogoutListener;
    $listener->handle($event1);
    $listener->handle($event2);

    $activities = Activity::where('causer_id', $user->id)->get();

    expect($activities)->toHaveCount(2);

    $firstActivity = $activities->first();
    $lastActivity = $activities->last();

    expect($firstActivity)->toBeInstanceOf(Activity::class);
    expect($lastActivity)->toBeInstanceOf(Activity::class);

    if ($firstActivity instanceof Activity && $lastActivity instanceof Activity) {
        expect($firstActivity->properties['guard'] ?? null)->toBe('web');
        expect($lastActivity->properties['guard'] ?? null)->toBe('api');
        expect($firstActivity->id)->not->toBe($lastActivity->id);
    }
});

test('logout listener tracks logout reason when provided', function (): void {
    /* @phpstan-ignore-next-line method.nonObject */
    $user = User/** @phpstan-ignore-line */ ::factory()->create();
    assert($user instanceof User);
    $event = new Logout('web', $user);

    $listener = new LogoutListener;
    $listener->handle($event);

    $activity = Activity::where('causer_id', $user->id)->first();

    expect($activity)->toBeInstanceOf(Activity::class);
    if ($activity instanceof Activity) {
        expect($activity->properties)->toHaveKey('logout_reason', 'user_initiated');
    }
});

test('logout listener handles concurrent logout events', function (): void {
    $usersFactory = User::factory();
    assert($usersFactory !== null);
    /* @phpstan-ignore-next-line method.nonObject */
    $users = $usersFactory->count(5)->create();
    assert($users instanceof \Illuminate\Database\Eloquent\Collection);

    /* @phpstan-ignore-next-line method.nonObject */
    $events = $users->map(fn ($user) => new Logout('web', $user));

    $listener = new LogoutListener;

    /* @phpstan-ignore-next-line foreach.nonIterable */
    foreach ($events as $event) {
        $listener->handle($event);
    }

    $activities = Activity::where('event', 'logout')->get();

    expect($activities)->toHaveCount(5);

    $userIds = $activities->pluck('causer_id')->unique();
    expect($userIds)->toHaveCount(5);
});
