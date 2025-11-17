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

    Event::assertListening(Login::class, LoginListener::class);
=======
    
    Event::assertListening(
        Login::class,
        LoginListener::class
    );
>>>>>>> 0a00ff2 (.)
=======

    Event::assertListening(Login::class, LoginListener::class);
>>>>>>> 18dcd64 (.)
});

test('login listener handles login event and creates activity', function () {
    $user = User::factory()->create();
    $event = new Login('web', $user, false);
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> 18dcd64 (.)

    $listener = new LoginListener;
    $listener->handle($event);

<<<<<<< HEAD
=======
    
    $listener = new LoginListener();
    $listener->handle($event);
    
>>>>>>> 0a00ff2 (.)
=======
>>>>>>> 18dcd64 (.)
    $activity = Activity::where('causer_type', User::class)
        ->where('causer_id', $user->id)
        ->where('event', 'login')
        ->first();
<<<<<<< HEAD
<<<<<<< HEAD

    expect($activity)
        ->not->toBeNull()
=======
    
    expect($activity)->not->toBeNull()
>>>>>>> 0a00ff2 (.)
=======

    expect($activity)
        ->not->toBeNull()
>>>>>>> 18dcd64 (.)
        ->description->toContain('login')
        ->causer_id->toBe($user->id)
        ->causer_type->toBe(User::class)
        ->properties->toHaveKey('guard', 'web');
});

test('login listener creates activity with correct properties', function () {
    $user = User::factory()->create();
    $event = new Login('api', $user, true);
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> 18dcd64 (.)

    $listener = new LoginListener;
    $listener->handle($event);

    $activity = Activity::where('causer_id', $user->id)->latest()->first();

<<<<<<< HEAD
=======
    
    $listener = new LoginListener();
    $listener->handle($event);
    
    $activity = Activity::where('causer_id', $user->id)->latest()->first();
    
>>>>>>> 0a00ff2 (.)
=======
>>>>>>> 18dcd64 (.)
    expect($activity->properties)
        ->toHaveKey('guard', 'api')
        ->toHaveKey('remember', true)
        ->toHaveKey('ip_address')
        ->toHaveKey('user_agent');
});

test('login listener handles multiple login events correctly', function () {
    $user1 = User::factory()->create();
    $user2 = User::factory()->create();
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> 18dcd64 (.)

    $event1 = new Login('web', $user1, false);
    $event2 = new Login('api', $user2, true);

    $listener = new LoginListener;
    $listener->handle($event1);
    $listener->handle($event2);

    $activities = Activity::whereIn('causer_id', [$user1->id, $user2->id])->get();

    expect($activities)->toHaveCount(2);

    $user1Activity = $activities->where('causer_id', $user1->id)->first();
    $user2Activity = $activities->where('causer_id', $user2->id)->first();

<<<<<<< HEAD
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
    
>>>>>>> 0a00ff2 (.)
=======
>>>>>>> 18dcd64 (.)
    expect($user1Activity->properties['guard'])->toBe('web');
    expect($user2Activity->properties['guard'])->toBe('api');
    expect($user1Activity->properties['remember'])->toBeFalse();
    expect($user2Activity->properties['remember'])->toBeTrue();
});

test('login listener includes request information in activity properties', function () {
    $user = User::factory()->create();
    $event = new Login('web', $user, false);
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> 18dcd64 (.)

    $listener = new LoginListener;
    $listener->handle($event);

    $activity = Activity::where('causer_id', $user->id)->first();

    expect($activity->properties)->toHaveKey('ip_address')->toHaveKey('user_agent')->toHaveKey('timestamp');
<<<<<<< HEAD
=======
    
    $listener = new LoginListener();
    $listener->handle($event);
    
    $activity = Activity::where('causer_id', $user->id)->first();
    
    expect($activity->properties)
        ->toHaveKey('ip_address')
        ->toHaveKey('user_agent')
        ->toHaveKey('timestamp');
>>>>>>> 0a00ff2 (.)
=======
>>>>>>> 18dcd64 (.)
});

test('login listener uses correct log name for activities', function () {
    $user = User::factory()->create();
    $event = new Login('web', $user, false);
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> 18dcd64 (.)

    $listener = new LoginListener;
    $listener->handle($event);

    $activity = Activity::where('causer_id', $user->id)->first();

<<<<<<< HEAD
=======
    
    $listener = new LoginListener();
    $listener->handle($event);
    
    $activity = Activity::where('causer_id', $user->id)->first();
    
>>>>>>> 0a00ff2 (.)
=======
>>>>>>> 18dcd64 (.)
    expect($activity->log_name)->toBe('auth');
});

test('login listener handles event without user gracefully', function () {
    $event = new Login('web', null, false);
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> 18dcd64 (.)

    $listener = new LoginListener;

    expect(fn () => $listener->handle($event))->not->toThrow(Exception::class);

<<<<<<< HEAD
=======
    
    $listener = new LoginListener();
    
    expect(fn() => $listener->handle($event))->not->toThrow(Exception::class);
    
>>>>>>> 0a00ff2 (.)
=======
>>>>>>> 18dcd64 (.)
    $activities = Activity::where('event', 'login')->get();
    expect($activities)->toBeEmpty();
});

test('login listener creates unique activities for same user different sessions', function () {
    $user = User::factory()->create();
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> 18dcd64 (.)

    $event1 = new Login('web', $user, false);
    $event2 = new Login('web', $user, true);

    $listener = new LoginListener;
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
>>>>>>> 0a00ff2 (.)
=======
>>>>>>> 18dcd64 (.)
