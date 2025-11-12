<?php

declare(strict_types=1);

use Illuminate\Support\Str;
use Modules\Activity\Models\StoredEvent;
use Modules\Activity\Tests\TestCase;

use function Safe\json_decode;
use function Safe\json_encode;

uses(TestCase::class);

test('it can create stored event with basic information', function (): void {
    $eventData = [
        'aggregate_uuid' => Str::uuid()->toString(),
        'aggregate_version' => 1,
        'event_version' => 1,
        'event_class' => 'App\Events\UserCreated',
        'event_properties' => json_encode([
            'user_id' => 123,
            'name' => 'John Doe',
            'email' => 'john@example.com',
        ]),
        'meta_data' => json_encode([
            'source' => 'web_registration',
            'ip_address' => '192.168.1.1',
        ]),
    ];

    /** @var StoredEvent */
    $storedEvent = StoredEvent::create($eventData);

    expect($storedEvent->aggregate_uuid)->toBe($eventData['aggregate_uuid'])
        ->and($storedEvent->aggregate_version)->toBe(1)
        ->and($storedEvent->event_version)->toBe(1)
        ->and($storedEvent->event_class)->toBe('App\Events\UserCreated');

    // Clean up
    $storedEvent->delete();
});

test('it can create stored event with complex properties', function (): void {
    $complexProperties = [
        'order_data' => [
            'order_id' => 'ORD-12345',
            'customer' => [
                'id' => 456,
                'name' => 'Jane Smith',
                'email' => 'jane@example.com',
                'phone' => '+1234567890',
            ],
            'items' => [
                [
                    'product_id' => 789,
                    'name' => 'Product A',
                    'quantity' => 2,
                    'unit_price' => 25.99,
                    'total_price' => 51.98,
                ],
            ],
            'totals' => [
                'subtotal' => 67.48,
                'tax' => 6.75,
                'shipping' => 5.99,
                'total' => 80.22,
            ],
        ],
    ];

    /** @var StoredEvent */
    $storedEvent = StoredEvent::create([
        'aggregate_uuid' => Str::uuid()->toString(),
        'aggregate_version' => 5,
        'event_version' => 2,
        'event_class' => 'App\Events\OrderPlaced',
        'event_properties' => json_encode($complexProperties),
        'meta_data' => json_encode([
            'timestamp' => now()->toISOString(),
            'user_id' => 456,
        ]),
    ]);

    $properties = json_decode($storedEvent->event_properties, true);

    expect($storedEvent->aggregate_version)->toBe(5)
        ->and($storedEvent->event_version)->toBe(2)
        ->and($properties['order_data']['order_id'])->toBe('ORD-12345')
        ->and($properties['order_data']['customer']['name'])->toBe('Jane Smith')
        ->and($properties['order_data']['totals']['total'])->toBe(80.22);

    // Clean up
    $storedEvent->delete();
});

test('it can manage event versioning', function (): void {
    $aggregateUuid = Str::uuid()->toString();

    /** @var StoredEvent */
    $event1 = StoredEvent::create([
        'aggregate_uuid' => $aggregateUuid,
        'aggregate_version' => 1,
        'event_version' => 1,
        'event_class' => 'App\Events\Test',
        'event_properties' => json_encode(['version' => 1]),
    ]);

    /** @var StoredEvent */
    $event2 = StoredEvent::create([
        'aggregate_uuid' => $aggregateUuid,
        'aggregate_version' => 2,
        'event_version' => 1,
        'event_class' => 'App\Events\Test',
        'event_properties' => json_encode(['version' => 2]),
    ]);

    expect($event1->aggregate_uuid)->toBe($aggregateUuid)
        ->and($event2->aggregate_uuid)->toBe($aggregateUuid)
        ->and($event1->aggregate_version)->toBe(1)
        ->and($event2->aggregate_version)->toBe(2);

    // Clean up
    $event1->delete();
    $event2->delete();
});

test('it can query events by aggregate uuid', function (): void {
    $uuid1 = Str::uuid()->toString();
    $uuid2 = Str::uuid()->toString();

    $e1 = StoredEvent::create([
        'aggregate_uuid' => $uuid1,
        'aggregate_version' => 1,
        'event_version' => 1,
        'event_class' => 'App\Events\Test',
        'event_properties' => json_encode([]),
    ]);

    $e2 = StoredEvent::create([
        'aggregate_uuid' => $uuid1,
        'aggregate_version' => 2,
        'event_version' => 1,
        'event_class' => 'App\Events\Test',
        'event_properties' => json_encode([]),
    ]);

    $e3 = StoredEvent::create([
        'aggregate_uuid' => $uuid2,
        'aggregate_version' => 1,
        'event_version' => 1,
        'event_class' => 'App\Events\Test',
        'event_properties' => json_encode([]),
    ]);

    $events1 = StoredEvent::where('aggregate_uuid', $uuid1)->get();
    $events2 = StoredEvent::where('aggregate_uuid', $uuid2)->get();

    expect($events1)->toHaveCount(2)
        ->and($events2)->toHaveCount(1)
        ->and($events1->first()->aggregate_uuid)->toBe($uuid1)
        ->and($events2->first()->aggregate_uuid)->toBe($uuid2);

    // Clean up
    $e1->delete();
    $e2->delete();
    $e3->delete();
});

test('it can handle event with empty properties', function (): void {
    /** @var StoredEvent */
    $event = StoredEvent::create([
        'aggregate_uuid' => Str::uuid()->toString(),
        'aggregate_version' => 1,
        'event_version' => 1,
        'event_class' => 'App\Events\Test',
        'event_properties' => json_encode([]),
    ]);

    $properties = json_decode($event->event_properties, true);
    expect($properties)->toBeArray()->and($properties)->toBeEmpty();

    // Clean up
    $event->delete();
});

test('it can handle event with metadata', function (): void {
    $metaData = [
        'ip_address' => '192.168.1.100',
        'user_agent' => 'Mozilla/5.0',
        'session_id' => Str::random(40),
        'user_id' => 789,
    ];

    /** @var StoredEvent */
    $event = StoredEvent::create([
        'aggregate_uuid' => Str::uuid()->toString(),
        'aggregate_version' => 1,
        'event_version' => 1,
        'event_class' => 'App\Events\Test',
        'event_properties' => json_encode(['test' => 'data']),
        'meta_data' => json_encode($metaData),
    ]);

    $meta = json_decode($event->meta_data, true);
    expect($meta)->toBeArray()
        ->and($meta['ip_address'])->toBe('192.168.1.100')
        ->and($meta['user_id'])->toBe(789);

    // Clean up
    $event->delete();
});

test('it can query events by event class', function (): void {
    $e1 = StoredEvent::create([
        'aggregate_uuid' => Str::uuid()->toString(),
        'aggregate_version' => 1,
        'event_version' => 1,
        'event_class' => 'App\Events\UserCreated',
        'event_properties' => json_encode([]),
    ]);

    $e2 = StoredEvent::create([
        'aggregate_uuid' => Str::uuid()->toString(),
        'aggregate_version' => 1,
        'event_version' => 1,
        'event_class' => 'App\Events\UserUpdated',
        'event_properties' => json_encode([]),
    ]);

    $createdEvents = StoredEvent::where('event_class', 'App\Events\UserCreated')->get();
    $updatedEvents = StoredEvent::where('event_class', 'App\Events\UserUpdated')->get();

    expect($createdEvents)->toHaveCount(1)
        ->and($updatedEvents)->toHaveCount(1)
        ->and($createdEvents->first()->event_class)->toBe('App\Events\UserCreated')
        ->and($updatedEvents->first()->event_class)->toBe('App\Events\UserUpdated');

    // Clean up
    $e1->delete();
    $e2->delete();
});

test('it can handle events with timestamps', function (): void {
    $now = now();

    /** @var StoredEvent */
    $event = StoredEvent::create([
        'aggregate_uuid' => Str::uuid()->toString(),
        'aggregate_version' => 1,
        'event_version' => 1,
        'event_class' => 'App\Events\Test',
        'event_properties' => json_encode(['created_at' => $now->toISOString()]),
        'created_at' => $now,
    ]);

    expect($event->created_at->timestamp)->toBe($now->timestamp);

    // Clean up
    $event->delete();
});
