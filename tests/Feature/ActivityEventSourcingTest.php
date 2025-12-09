<?php

declare(strict_types=1);

use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Modules\Activity\Models\Activity;
use Modules\Activity\Models\Snapshot;
use Modules\Activity\Models\StoredEvent;
use Modules\User\Models\User;

test('activity event sourcing lifecycle works correctly', function (): void {
    /* @phpstan-ignore-next-line method.nonObject */
    $user = User::factory()->create();
    assert($user instanceof User);

    $activityData = [
        'log_name' => 'user_actions',
        'description' => 'User performed test action',
        'subject_type' => User::class,
        'subject_id' => $user->id,
        'causer_type' => User::class,
        'causer_id' => $user->id,
        'properties' => ['action' => 'test', 'result' => 'success'],
        'event' => 'created',
    ];

    $activity = Activity::create($activityData);

    expect($activity)->toBeInstanceOf(Activity::class);
    assert($activity instanceof Activity);

    expect($activity->log_name)->toBe('user_actions');
    expect($activity->description)->toBe('User performed test action');
    expect($activity->subject_type)->toBe(User::class);
    expect($activity->subject_id)->toBe($user->id);
    expect($activity->causer_type)->toBe(User::class);
    expect($activity->causer_id)->toBe($user->id);
    expect($activity->properties)->toHaveKey('action', 'test');
    expect($activity->properties)->toHaveKey('result', 'success');
    expect($activity->event)->toBe('created');
});

test('activity can be queried with complex scopes', function (): void {
    /** @var User $user1 */
    /* @phpstan-ignore-next-line method.nonObject */
    $user1 = User::factory()->create();
    assert($user1 instanceof User);
    /** @var User $user2 */
    /* @phpstan-ignore-next-line method.nonObject */
    $user2 = User::factory()->create();
    assert($user2 instanceof User);

    /** @var Activity $activity1 */
    /* @phpstan-ignore-next-line method.nonObject */
    $activity1 = Activity::factory()->create([
        'log_name' => 'security',
        'event' => 'login',
        'causer_type' => User::class,
        'causer_id' => $user1->id,
    ]);
    assert($activity1 instanceof Activity);

    /** @var Activity $activity2 */
    /* @phpstan-ignore-next-line method.nonObject */
    $activity2 = Activity::factory()->create([
        'log_name' => 'security',
        'event' => 'logout',
        'causer_type' => User::class,
        'causer_id' => $user2->id,
    ]);
    assert($activity2 instanceof Activity);

    /** @var Activity $activity3 */
    /* @phpstan-ignore-next-line method.nonObject */
    $activity3 = Activity::factory()->create([
        'log_name' => 'audit',
        'event' => 'update',
        'causer_type' => User::class,
        'causer_id' => $user1->id,
    ]);
    assert($activity3 instanceof Activity);

    $securityActivities = Activity::inLog('security')->get();
    $user1Activities = Activity::causedBy($user1)->get();
    $loginActivities = Activity::forEvent('login')->get();

    expect($securityActivities)->toHaveCount(2);
    expect($user1Activities)->toHaveCount(2);
    expect($loginActivities)->toHaveCount(1);

    $firstLogin = $loginActivities->first();
    expect($firstLogin)->toBeInstanceOf(Activity::class);
    if ($firstLogin instanceof Activity) {
        expect($firstLogin->id)->toBe($activity1->id);
    }
});

test('snapshot creation and retrieval works correctly', function (): void {
    $aggregateUuid = Str::uuid();

    $snapshotData = [
        'aggregate_uuid' => $aggregateUuid,
        'aggregate_version' => 5,
        'state' => [
            'balance' => 1000,
            'transactions' => [
                ['id' => 1, 'amount' => 100, 'type' => 'credit'],
                ['id' => 2, 'amount' => 50, 'type' => 'debit'],
            ],
            'status' => 'active',
        ],
    ];

    $snapshot = Snapshot::create($snapshotData);

    expect($snapshot)->toBeInstanceOf(Snapshot::class);
    assert($snapshot instanceof Snapshot);

    expect($snapshot->aggregate_uuid)->toBe($aggregateUuid);
    expect($snapshot->aggregate_version)->toBe(5);
    expect($snapshot->state)->toHaveKey('balance', 1000);
    expect($snapshot->state)->toHaveKey('status', 'active');
    expect($snapshot->state['transactions'] ?? [])->toHaveCount(2);

    $retrievedSnapshot = Snapshot::uuid((string) $aggregateUuid)->first();

    expect($retrievedSnapshot)->toBeInstanceOf(Snapshot::class);
    if ($retrievedSnapshot instanceof Snapshot) {
        expect($retrievedSnapshot->id)->toBe($snapshot->id);
    }
});

test('stored event creation and event reconstruction works', function (): void {
    $eventClass = 'App\\Events\\TestEvent';
    $aggregateUuid = Str::uuid();

    $eventProperties = [
        'user_id' => 1,
        'action' => 'test_action',
        'metadata' => [
            'ip' => '127.0.0.1',
            'user_agent' => 'Test Browser',
        ],
    ];

    $storedEvent = StoredEvent::create([
        'aggregate_uuid' => $aggregateUuid,
        'aggregate_version' => 1,
        'event_version' => 1,
        'event_class' => $eventClass,
        'event_properties' => $eventProperties,
        'meta_data' => ['processed' => true, 'retry_count' => 0],
    ]);

    expect($storedEvent)->toBeInstanceOf(StoredEvent::class);
    assert($storedEvent instanceof StoredEvent);

    expect($storedEvent->event_class)->toBe($eventClass);
    expect($storedEvent->aggregate_uuid)->toBe($aggregateUuid);
    expect($storedEvent->event_properties)->toHaveKey('user_id', 1);
    expect($storedEvent->event_properties)->toHaveKey('action', 'test_action');
    expect($storedEvent->meta_data['processed'] ?? null)->toBeTrue();
    expect($storedEvent->meta_data['retry_count'] ?? null)->toBe(0);
});

test('activity batch operations work correctly', function (): void {
    $batchUuid = Str::uuid();

    /* @phpstan-ignore-next-line method.nonObject */
    $factory = Activity::factory();
    assert($factory !== null);
    /* @phpstan-ignore-next-line method.nonObject */
    $createdActivities = $factory
        /* @phpstan-ignore-next-line method.nonObject */
        ->count(3)
        ->create([
            'batch_uuid' => $batchUuid,
            'log_name' => 'batch_operation',
        ]);
    assert($createdActivities instanceof \Illuminate\Database\Eloquent\Collection);

    $batchActivities = Activity::forBatch((string) $batchUuid)->get();

    expect($batchActivities)->toHaveCount(3);

    foreach ($batchActivities as $activity) {
        expect($activity)->toBeInstanceOf(Activity::class);
        if ($activity instanceof Activity) {
            expect($activity->batch_uuid)->toBe((string) $batchUuid);
            expect($activity->log_name)->toBe('batch_operation');
        }
    }
});

test('activity with batch scope returns correct results', function (): void {
    /** @var Activity $withBatch */
    /* @phpstan-ignore-next-line method.nonObject */
    $withBatch = Activity::factory()->create(['batch_uuid' => Str::uuid()]);
    assert($withBatch instanceof Activity);
    /** @var Activity $withoutBatch */
    /* @phpstan-ignore-next-line method.nonObject */
    $withoutBatch = Activity::factory()->create(['batch_uuid' => null]);
    assert($withoutBatch instanceof Activity);

    $activitiesWithBatch = Activity::hasBatch()->get();

    expect($activitiesWithBatch)->toHaveCount(1);

    $first = $activitiesWithBatch->first();
    expect($first)->toBeInstanceOf(Activity::class);
    if ($first instanceof Activity) {
        expect($first->id)->toBe($withBatch->id);
    }
});

test('activity properties support complex nested structures', function (): void {
    $complexProperties = [
        'user' => [
            'id' => 1,
            'name' => 'Test User',
            'roles' => ['admin', 'user'],
            'permissions' => ['read', 'write', 'delete'],
        ],
        'action' => 'complex_operation',
        'context' => [
            'request' => [
                'method' => 'POST',
                'url' => '/api/test',
                'headers' => ['Content-Type' => 'application/json'],
            ],
            'response' => [
                'status' => 200,
                'data' => ['success' => true, 'message' => 'Operation completed'],
            ],
        ],
        'timestamps' => [
            'started_at' => now()->subMinutes(5)->toISOString(),
            'completed_at' => now()->toISOString(),
            'duration' => 300,
        ],
    ];

    /** @var Activity $activity */
    /* @phpstan-ignore-next-line method.nonObject */
    $activity = Activity::factory()->create(['properties' => $complexProperties]);
    assert($activity instanceof Activity);

    $freshActivity = $activity->fresh();
    expect($freshActivity)->toBeInstanceOf(Activity::class);
    assert($freshActivity instanceof Activity);

    $properties = $freshActivity->properties;
    expect($properties)->toBeInstanceOf(Collection::class);
    expect($properties)->toHaveKey('user');
    expect($properties)->toHaveKey('action');
    expect($properties)->toHaveKey('context');
    expect($properties)->toHaveKey('timestamps');

    $user = $properties['user'] ?? null;
    expect($user)->toBeArray();
    expect($user)->toHaveKeys(['id', 'name', 'roles', 'permissions']);

    $context = $properties['context'] ?? null;
    expect($context)->toBeArray();
    expect($context)->toHaveKeys(['request', 'response']);

    $timestamps = $properties['timestamps'] ?? null;
    expect($timestamps)->toBeArray();
    expect($timestamps)->toHaveKeys(['started_at', 'completed_at', 'duration']);
});

test('snapshot state maintains data integrity with large datasets', function (): void {
    $largeState = [
        'users' => array_map(
            fn ($i) => [
                'id' => $i,
                'name' => "User {$i}",
                'email' => "user{$i}@example.com",
                'active' => ($i % 2) === 0,
                'preferences' => [
                    'theme' => ($i % 2) === 0 ? 'dark' : 'light',
                    'notifications' => true,
                    'language' => 'en',
                ],
            ],
            range(1, 100),
        ),
        'metadata' => [
            'generated_at' => now()->toISOString(),
            'version' => '1.0.0',
            'checksum' => md5('test'),
        ],
    ];

    /** @var Snapshot $snapshot */
    /* @phpstan-ignore-next-line method.nonObject */
    $snapshot = Snapshot::factory()->create(['state' => $largeState]);
    assert($snapshot instanceof Snapshot);

    $freshSnapshot = $snapshot->fresh();
    expect($freshSnapshot)->toBeInstanceOf(Snapshot::class);
    assert($freshSnapshot instanceof Snapshot);

    $state = $freshSnapshot->state;
    expect($state)->toBeArray();
    expect($state)->toHaveKey('users');
    expect($state)->toHaveKey('metadata');

    $users = $state['users'] ?? [];
    expect($users)->toHaveCount(100);

    $metadata = $state['metadata'] ?? null;
    expect($metadata)->toBeArray();
    expect($metadata)->toHaveKeys(['generated_at', 'version', 'checksum']);
});

test('stored event handles complex event properties with nested arrays', function (): void {
    $complexEvent = [
        'order' => [
            'id' => 12345,
            'items' => array_map(
                fn ($i) => [
                    'product_id' => $i,
                    'name' => "Product {$i}",
                    'quantity' => rand(1, 5),
                    'price' => rand(1000, 5000) / 100,
                    'attributes' => ['color' => 'red', 'size' => 'M'],
                ],
                range(1, 50),
            ),
            'totals' => [
                'subtotal' => 1234.56,
                'tax' => 123.46,
                'shipping' => 15.00,
                'total' => 1373.02,
            ],
        ],
        'customer' => [
            'id' => 67890,
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'address' => [
                'street' => '123 Main St',
                'city' => 'Anytown',
                'state' => 'CA',
                'zip' => '12345',
                'country' => 'US',
            ],
        ],
        'payment' => [
            'method' => 'credit_card',
            'transaction_id' => 'txn_123456789',
            'status' => 'completed',
            'amount' => 1373.02,
        ],
    ];

    /** @var StoredEvent $storedEvent */
    /* @phpstan-ignore-next-line method.nonObject */
    $storedEvent = StoredEvent::factory()->create(['event_properties' => $complexEvent]);
    assert($storedEvent instanceof StoredEvent);

    $freshStoredEvent = $storedEvent->fresh();
    expect($freshStoredEvent)->toBeInstanceOf(StoredEvent::class);
    assert($freshStoredEvent instanceof StoredEvent);

    $eventProperties = $freshStoredEvent->event_properties;
    expect($eventProperties)->toBeArray();
    expect($eventProperties)->toHaveKey('order');
    expect($eventProperties)->toHaveKey('customer');
    expect($eventProperties)->toHaveKey('payment');

    $order = $eventProperties['order'] ?? null;
    expect($order)->toBeArray();
    expect($order)->toHaveKeys(['id', 'items', 'totals']);

    $customer = $eventProperties['customer'] ?? null;
    expect($customer)->toBeArray();
    expect($customer)->toHaveKeys(['id', 'name', 'email', 'address']);

    $payment = $eventProperties['payment'] ?? null;
    expect($payment)->toBeArray();
    expect($payment)->toHaveKeys(['method', 'transaction_id', 'status', 'amount']);

    /** @var array<int, mixed> $items */
    /* @phpstan-ignore-next-line offsetAccess.nonOffsetAccessible */
    $items = $order['items'] ?? [];
    expect($items)->toHaveCount(50);
});
