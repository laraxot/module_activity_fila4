<?php

declare(strict_types=1);

<<<<<<< HEAD
use Illuminate\Support\Str;
use Illuminate\Support\Collection;
=======
<<<<<<< HEAD
use Illuminate\Support\Str;
use Illuminate\Support\Collection;
=======
>>>>>>> origin/develop
>>>>>>> b1cd7fc (.)
use Modules\Activity\Models\Activity;
use Modules\Activity\Models\Snapshot;
use Modules\Activity\Models\StoredEvent;
use Modules\User\Models\User;

test('activity event sourcing lifecycle works correctly', function () {
    $user = User::factory()->create();
<<<<<<< HEAD

=======
<<<<<<< HEAD

=======
    
>>>>>>> origin/develop
>>>>>>> b1cd7fc (.)
    $activityData = [
        'log_name' => 'user_actions',
        'description' => 'User performed test action',
        'subject_type' => User::class,
        'subject_id' => $user->id,
        'causer_type' => User::class,
        'causer_id' => $user->id,
        'properties' => ['action' => 'test', 'result' => 'success'],
<<<<<<< HEAD
        'event' => 'created',
=======
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
        'event' => 'created',
=======
        'event' => 'created'
>>>>>>> a12f125f4a (.)
=======
        'event' => 'created',
>>>>>>> b93ef594b4 (.)
>>>>>>> b1cd7fc (.)
    ];

    $activity = Activity::create($activityData);

<<<<<<< HEAD
=======
=======
        'event' => 'created'
    ];
    
    $activity = Activity::create($activityData);
    
>>>>>>> origin/develop
>>>>>>> b1cd7fc (.)
    expect($activity)
        ->toBeInstanceOf(Activity::class)
        ->log_name->toBe('user_actions')
        ->description->toBe('User performed test action')
        ->subject_type->toBe(User::class)
        ->subject_id->toBe($user->id)
        ->causer_type->toBe(User::class)
        ->causer_id->toBe($user->id)
        ->properties->toHaveKey('action', 'test')
        ->properties->toHaveKey('result', 'success')
        ->event->toBe('created');
});

test('activity can be queried with complex scopes', function () {
    $user1 = User::factory()->create();
    $user2 = User::factory()->create();
<<<<<<< HEAD

=======
<<<<<<< HEAD

=======
    
>>>>>>> origin/develop
>>>>>>> b1cd7fc (.)
    $activity1 = Activity::factory()->create([
        'log_name' => 'security',
        'event' => 'login',
        'causer_type' => User::class,
<<<<<<< HEAD
        'causer_id' => $user1->id,
    ]);

=======
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
        'causer_id' => $user1->id,
=======
        'causer_id' => $user1->id
>>>>>>> a12f125f4a (.)
=======
        'causer_id' => $user1->id,
>>>>>>> b93ef594b4 (.)
    ]);

=======
        'causer_id' => $user1->id
    ]);
    
>>>>>>> origin/develop
>>>>>>> b1cd7fc (.)
    $activity2 = Activity::factory()->create([
        'log_name' => 'security',
        'event' => 'logout',
        'causer_type' => User::class,
<<<<<<< HEAD
        'causer_id' => $user2->id,
    ]);

=======
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
        'causer_id' => $user2->id,
=======
        'causer_id' => $user2->id
>>>>>>> a12f125f4a (.)
=======
        'causer_id' => $user2->id,
>>>>>>> b93ef594b4 (.)
    ]);

=======
        'causer_id' => $user2->id
    ]);
    
>>>>>>> origin/develop
>>>>>>> b1cd7fc (.)
    $activity3 = Activity::factory()->create([
        'log_name' => 'audit',
        'event' => 'update',
        'causer_type' => User::class,
<<<<<<< HEAD
        'causer_id' => $user1->id,
=======
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
        'causer_id' => $user1->id,
=======
        'causer_id' => $user1->id
>>>>>>> a12f125f4a (.)
=======
        'causer_id' => $user1->id,
>>>>>>> b93ef594b4 (.)
>>>>>>> b1cd7fc (.)
    ]);

    $securityActivities = Activity::inLog('security')->get();
    $user1Activities = Activity::causedBy($user1)->get();
    $loginActivities = Activity::forEvent('login')->get();

<<<<<<< HEAD
=======
=======
        'causer_id' => $user1->id
    ]);
    
    $securityActivities = Activity::inLog('security')->get();
    $user1Activities = Activity::causedBy($user1)->get();
    $loginActivities = Activity::forEvent('login')->get();
    
>>>>>>> origin/develop
>>>>>>> b1cd7fc (.)
    expect($securityActivities)->toHaveCount(2);
    expect($user1Activities)->toHaveCount(2);
    expect($loginActivities)->toHaveCount(1)->first()->id->toBe($activity1->id);
});

test('snapshot creation and retrieval works correctly', function () {
<<<<<<< HEAD
    $aggregateUuid = Str::uuid();

=======
<<<<<<< HEAD
    $aggregateUuid = Str::uuid();

=======
    $aggregateUuid = \Illuminate\Support\Str::uuid();
    
>>>>>>> origin/develop
>>>>>>> b1cd7fc (.)
    $snapshotData = [
        'aggregate_uuid' => $aggregateUuid,
        'aggregate_version' => 5,
        'state' => [
            'balance' => 1000,
            'transactions' => [
                ['id' => 1, 'amount' => 100, 'type' => 'credit'],
<<<<<<< HEAD
=======
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
>>>>>>> b1cd7fc (.)
                ['id' => 2, 'amount' => 50, 'type' => 'debit'],
            ],
            'status' => 'active',
        ],
<<<<<<< HEAD
=======
=======
=======
>>>>>>> origin/develop
                ['id' => 2, 'amount' => 50, 'type' => 'debit']
            ],
            'status' => 'active'
        ]
<<<<<<< HEAD
>>>>>>> a12f125f4a (.)
=======
                ['id' => 2, 'amount' => 50, 'type' => 'debit'],
            ],
            'status' => 'active',
        ],
>>>>>>> b93ef594b4 (.)
>>>>>>> b1cd7fc (.)
    ];

    $snapshot = Snapshot::create($snapshotData);

<<<<<<< HEAD
=======
=======
    ];
    
    $snapshot = Snapshot::create($snapshotData);
    
>>>>>>> origin/develop
>>>>>>> b1cd7fc (.)
    expect($snapshot)
        ->aggregate_uuid->toBe($aggregateUuid)
        ->aggregate_version->toBe(5)
        ->state->toHaveKey('balance', 1000)
        ->state->toHaveKey('status', 'active')
        ->state->transactions->toHaveCount(2);
<<<<<<< HEAD

    $retrievedSnapshot = Snapshot::uuid($aggregateUuid)->first();

=======
<<<<<<< HEAD

    $retrievedSnapshot = Snapshot::uuid($aggregateUuid)->first();

=======
    
    $retrievedSnapshot = Snapshot::uuid($aggregateUuid)->first();
    
>>>>>>> origin/develop
>>>>>>> b1cd7fc (.)
    expect($retrievedSnapshot->id)->toBe($snapshot->id);
});

test('stored event creation and event reconstruction works', function () {
    $eventClass = 'App\\Events\\TestEvent';
<<<<<<< HEAD
    $aggregateUuid = Str::uuid();

=======
<<<<<<< HEAD
    $aggregateUuid = Str::uuid();

=======
    $aggregateUuid = \Illuminate\Support\Str::uuid();
    
>>>>>>> origin/develop
>>>>>>> b1cd7fc (.)
    $eventProperties = [
        'user_id' => 1,
        'action' => 'test_action',
        'metadata' => [
            'ip' => '127.0.0.1',
<<<<<<< HEAD
            'user_agent' => 'Test Browser',
        ],
    ];

=======
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
            'user_agent' => 'Test Browser',
        ],
=======
            'user_agent' => 'Test Browser'
        ]
>>>>>>> a12f125f4a (.)
=======
            'user_agent' => 'Test Browser',
        ],
>>>>>>> b93ef594b4 (.)
    ];

=======
            'user_agent' => 'Test Browser'
        ]
    ];
    
>>>>>>> origin/develop
>>>>>>> b1cd7fc (.)
    $storedEvent = StoredEvent::create([
        'aggregate_uuid' => $aggregateUuid,
        'aggregate_version' => 1,
        'event_version' => 1,
        'event_class' => $eventClass,
        'event_properties' => $eventProperties,
<<<<<<< HEAD
        'meta_data' => ['processed' => true, 'retry_count' => 0],
    ]);

=======
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
        'meta_data' => ['processed' => true, 'retry_count' => 0],
=======
        'meta_data' => ['processed' => true, 'retry_count' => 0]
>>>>>>> a12f125f4a (.)
=======
        'meta_data' => ['processed' => true, 'retry_count' => 0],
>>>>>>> b93ef594b4 (.)
    ]);

=======
        'meta_data' => ['processed' => true, 'retry_count' => 0]
    ]);
    
>>>>>>> origin/develop
>>>>>>> b1cd7fc (.)
    expect($storedEvent)
        ->event_class->toBe($eventClass)
        ->aggregate_uuid->toBe($aggregateUuid)
        ->event_properties->toHaveKey('user_id', 1)
        ->event_properties->toHaveKey('action', 'test_action')
        ->meta_data->processed->toBeTrue()
        ->meta_data->retry_count->toBe(0);
});

test('activity batch operations work correctly', function () {
<<<<<<< HEAD
    $batchUuid = Str::uuid();

=======
<<<<<<< HEAD
    $batchUuid = Str::uuid();

<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> b93ef594b4 (.)
>>>>>>> b1cd7fc (.)
    $activities = Activity::factory()
        ->count(3)
        ->create([
            'batch_uuid' => $batchUuid,
            'log_name' => 'batch_operation',
        ]);
<<<<<<< HEAD

    $batchActivities = Activity::forBatch($batchUuid)->get();

=======
<<<<<<< HEAD
=======
=======
    $batchUuid = \Illuminate\Support\Str::uuid();
    
>>>>>>> origin/develop
    $activities = Activity::factory()->count(3)->create([
        'batch_uuid' => $batchUuid,
        'log_name' => 'batch_operation'
    ]);
<<<<<<< HEAD
>>>>>>> a12f125f4a (.)
=======
>>>>>>> b93ef594b4 (.)

    $batchActivities = Activity::forBatch($batchUuid)->get();

=======
    
    $batchActivities = Activity::forBatch($batchUuid)->get();
    
>>>>>>> origin/develop
>>>>>>> b1cd7fc (.)
    expect($batchActivities)
        ->toHaveCount(3)
        ->each->batch_uuid->toBe($batchUuid)
        ->each->log_name->toBe('batch_operation');
});

test('activity with batch scope returns correct results', function () {
<<<<<<< HEAD
=======
<<<<<<< HEAD
>>>>>>> b1cd7fc (.)
    $withBatch = Activity::factory()->create(['batch_uuid' => Str::uuid()]);
    $withoutBatch = Activity::factory()->create(['batch_uuid' => null]);

    $activitiesWithBatch = Activity::hasBatch()->get();

<<<<<<< HEAD
    expect($activitiesWithBatch)->toHaveCount(1)->first()->id->toBe($withBatch->id);
=======
<<<<<<< HEAD
<<<<<<< HEAD
    expect($activitiesWithBatch)->toHaveCount(1)->first()->id->toBe($withBatch->id);
=======
    expect($activitiesWithBatch)
        ->toHaveCount(1)
        ->first()->id->toBe($withBatch->id);
>>>>>>> a12f125f4a (.)
=======
    expect($activitiesWithBatch)->toHaveCount(1)->first()->id->toBe($withBatch->id);
>>>>>>> b93ef594b4 (.)
=======
    $withBatch = Activity::factory()->create(['batch_uuid' => \Illuminate\Support\Str::uuid()]);
    $withoutBatch = Activity::factory()->create(['batch_uuid' => null]);
    
    $activitiesWithBatch = Activity::hasBatch()->get();
    
    expect($activitiesWithBatch)
        ->toHaveCount(1)
        ->first()->id->toBe($withBatch->id);
>>>>>>> origin/develop
>>>>>>> b1cd7fc (.)
});

test('activity properties support complex nested structures', function () {
    $complexProperties = [
        'user' => [
            'id' => 1,
            'name' => 'Test User',
            'roles' => ['admin', 'user'],
<<<<<<< HEAD
            'permissions' => ['read', 'write', 'delete'],
=======
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
            'permissions' => ['read', 'write', 'delete'],
=======
            'permissions' => ['read', 'write', 'delete']
>>>>>>> a12f125f4a (.)
=======
            'permissions' => ['read', 'write', 'delete'],
>>>>>>> b93ef594b4 (.)
=======
            'permissions' => ['read', 'write', 'delete']
>>>>>>> origin/develop
>>>>>>> b1cd7fc (.)
        ],
        'action' => 'complex_operation',
        'context' => [
            'request' => [
                'method' => 'POST',
                'url' => '/api/test',
<<<<<<< HEAD
=======
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
>>>>>>> b1cd7fc (.)
                'headers' => ['Content-Type' => 'application/json'],
            ],
            'response' => [
                'status' => 200,
                'data' => ['success' => true, 'message' => 'Operation completed'],
            ],
<<<<<<< HEAD
=======
=======
=======
>>>>>>> origin/develop
                'headers' => ['Content-Type' => 'application/json']
            ],
            'response' => [
                'status' => 200,
                'data' => ['success' => true, 'message' => 'Operation completed']
            ]
<<<<<<< HEAD
>>>>>>> a12f125f4a (.)
=======
                'headers' => ['Content-Type' => 'application/json'],
            ],
            'response' => [
                'status' => 200,
                'data' => ['success' => true, 'message' => 'Operation completed'],
            ],
>>>>>>> b93ef594b4 (.)
=======
>>>>>>> origin/develop
>>>>>>> b1cd7fc (.)
        ],
        'timestamps' => [
            'started_at' => now()->subMinutes(5)->toISOString(),
            'completed_at' => now()->toISOString(),
<<<<<<< HEAD
            'duration' => 300,
        ],
=======
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
            'duration' => 300,
        ],
=======
            'duration' => 300
        ]
>>>>>>> a12f125f4a (.)
=======
            'duration' => 300,
        ],
>>>>>>> b93ef594b4 (.)
>>>>>>> b1cd7fc (.)
    ];

    $activity = Activity::factory()->create(['properties' => $complexProperties]);

    expect($activity->fresh()->properties)
        ->toBeInstanceOf(Collection::class)
<<<<<<< HEAD
=======
=======
            'duration' => 300
        ]
    ];
    
    $activity = Activity::factory()->create(['properties' => $complexProperties]);
    
    expect($activity->fresh()->properties)
        ->toBeInstanceOf(\Illuminate\Support\Collection::class)
>>>>>>> origin/develop
>>>>>>> b1cd7fc (.)
        ->toHaveKey('user')
        ->toHaveKey('action')
        ->toHaveKey('context')
        ->toHaveKey('timestamps')
        ->user->toBeArray()->toHaveKeys(['id', 'name', 'roles', 'permissions'])
        ->context->toBeArray()->toHaveKeys(['request', 'response'])
        ->timestamps->toBeArray()->toHaveKeys(['started_at', 'completed_at', 'duration']);
});

test('snapshot state maintains data integrity with large datasets', function () {
    $largeState = [
<<<<<<< HEAD
=======
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> b93ef594b4 (.)
>>>>>>> b1cd7fc (.)
        'users' => array_map(
            fn($i) => [
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
<<<<<<< HEAD
=======
<<<<<<< HEAD
>>>>>>> b1cd7fc (.)
        'metadata' => [
            'generated_at' => now()->toISOString(),
            'version' => '1.0.0',
            'checksum' => md5('test'),
        ],
<<<<<<< HEAD
=======
=======
=======
>>>>>>> origin/develop
        'users' => array_map(fn($i) => [
            'id' => $i,
            'name' => "User {$i}",
            'email' => "user{$i}@example.com",
            'active' => $i % 2 === 0,
            'preferences' => [
                'theme' => $i % 2 === 0 ? 'dark' : 'light',
                'notifications' => true,
                'language' => 'en'
            ]
        ], range(1, 100)),
        'metadata' => [
            'generated_at' => now()->toISOString(),
            'version' => '1.0.0',
            'checksum' => md5('test')
        ]
<<<<<<< HEAD
>>>>>>> a12f125f4a (.)
=======
        'metadata' => [
            'generated_at' => now()->toISOString(),
            'version' => '1.0.0',
            'checksum' => md5('test'),
        ],
>>>>>>> b93ef594b4 (.)
>>>>>>> b1cd7fc (.)
    ];

    $snapshot = Snapshot::factory()->create(['state' => $largeState]);

<<<<<<< HEAD
=======
=======
    ];
    
    $snapshot = Snapshot::factory()->create(['state' => $largeState]);
    
>>>>>>> origin/develop
>>>>>>> b1cd7fc (.)
    expect($snapshot->fresh()->state)
        ->toBeArray()
        ->toHaveKey('users')
        ->toHaveKey('metadata')
        ->users->toHaveCount(100)
        ->metadata->toBeArray()->toHaveKeys(['generated_at', 'version', 'checksum']);
});

test('stored event handles complex event properties with nested arrays', function () {
    $complexEvent = [
        'order' => [
            'id' => 12345,
<<<<<<< HEAD
=======
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> b93ef594b4 (.)
>>>>>>> b1cd7fc (.)
            'items' => array_map(
                fn($i) => [
                    'product_id' => $i,
                    'name' => "Product {$i}",
                    'quantity' => rand(1, 5),
                    'price' => rand(1000, 5000) / 100,
                    'attributes' => ['color' => 'red', 'size' => 'M'],
                ],
                range(1, 50),
            ),
<<<<<<< HEAD
=======
<<<<<<< HEAD
=======
=======
>>>>>>> origin/develop
            'items' => array_map(fn($i) => [
                'product_id' => $i,
                'name' => "Product {$i}",
                'quantity' => rand(1, 5),
                'price' => rand(1000, 5000) / 100,
                'attributes' => ['color' => 'red', 'size' => 'M']
            ], range(1, 50)),
<<<<<<< HEAD
>>>>>>> a12f125f4a (.)
=======
>>>>>>> b93ef594b4 (.)
=======
>>>>>>> origin/develop
>>>>>>> b1cd7fc (.)
            'totals' => [
                'subtotal' => 1234.56,
                'tax' => 123.46,
                'shipping' => 15.00,
<<<<<<< HEAD
                'total' => 1373.02,
            ],
=======
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
                'total' => 1373.02,
            ],
=======
                'total' => 1373.02
            ]
>>>>>>> a12f125f4a (.)
=======
                'total' => 1373.02,
            ],
>>>>>>> b93ef594b4 (.)
=======
                'total' => 1373.02
            ]
>>>>>>> origin/develop
>>>>>>> b1cd7fc (.)
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
<<<<<<< HEAD
                'country' => 'US',
            ],
=======
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
                'country' => 'US',
            ],
=======
                'country' => 'US'
            ]
>>>>>>> a12f125f4a (.)
=======
                'country' => 'US',
            ],
>>>>>>> b93ef594b4 (.)
=======
                'country' => 'US'
            ]
>>>>>>> origin/develop
>>>>>>> b1cd7fc (.)
        ],
        'payment' => [
            'method' => 'credit_card',
            'transaction_id' => 'txn_123456789',
            'status' => 'completed',
<<<<<<< HEAD
            'amount' => 1373.02,
        ],
=======
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
            'amount' => 1373.02,
        ],
=======
            'amount' => 1373.02
        ]
>>>>>>> a12f125f4a (.)
=======
            'amount' => 1373.02,
        ],
>>>>>>> b93ef594b4 (.)
>>>>>>> b1cd7fc (.)
    ];

    $storedEvent = StoredEvent::factory()->create(['event_properties' => $complexEvent]);

<<<<<<< HEAD
=======
=======
            'amount' => 1373.02
        ]
    ];
    
    $storedEvent = StoredEvent::factory()->create(['event_properties' => $complexEvent]);
    
>>>>>>> origin/develop
>>>>>>> b1cd7fc (.)
    expect($storedEvent->fresh()->event_properties)
        ->toBeArray()
        ->toHaveKey('order')
        ->toHaveKey('customer')
        ->toHaveKey('payment')
        ->order->toBeArray()->toHaveKeys(['id', 'items', 'totals'])
        ->customer->toBeArray()->toHaveKeys(['id', 'name', 'email', 'address'])
        ->payment->toBeArray()->toHaveKeys(['method', 'transaction_id', 'status', 'amount'])
        ->order->items->toHaveCount(50);
<<<<<<< HEAD
});
=======
<<<<<<< HEAD
});
=======
});
>>>>>>> origin/develop
>>>>>>> b1cd7fc (.)
