<?php

declare(strict_types=1);

use Illuminate\Auth\Events\Logout;
use Illuminate\Support\Facades\Event;
use Modules\Activity\Listeners\LogoutListener;
use Modules\Activity\Models\Activity;
use Modules\User\Models\User;

test('logout listener is registered for logout event', function () {
    Event::fake();
<<<<<<< HEAD

    Event::assertListening(Logout::class, LogoutListener::class);
=======
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD

    Event::assertListening(Logout::class, LogoutListener::class);
=======
=======
>>>>>>> origin/develop
    
    Event::assertListening(
        Logout::class,
        LogoutListener::class
    );
<<<<<<< HEAD
>>>>>>> a12f125f4a (.)
=======

    Event::assertListening(Logout::class, LogoutListener::class);
>>>>>>> b93ef594b4 (.)
=======
>>>>>>> origin/develop
>>>>>>> b1cd7fc (.)
});

test('logout listener handles logout event and creates activity', function () {
    $user = User::factory()->create();
    $event = new Logout('web', $user);
<<<<<<< HEAD
=======
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
>>>>>>> b1cd7fc (.)

    $listener = new LogoutListener;
    $listener->handle($event);

<<<<<<< HEAD
=======
=======
=======
>>>>>>> origin/develop
    
    $listener = new LogoutListener();
    $listener->handle($event);
    
<<<<<<< HEAD
>>>>>>> a12f125f4a (.)
=======

    $listener = new LogoutListener();
    $listener->handle($event);

>>>>>>> b93ef594b4 (.)
=======
>>>>>>> origin/develop
>>>>>>> b1cd7fc (.)
    $activity = Activity::where('causer_type', User::class)
        ->where('causer_id', $user->id)
        ->where('event', 'logout')
        ->first();
<<<<<<< HEAD

    expect($activity)
        ->not->toBeNull()
=======
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD

    expect($activity)
        ->not->toBeNull()
=======
    
    expect($activity)->not->toBeNull()
>>>>>>> a12f125f4a (.)
=======

    expect($activity)
        ->not->toBeNull()
>>>>>>> b93ef594b4 (.)
=======
    
    expect($activity)->not->toBeNull()
>>>>>>> origin/develop
>>>>>>> b1cd7fc (.)
        ->description->toContain('logout')
        ->causer_id->toBe($user->id)
        ->causer_type->toBe(User::class)
        ->properties->toHaveKey('guard', 'web');
});

test('logout listener creates activity with correct properties', function () {
    $user = User::factory()->create();
    $event = new Logout('api', $user);
<<<<<<< HEAD
=======
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
>>>>>>> b1cd7fc (.)

    $listener = new LogoutListener;
    $listener->handle($event);

    $activity = Activity::where('causer_id', $user->id)->latest()->first();

<<<<<<< HEAD
=======
=======
    
=======

>>>>>>> b93ef594b4 (.)
    $listener = new LogoutListener();
    $listener->handle($event);

    $activity = Activity::where('causer_id', $user->id)->latest()->first();
<<<<<<< HEAD
    
>>>>>>> a12f125f4a (.)
=======

>>>>>>> b93ef594b4 (.)
=======
    
    $listener = new LogoutListener();
    $listener->handle($event);
    
    $activity = Activity::where('causer_id', $user->id)->latest()->first();
    
>>>>>>> origin/develop
>>>>>>> b1cd7fc (.)
    expect($activity->properties)
        ->toHaveKey('guard', 'api')
        ->toHaveKey('ip_address')
        ->toHaveKey('user_agent')
        ->toHaveKey('timestamp');
});

test('logout listener handles multiple logout events correctly', function () {
    $user1 = User::factory()->create();
    $user2 = User::factory()->create();
<<<<<<< HEAD
=======
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
>>>>>>> b1cd7fc (.)

    $event1 = new Logout('web', $user1);
    $event2 = new Logout('api', $user2);

    $listener = new LogoutListener;
    $listener->handle($event1);
    $listener->handle($event2);

    $activities = Activity::whereIn('causer_id', [$user1->id, $user2->id])->get();

    expect($activities)->toHaveCount(2);

    $user1Activity = $activities->where('causer_id', $user1->id)->first();
    $user2Activity = $activities->where('causer_id', $user2->id)->first();

<<<<<<< HEAD
=======
=======
    
=======

>>>>>>> b93ef594b4 (.)
    $event1 = new Logout('web', $user1);
    $event2 = new Logout('api', $user2);

    $listener = new LogoutListener();
    $listener->handle($event1);
    $listener->handle($event2);

    $activities = Activity::whereIn('causer_id', [$user1->id, $user2->id])->get();

    expect($activities)->toHaveCount(2);

    $user1Activity = $activities->where('causer_id', $user1->id)->first();
    $user2Activity = $activities->where('causer_id', $user2->id)->first();
<<<<<<< HEAD
    
>>>>>>> a12f125f4a (.)
=======

>>>>>>> b93ef594b4 (.)
=======
    
    $event1 = new Logout('web', $user1);
    $event2 = new Logout('api', $user2);
    
    $listener = new LogoutListener();
    $listener->handle($event1);
    $listener->handle($event2);
    
    $activities = Activity::whereIn('causer_id', [$user1->id, $user2->id])->get();
    
    expect($activities)->toHaveCount(2);
    
    $user1Activity = $activities->where('causer_id', $user1->id)->first();
    $user2Activity = $activities->where('causer_id', $user2->id)->first();
    
>>>>>>> origin/develop
>>>>>>> b1cd7fc (.)
    expect($user1Activity->properties['guard'])->toBe('web');
    expect($user2Activity->properties['guard'])->toBe('api');
});

test('logout listener includes session duration when available', function () {
    $user = User::factory()->create();
<<<<<<< HEAD
=======
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
>>>>>>> b1cd7fc (.)

    $loginTime = now()->subHours(2);
    $user->last_login_at = $loginTime;
    $user->save();

    $event = new Logout('web', $user);

    $listener = new LogoutListener;
    $listener->handle($event);

    $activity = Activity::where('causer_id', $user->id)->first();

    expect($activity->properties)->toHaveKey('session_duration')->session_duration->toBeGreaterThanOrEqual(7200);
<<<<<<< HEAD
});

test('logout listener uses correct log name for activities', function () {
    $user = User::factory()->create();
=======
=======
    
=======

>>>>>>> b93ef594b4 (.)
    $loginTime = now()->subHours(2);
    $user->last_login_at = $loginTime;
    $user->save();

>>>>>>> b1cd7fc (.)
    $event = new Logout('web', $user);

    $listener = new LogoutListener;
    $listener->handle($event);

    $activity = Activity::where('causer_id', $user->id)->first();
<<<<<<< HEAD

=======
<<<<<<< HEAD
=======
    
    $loginTime = now()->subHours(2);
    $user->last_login_at = $loginTime;
    $user->save();
    
    $event = new Logout('web', $user);
    
    $listener = new LogoutListener();
    $listener->handle($event);
    
    $activity = Activity::where('causer_id', $user->id)->first();
>>>>>>> origin/develop
    
    expect($activity->properties)
        ->toHaveKey('session_duration')
        ->session_duration->toBeGreaterThanOrEqual(7200);
<<<<<<< HEAD
>>>>>>> a12f125f4a (.)
=======

    expect($activity->properties)->toHaveKey('session_duration')->session_duration->toBeGreaterThanOrEqual(7200);
>>>>>>> b93ef594b4 (.)
=======
>>>>>>> origin/develop
});

test('logout listener uses correct log name for activities', function () {
    $user = User::factory()->create();
    $event = new Logout('web', $user);
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD

    $listener = new LogoutListener();
    $listener->handle($event);

    $activity = Activity::where('causer_id', $user->id)->first();

=======
    
=======

>>>>>>> b93ef594b4 (.)
    $listener = new LogoutListener();
    $listener->handle($event);

    $activity = Activity::where('causer_id', $user->id)->first();
<<<<<<< HEAD
    
>>>>>>> a12f125f4a (.)
=======

>>>>>>> b93ef594b4 (.)
=======
    
    $listener = new LogoutListener();
    $listener->handle($event);
    
    $activity = Activity::where('causer_id', $user->id)->first();
    
>>>>>>> origin/develop
>>>>>>> b1cd7fc (.)
    expect($activity->log_name)->toBe('auth');
});

test('logout listener handles event without user gracefully', function () {
    $event = new Logout('web', null);
<<<<<<< HEAD
=======
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
>>>>>>> b1cd7fc (.)

    $listener = new LogoutListener;

    expect(fn () => $listener->handle($event))->not->toThrow(Exception::class);

<<<<<<< HEAD
=======
=======
    
=======

>>>>>>> b93ef594b4 (.)
    $listener = new LogoutListener();

    expect(fn() => $listener->handle($event))->not->toThrow(Exception::class);
<<<<<<< HEAD
    
>>>>>>> a12f125f4a (.)
=======

>>>>>>> b93ef594b4 (.)
=======
    
    $listener = new LogoutListener();
    
    expect(fn() => $listener->handle($event))->not->toThrow(Exception::class);
    
>>>>>>> origin/develop
>>>>>>> b1cd7fc (.)
    $activities = Activity::where('event', 'logout')->get();
    expect($activities)->toBeEmpty();
});

test('logout listener creates unique activities for same user different sessions', function () {
    $user = User::factory()->create();
<<<<<<< HEAD
=======
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
>>>>>>> b1cd7fc (.)

    $event1 = new Logout('web', $user);
    $event2 = new Logout('api', $user);

    $listener = new LogoutListener;
    $listener->handle($event1);
    $listener->handle($event2);

    $activities = Activity::where('causer_id', $user->id)->get();

    expect($activities)->toHaveCount(2);

    $firstActivity = $activities->first();
    $lastActivity = $activities->last();

<<<<<<< HEAD
=======
=======
    
=======

>>>>>>> b93ef594b4 (.)
    $event1 = new Logout('web', $user);
    $event2 = new Logout('api', $user);

    $listener = new LogoutListener();
    $listener->handle($event1);
    $listener->handle($event2);

    $activities = Activity::where('causer_id', $user->id)->get();

    expect($activities)->toHaveCount(2);

    $firstActivity = $activities->first();
    $lastActivity = $activities->last();
<<<<<<< HEAD
    
>>>>>>> a12f125f4a (.)
=======

>>>>>>> b93ef594b4 (.)
=======
    
    $event1 = new Logout('web', $user);
    $event2 = new Logout('api', $user);
    
    $listener = new LogoutListener();
    $listener->handle($event1);
    $listener->handle($event2);
    
    $activities = Activity::where('causer_id', $user->id)->get();
    
    expect($activities)->toHaveCount(2);
    
    $firstActivity = $activities->first();
    $lastActivity = $activities->last();
    
>>>>>>> origin/develop
>>>>>>> b1cd7fc (.)
    expect($firstActivity->properties['guard'])->toBe('web');
    expect($lastActivity->properties['guard'])->toBe('api');
    expect($firstActivity->id)->not->toBe($lastActivity->id);
});

test('logout listener tracks logout reason when provided', function () {
    $user = User::factory()->create();
    $event = new Logout('web', $user);
<<<<<<< HEAD
=======
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
>>>>>>> b1cd7fc (.)

    $listener = new LogoutListener;
    $listener->handle($event);

    $activity = Activity::where('causer_id', $user->id)->first();

    expect($activity->properties)->toHaveKey('logout_reason', 'user_initiated');
<<<<<<< HEAD
=======
=======
    
=======

>>>>>>> b93ef594b4 (.)
    $listener = new LogoutListener();
    $listener->handle($event);

    $activity = Activity::where('causer_id', $user->id)->first();
<<<<<<< HEAD
    
    expect($activity->properties)
        ->toHaveKey('logout_reason', 'user_initiated');
>>>>>>> a12f125f4a (.)
=======

    expect($activity->properties)->toHaveKey('logout_reason', 'user_initiated');
>>>>>>> b93ef594b4 (.)
=======
    
    $listener = new LogoutListener();
    $listener->handle($event);
    
    $activity = Activity::where('causer_id', $user->id)->first();
    
    expect($activity->properties)
        ->toHaveKey('logout_reason', 'user_initiated');
>>>>>>> origin/develop
>>>>>>> b1cd7fc (.)
});

test('logout listener handles concurrent logout events', function () {
    $users = User::factory()->count(5)->create();
<<<<<<< HEAD
=======
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
>>>>>>> b1cd7fc (.)

    $events = $users->map(fn ($user) => new Logout('web', $user));

    $listener = new LogoutListener;

    foreach ($events as $event) {
        $listener->handle($event);
    }

    $activities = Activity::where('event', 'logout')->get();

    expect($activities)->toHaveCount(5);

    $userIds = $activities->pluck('causer_id')->unique();
    expect($userIds)->toHaveCount(5);
});
<<<<<<< HEAD
=======
=======
    
=======

>>>>>>> b93ef594b4 (.)
    $events = $users->map(fn($user) => new Logout('web', $user));

    $listener = new LogoutListener();

    foreach ($events as $event) {
        $listener->handle($event);
    }

    $activities = Activity::where('event', 'logout')->get();

    expect($activities)->toHaveCount(5);

    $userIds = $activities->pluck('causer_id')->unique();
    expect($userIds)->toHaveCount(5);
});
<<<<<<< HEAD
>>>>>>> a12f125f4a (.)
=======
>>>>>>> b93ef594b4 (.)
=======
    
    $events = $users->map(fn($user) => new Logout('web', $user));
    
    $listener = new LogoutListener();
    
    foreach ($events as $event) {
        $listener->handle($event);
    }
    
    $activities = Activity::where('event', 'logout')->get();
    
    expect($activities)->toHaveCount(5);
    
    $userIds = $activities->pluck('causer_id')->unique();
    expect($userIds)->toHaveCount(5);
});
>>>>>>> origin/develop
>>>>>>> b1cd7fc (.)
