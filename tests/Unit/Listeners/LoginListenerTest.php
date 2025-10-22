<?php

declare(strict_types=1);

use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Event;
use Modules\Activity\Listeners\LoginListener;
use Modules\Activity\Models\Activity;
use Modules\User\Models\User;

test('login listener is registered for login event', function () {
    Event::fake();
<<<<<<< HEAD

<<<<<<< HEAD
=======
    Event::assertListening(Login::class, LoginListener::class);
=======
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD

    Event::assertListening(Login::class, LoginListener::class);
=======
=======
>>>>>>> origin/develop
    
>>>>>>> 0b410a6 (.)
    Event::assertListening(
        Login::class,
        LoginListener::class
    );
<<<<<<< HEAD
=======
<<<<<<< HEAD
>>>>>>> a12f125f4a (.)
=======

    Event::assertListening(Login::class, LoginListener::class);
>>>>>>> b93ef594b4 (.)
=======
>>>>>>> origin/develop
>>>>>>> b1cd7fc (.)
>>>>>>> 0b410a6 (.)
});

test('login listener handles login event and creates activity', function () {
    $user = User::factory()->create(); // @phpstan-ignore-line method.nonObject
    \assert($user instanceof User);
    $event = new Login('web', $user, false);
<<<<<<< HEAD
=======
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
>>>>>>> b1cd7fc (.)

    $listener = new LoginListener();
    $listener->handle($event);

<<<<<<< HEAD
=======
=======
=======
>>>>>>> origin/develop
    
    $listener = new LoginListener();
    $listener->handle($event);
    
<<<<<<< HEAD
>>>>>>> a12f125f4a (.)
=======

    $listener = new LoginListener();
    $listener->handle($event);

>>>>>>> b93ef594b4 (.)
=======
>>>>>>> origin/develop
>>>>>>> b1cd7fc (.)
    $activity = Activity::where('causer_type', User::class)
        ->where('causer_id', $user->id)
        ->where('event', 'login')
        ->first();
<<<<<<< HEAD

<<<<<<< HEAD
    \assert($activity instanceof Activity);
    expect($activity)->not->toBeNull();
    expect($activity->description)->toContain('login');
    expect($activity->causer_id)->toBe($user->id);
    expect($activity->causer_type)->toBe(User::class);
    expect($activity->properties)->toHaveKey('guard', 'web');
=======
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
        ->description->toContain('login')
        ->causer_id->toBe($user->id)
        ->causer_type->toBe(User::class)
        ->properties->toHaveKey('guard', 'web');
>>>>>>> 0b410a6 (.)
});

test('login listener creates activity with correct properties', function () {
    $user = User::factory()->create(); // @phpstan-ignore-line method.nonObject
    \assert($user instanceof User);
    $event = new Login('api', $user, true);
<<<<<<< HEAD
=======
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
>>>>>>> b1cd7fc (.)

    $listener = new LoginListener();
    $listener->handle($event);

    $activity = Activity::where('causer_id', $user->id)->latest()->first();
    \assert($activity instanceof Activity);

<<<<<<< HEAD
=======
=======
    
=======

>>>>>>> b93ef594b4 (.)
    $listener = new LoginListener();
    $listener->handle($event);

    $activity = Activity::where('causer_id', $user->id)->latest()->first();
<<<<<<< HEAD
    
>>>>>>> a12f125f4a (.)
=======

>>>>>>> b93ef594b4 (.)
=======
    
    $listener = new LoginListener();
    $listener->handle($event);
    
    $activity = Activity::where('causer_id', $user->id)->latest()->first();
    
>>>>>>> origin/develop
>>>>>>> b1cd7fc (.)
    expect($activity->properties)
        ->toHaveKey('guard', 'api')
        ->toHaveKey('remember', true)
        ->toHaveKey('ip_address')
        ->toHaveKey('user_agent');
});

test('login listener handles multiple login events correctly', function () {
<<<<<<< HEAD
    $user1 = User::factory()->create(); // @phpstan-ignore-line method.nonObject
    \assert($user1 instanceof User);
    $user2 = User::factory()->create(); // @phpstan-ignore-line method.nonObject
    \assert($user2 instanceof User);
=======
    $user1 = User::factory()->create();
    $user2 = User::factory()->create();
<<<<<<< HEAD
=======
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
>>>>>>> b1cd7fc (.)
>>>>>>> 0b410a6 (.)

    $event1 = new Login('web', $user1, false);
    $event2 = new Login('api', $user2, true);

    $listener = new LoginListener();
    $listener->handle($event1);
    $listener->handle($event2);

    $activities = Activity::whereIn('causer_id', [$user1->id, $user2->id])->get();

    expect($activities)->toHaveCount(2);

    $user1Activity = $activities->where('causer_id', $user1->id)->first();
    \assert($user1Activity instanceof Activity);
    $user2Activity = $activities->where('causer_id', $user2->id)->first();
    \assert($user2Activity instanceof Activity);

<<<<<<< HEAD
=======
=======
    
=======

>>>>>>> b93ef594b4 (.)
    $event1 = new Login('web', $user1, false);
    $event2 = new Login('api', $user2, true);

    $listener = new LoginListener();
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
    
    $event1 = new Login('web', $user1, false);
    $event2 = new Login('api', $user2, true);
    
    $listener = new LoginListener();
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
    expect($user1Activity->properties['remember'])->toBeFalse();
    expect($user2Activity->properties['remember'])->toBeTrue();
});

test('login listener includes request information in activity properties', function () {
    $user = User::factory()->create(); // @phpstan-ignore-line method.nonObject
    \assert($user instanceof User);
    $event = new Login('web', $user, false);
<<<<<<< HEAD
=======
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
>>>>>>> b1cd7fc (.)

    $listener = new LoginListener();
    $listener->handle($event);

    $activity = Activity::where('causer_id', $user->id)->first();
    \assert($activity instanceof Activity);

<<<<<<< HEAD
=======
    expect($activity->properties)->toHaveKey('ip_address')->toHaveKey('user_agent')->toHaveKey('timestamp');
<<<<<<< HEAD
=======
=======
    
=======

>>>>>>> b93ef594b4 (.)
    $listener = new LoginListener();
    $listener->handle($event);

    $activity = Activity::where('causer_id', $user->id)->first();
<<<<<<< HEAD
=======
    
    $listener = new LoginListener();
    $listener->handle($event);
    
    $activity = Activity::where('causer_id', $user->id)->first();
>>>>>>> origin/develop
    
>>>>>>> 0b410a6 (.)
    expect($activity->properties)
        ->toHaveKey('ip_address')
        ->toHaveKey('user_agent')
        ->toHaveKey('timestamp');
<<<<<<< HEAD
=======
<<<<<<< HEAD
>>>>>>> a12f125f4a (.)
=======

    expect($activity->properties)->toHaveKey('ip_address')->toHaveKey('user_agent')->toHaveKey('timestamp');
>>>>>>> b93ef594b4 (.)
=======
>>>>>>> origin/develop
>>>>>>> b1cd7fc (.)
>>>>>>> 0b410a6 (.)
});

test('login listener uses correct log name for activities', function () {
    $user = User::factory()->create(); // @phpstan-ignore-line method.nonObject
    \assert($user instanceof User);
    $event = new Login('web', $user, false);
<<<<<<< HEAD
=======
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
>>>>>>> b1cd7fc (.)

    $listener = new LoginListener();
    $listener->handle($event);

    $activity = Activity::where('causer_id', $user->id)->first();
    \assert($activity instanceof Activity);

<<<<<<< HEAD
=======
=======
    
=======

>>>>>>> b93ef594b4 (.)
    $listener = new LoginListener();
    $listener->handle($event);

    $activity = Activity::where('causer_id', $user->id)->first();
<<<<<<< HEAD
    
>>>>>>> a12f125f4a (.)
=======

>>>>>>> b93ef594b4 (.)
=======
    
    $listener = new LoginListener();
    $listener->handle($event);
    
    $activity = Activity::where('causer_id', $user->id)->first();
    
>>>>>>> origin/develop
>>>>>>> b1cd7fc (.)
    expect($activity->log_name)->toBe('auth');
});

test('login listener handles event without user gracefully', function () {
    $event = new Login('web', null, false);
<<<<<<< HEAD
=======
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
>>>>>>> b1cd7fc (.)

    $listener = new LoginListener();

    expect(fn () => $listener->handle($event))->not->toThrow(Exception::class);

<<<<<<< HEAD
=======
=======
    
=======

>>>>>>> b93ef594b4 (.)
    $listener = new LoginListener();

    expect(fn() => $listener->handle($event))->not->toThrow(Exception::class);
<<<<<<< HEAD
    
>>>>>>> a12f125f4a (.)
=======

>>>>>>> b93ef594b4 (.)
=======
    
    $listener = new LoginListener();
    
    expect(fn() => $listener->handle($event))->not->toThrow(Exception::class);
    
>>>>>>> origin/develop
>>>>>>> b1cd7fc (.)
    $activities = Activity::where('event', 'login')->get();
    expect($activities)->toBeEmpty();
});

test('login listener creates unique activities for same user different sessions', function () {
<<<<<<< HEAD
    $user = User::factory()->create(); // @phpstan-ignore-line method.nonObject
    \assert($user instanceof User);
=======
    $user = User::factory()->create();
<<<<<<< HEAD
=======
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
>>>>>>> b1cd7fc (.)
>>>>>>> 0b410a6 (.)

    $event1 = new Login('web', $user, false);
    $event2 = new Login('web', $user, true);

    $listener = new LoginListener();
    $listener->handle($event1);
    $listener->handle($event2);

    $activities = Activity::where('causer_id', $user->id)->get();

    expect($activities)->toHaveCount(2);

    $firstActivity = $activities->first();
    \assert($firstActivity instanceof Activity);
    $lastActivity = $activities->last();
    \assert($lastActivity instanceof Activity);

    expect($firstActivity->properties['remember'])->toBeFalse();
    expect($lastActivity->properties['remember'])->toBeTrue();
    expect($firstActivity->id)->not->toBe($lastActivity->id);
});
<<<<<<< HEAD
=======
=======
    
=======

>>>>>>> b93ef594b4 (.)
    $event1 = new Login('web', $user, false);
    $event2 = new Login('web', $user, true);

    $listener = new LoginListener();
    $listener->handle($event1);
    $listener->handle($event2);

    $activities = Activity::where('causer_id', $user->id)->get();

    expect($activities)->toHaveCount(2);

    $firstActivity = $activities->first();
    $lastActivity = $activities->last();

    expect($firstActivity->properties['remember'])->toBeFalse();
    expect($lastActivity->properties['remember'])->toBeTrue();
    expect($firstActivity->id)->not->toBe($lastActivity->id);
});
<<<<<<< HEAD
>>>>>>> a12f125f4a (.)
=======
>>>>>>> b93ef594b4 (.)
=======
    
    $event1 = new Login('web', $user, false);
    $event2 = new Login('web', $user, true);
    
    $listener = new LoginListener();
    $listener->handle($event1);
    $listener->handle($event2);
    
    $activities = Activity::where('causer_id', $user->id)->get();
    
    expect($activities)->toHaveCount(2);
    
    $firstActivity = $activities->first();
    $lastActivity = $activities->last();
    
    expect($firstActivity->properties['remember'])->toBeFalse();
    expect($lastActivity->properties['remember'])->toBeTrue();
    expect($firstActivity->id)->not->toBe($lastActivity->id);
});
>>>>>>> origin/develop
>>>>>>> b1cd7fc (.)
