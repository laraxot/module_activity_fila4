<?php

declare(strict_types=1);

<<<<<<< HEAD
use Illuminate\Support\Str;
=======
<<<<<<< HEAD
use Illuminate\Support\Str;
=======
>>>>>>> origin/develop
>>>>>>> b1cd7fc (.)
use Modules\Activity\Models\Activity;
use Modules\Activity\Models\Snapshot;
use Modules\Activity\Models\StoredEvent;
use Modules\User\Models\User;

test('activity module models work together in integrated scenarios', function () {
    $user = User::factory()->create();
<<<<<<< HEAD

=======
<<<<<<< HEAD

=======
    
>>>>>>> origin/develop
>>>>>>> b1cd7fc (.)
    $activity = Activity::factory()->create([
        'causer_type' => User::class,
        'causer_id' => $user->id,
        'subject_type' => User::class,
        'subject_id' => $user->id,
        'properties' => [
            'action' => 'user_registration',
<<<<<<< HEAD
            'details' => ['source' => 'web', 'campaign' => 'test'],
        ],
=======
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
            'details' => ['source' => 'web', 'campaign' => 'test'],
        ],
=======
            'details' => ['source' => 'web', 'campaign' => 'test']
        ]
>>>>>>> a12f125f4a (.)
=======
            'details' => ['source' => 'web', 'campaign' => 'test'],
        ],
>>>>>>> b93ef594b4 (.)
>>>>>>> b1cd7fc (.)
    ]);

    $aggregateUuid = Str::uuid();

<<<<<<< HEAD
=======
=======
            'details' => ['source' => 'web', 'campaign' => 'test']
        ]
    ]);
    
    $aggregateUuid = \Illuminate\Support\Str::uuid();
    
>>>>>>> origin/develop
>>>>>>> b1cd7fc (.)
    $snapshot = Snapshot::factory()->create([
        'aggregate_uuid' => $aggregateUuid,
        'state' => [
            'user' => $user->toArray(),
            'activities' => [$activity->toArray()],
<<<<<<< HEAD
            'metadata' => ['version' => '1.0.0'],
        ],
    ]);

=======
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
            'metadata' => ['version' => '1.0.0'],
        ],
=======
            'metadata' => ['version' => '1.0.0']
        ]
>>>>>>> a12f125f4a (.)
=======
            'metadata' => ['version' => '1.0.0'],
        ],
>>>>>>> b93ef594b4 (.)
    ]);

=======
            'metadata' => ['version' => '1.0.0']
        ]
    ]);
    
>>>>>>> origin/develop
>>>>>>> b1cd7fc (.)
    $storedEvent = StoredEvent::factory()->create([
        'aggregate_uuid' => $aggregateUuid,
        'event_class' => 'App\\Events\\UserProfileUpdated',
        'event_properties' => [
            'user_id' => $user->id,
            'activity_id' => $activity->id,
            'snapshot_id' => $snapshot->id,
<<<<<<< HEAD
            'changes' => ['profile_completed' => true],
        ],
=======
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
            'changes' => ['profile_completed' => true],
        ],
=======
            'changes' => ['profile_completed' => true]
        ]
>>>>>>> a12f125f4a (.)
=======
            'changes' => ['profile_completed' => true],
        ],
>>>>>>> b93ef594b4 (.)
>>>>>>> b1cd7fc (.)
    ]);

    expect($activity->causer->id)->toBe($user->id);
    expect($snapshot->state['user']['id'])->toBe($user->id);
    expect($storedEvent->event_properties['user_id'])->toBe($user->id);

    $relatedActivities = Activity::causedBy($user)->get();
    expect($relatedActivities)->toContain($activity);

    $relatedSnapshots = Snapshot::uuid($aggregateUuid)->get();
    expect($relatedSnapshots)->toContain($snapshot);

<<<<<<< HEAD
=======
=======
            'changes' => ['profile_completed' => true]
        ]
    ]);
    
    expect($activity->causer->id)->toBe($user->id);
    expect($snapshot->state['user']['id'])->toBe($user->id);
    expect($storedEvent->event_properties['user_id'])->toBe($user->id);
    
    $relatedActivities = Activity::causedBy($user)->get();
    expect($relatedActivities)->toContain($activity);
    
    $relatedSnapshots = Snapshot::uuid($aggregateUuid)->get();
    expect($relatedSnapshots)->toContain($snapshot);
    
>>>>>>> origin/develop
>>>>>>> b1cd7fc (.)
    $relatedEvents = StoredEvent::whereAggregateUuid($aggregateUuid)->get();
    expect($relatedEvents)->toContain($storedEvent);
});

test('activity batch processing with multiple models', function () {
<<<<<<< HEAD
=======
<<<<<<< HEAD
>>>>>>> b1cd7fc (.)
    $batchUuid = Str::uuid();
    $aggregateUuid = Str::uuid();

    $user = User::factory()->create();

<<<<<<< HEAD
=======
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> b93ef594b4 (.)
>>>>>>> b1cd7fc (.)
    $activities = Activity::factory()
        ->count(5)
        ->create([
            'batch_uuid' => $batchUuid,
            'causer_type' => User::class,
            'causer_id' => $user->id,
        ]);
<<<<<<< HEAD

=======
<<<<<<< HEAD
=======
=======
    $batchUuid = \Illuminate\Support\Str::uuid();
    $aggregateUuid = \Illuminate\Support\Str::uuid();
    
    $user = User::factory()->create();
    
>>>>>>> origin/develop
    $activities = Activity::factory()->count(5)->create([
        'batch_uuid' => $batchUuid,
        'causer_type' => User::class,
        'causer_id' => $user->id
    ]);
<<<<<<< HEAD
>>>>>>> a12f125f4a (.)
=======
>>>>>>> b93ef594b4 (.)

=======
    
>>>>>>> origin/develop
>>>>>>> b1cd7fc (.)
    $snapshot = Snapshot::factory()->create([
        'aggregate_uuid' => $aggregateUuid,
        'state' => [
            'batch_id' => $batchUuid,
            'activities_count' => $activities->count(),
<<<<<<< HEAD
=======
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
>>>>>>> b1cd7fc (.)
            'user_id' => $user->id,
        ],
    ]);

    $storedEvents = StoredEvent::factory()
        ->count(3)
        ->create([
            'aggregate_uuid' => $aggregateUuid,
            'event_properties' => [
                'batch_id' => $batchUuid,
                'processed_activities' => $activities->pluck('id')->toArray(),
            ],
        ]);
<<<<<<< HEAD
=======
=======
            'user_id' => $user->id
        ]
    ]);

=======
            'user_id' => $user->id
        ]
    ]);
    
>>>>>>> origin/develop
    $storedEvents = StoredEvent::factory()->count(3)->create([
        'aggregate_uuid' => $aggregateUuid,
        'event_properties' => [
            'batch_id' => $batchUuid,
            'processed_activities' => $activities->pluck('id')->toArray()
        ]
    ]);
<<<<<<< HEAD
>>>>>>> a12f125f4a (.)
=======
            'user_id' => $user->id,
        ],
    ]);

    $storedEvents = StoredEvent::factory()
        ->count(3)
        ->create([
            'aggregate_uuid' => $aggregateUuid,
            'event_properties' => [
                'batch_id' => $batchUuid,
                'processed_activities' => $activities->pluck('id')->toArray(),
            ],
        ]);
>>>>>>> b93ef594b4 (.)
>>>>>>> b1cd7fc (.)

    $batchActivities = Activity::forBatch($batchUuid)->get();
    expect($batchActivities)->toHaveCount(5);

    $snapshotState = $snapshot->fresh()->state;
    expect($snapshotState['activities_count'])->toBe(5);
    expect($snapshotState['user_id'])->toBe($user->id);

    $aggregateEvents = StoredEvent::whereAggregateUuid($aggregateUuid)->get();
    expect($aggregateEvents)->toHaveCount(3);

<<<<<<< HEAD
=======
=======
    
    $batchActivities = Activity::forBatch($batchUuid)->get();
    expect($batchActivities)->toHaveCount(5);
    
    $snapshotState = $snapshot->fresh()->state;
    expect($snapshotState['activities_count'])->toBe(5);
    expect($snapshotState['user_id'])->toBe($user->id);
    
    $aggregateEvents = StoredEvent::whereAggregateUuid($aggregateUuid)->get();
    expect($aggregateEvents)->toHaveCount(3);
    
>>>>>>> origin/develop
>>>>>>> b1cd7fc (.)
    $firstEvent = $aggregateEvents->first();
    expect($firstEvent->event_properties['batch_id'])->toBe($batchUuid);
});

test('activity module handles concurrent operations correctly', function () {
    $user = User::factory()->create();
<<<<<<< HEAD
=======
<<<<<<< HEAD
>>>>>>> b1cd7fc (.)

    $concurrentActivities = [];
    $concurrentSnapshots = [];

    $promises = [];

<<<<<<< HEAD
=======
=======
    
    $concurrentActivities = [];
    $concurrentSnapshots = [];
    
    $promises = [];
    
>>>>>>> origin/develop
>>>>>>> b1cd7fc (.)
    for ($i = 0; $i < 10; $i++) {
        $promises[] = function () use ($user, &$concurrentActivities, &$concurrentSnapshots, $i) {
            $activity = Activity::factory()->create([
                'causer_type' => User::class,
                'causer_id' => $user->id,
<<<<<<< HEAD
                'properties' => ['iteration' => $i, 'timestamp' => now()->toISOString()],
=======
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
                'properties' => ['iteration' => $i, 'timestamp' => now()->toISOString()],
=======
                'properties' => ['iteration' => $i, 'timestamp' => now()->toISOString()]
>>>>>>> a12f125f4a (.)
=======
                'properties' => ['iteration' => $i, 'timestamp' => now()->toISOString()],
>>>>>>> b93ef594b4 (.)
>>>>>>> b1cd7fc (.)
            ]);

            $concurrentActivities[] = $activity->id;

<<<<<<< HEAD
            if (($i % 2) === 0) {
=======
<<<<<<< HEAD
<<<<<<< HEAD
            if (($i % 2) === 0) {
=======
            if ($i % 2 === 0) {
>>>>>>> a12f125f4a (.)
=======
            if (($i % 2) === 0) {
>>>>>>> b93ef594b4 (.)
=======
                'properties' => ['iteration' => $i, 'timestamp' => now()->toISOString()]
            ]);
            
            $concurrentActivities[] = $activity->id;
            
            if ($i % 2 === 0) {
>>>>>>> origin/develop
>>>>>>> b1cd7fc (.)
                $snapshot = Snapshot::factory()->create([
                    'state' => [
                        'activity_id' => $activity->id,
                        'iteration' => $i,
<<<<<<< HEAD
                        'user_id' => $user->id,
                    ],
=======
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
                        'user_id' => $user->id,
                    ],
=======
                        'user_id' => $user->id
                    ]
>>>>>>> a12f125f4a (.)
=======
                        'user_id' => $user->id,
                    ],
>>>>>>> b93ef594b4 (.)
>>>>>>> b1cd7fc (.)
                ]);

                $concurrentSnapshots[] = $snapshot->id;
            }

            return true;
        };
    }

    $results = array_map(fn($promise) => $promise(), $promises);

    expect($results)->toHaveCount(10)->each->toBeTrue();

    $userActivities = Activity::causedBy($user)->get();
    expect($userActivities)->toHaveCount(10);

<<<<<<< HEAD
=======
=======
                        'user_id' => $user->id
                    ]
                ]);
                
                $concurrentSnapshots[] = $snapshot->id;
            }
            
            return true;
        };
    }
    
    $results = array_map(fn($promise) => $promise(), $promises);
    
    expect($results)->toHaveCount(10)->each->toBeTrue();
    
    $userActivities = Activity::causedBy($user)->get();
    expect($userActivities)->toHaveCount(10);
    
>>>>>>> origin/develop
>>>>>>> b1cd7fc (.)
    $createdSnapshots = Snapshot::whereIn('id', $concurrentSnapshots)->get();
    expect($createdSnapshots)->toHaveCount(5);
});

test('activity module supports complex query patterns', function () {
    $user1 = User::factory()->create();
    $user2 = User::factory()->create();
<<<<<<< HEAD

=======
<<<<<<< HEAD

<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> b93ef594b4 (.)
>>>>>>> b1cd7fc (.)
    $securityActivities = Activity::factory()
        ->count(3)
        ->create([
            'log_name' => 'security',
            'causer_type' => User::class,
            'causer_id' => $user1->id,
        ]);
<<<<<<< HEAD
=======
<<<<<<< HEAD
>>>>>>> b1cd7fc (.)

    $auditActivities = Activity::factory()
        ->count(2)
        ->create([
            'log_name' => 'audit',
            'causer_type' => User::class,
            'causer_id' => $user2->id,
        ]);

    $applicationActivities = Activity::factory()
        ->count(4)
        ->create([
            'log_name' => 'application',
            'causer_type' => User::class,
            'causer_id' => $user1->id,
        ]);
<<<<<<< HEAD

=======
=======
=======
    
>>>>>>> origin/develop
    $securityActivities = Activity::factory()->count(3)->create([
        'log_name' => 'security',
        'causer_type' => User::class,
        'causer_id' => $user1->id
    ]);
<<<<<<< HEAD
=======
>>>>>>> b93ef594b4 (.)

    $auditActivities = Activity::factory()
        ->count(2)
        ->create([
            'log_name' => 'audit',
            'causer_type' => User::class,
            'causer_id' => $user2->id,
        ]);

<<<<<<< HEAD
=======
    
    $auditActivities = Activity::factory()->count(2)->create([
        'log_name' => 'audit',
        'causer_type' => User::class,
        'causer_id' => $user2->id
    ]);
    
>>>>>>> origin/develop
    $applicationActivities = Activity::factory()->count(4)->create([
        'log_name' => 'application',
        'causer_type' => User::class,
        'causer_id' => $user1->id
    ]);
<<<<<<< HEAD
>>>>>>> a12f125f4a (.)
=======
    $applicationActivities = Activity::factory()
        ->count(4)
        ->create([
            'log_name' => 'application',
            'causer_type' => User::class,
            'causer_id' => $user1->id,
        ]);
>>>>>>> b93ef594b4 (.)

=======
    
>>>>>>> origin/develop
>>>>>>> b1cd7fc (.)
    $complexQuery = Activity::query()
        ->where('causer_type', User::class)
        ->whereIn('log_name', ['security', 'audit'])
        ->where(function ($query) use ($user1, $user2) {
<<<<<<< HEAD
            $query->where('causer_id', $user1->id)->orWhere('causer_id', $user2->id);
=======
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
            $query->where('causer_id', $user1->id)->orWhere('causer_id', $user2->id);
=======
            $query->where('causer_id', $user1->id)
                  ->orWhere('causer_id', $user2->id);
>>>>>>> a12f125f4a (.)
=======
            $query->where('causer_id', $user1->id)->orWhere('causer_id', $user2->id);
>>>>>>> b93ef594b4 (.)
>>>>>>> b1cd7fc (.)
        })
        ->orderBy('created_at', 'desc');

    $results = $complexQuery->get();

    expect($results)->toHaveCount(5);

    $securityResults = $results->where('log_name', 'security');
    $auditResults = $results->where('log_name', 'audit');

    expect($securityResults)->toHaveCount(3);
    expect($auditResults)->toHaveCount(2);

    $user1Results = $results->where('causer_id', $user1->id);
    $user2Results = $results->where('causer_id', $user2->id);

<<<<<<< HEAD
=======
=======
            $query->where('causer_id', $user1->id)
                  ->orWhere('causer_id', $user2->id);
        })
        ->orderBy('created_at', 'desc');
    
    $results = $complexQuery->get();
    
    expect($results)->toHaveCount(5);
    
    $securityResults = $results->where('log_name', 'security');
    $auditResults = $results->where('log_name', 'audit');
    
    expect($securityResults)->toHaveCount(3);
    expect($auditResults)->toHaveCount(2);
    
    $user1Results = $results->where('causer_id', $user1->id);
    $user2Results = $results->where('causer_id', $user2->id);
    
>>>>>>> origin/develop
>>>>>>> b1cd7fc (.)
    expect($user1Results)->toHaveCount(3);
    expect($user2Results)->toHaveCount(2);
});

test('activity module handles data consistency across models', function () {
    $user = User::factory()->create();
<<<<<<< HEAD
=======
<<<<<<< HEAD
>>>>>>> b1cd7fc (.)
    $aggregateUuid = Str::uuid();

    $activity = Activity::factory()->create([
        'causer_type' => User::class,
        'causer_id' => $user->id,
<<<<<<< HEAD
        'properties' => ['action' => 'data_consistency_test'],
    ]);

=======
<<<<<<< HEAD
<<<<<<< HEAD
        'properties' => ['action' => 'data_consistency_test'],
=======
        'properties' => ['action' => 'data_consistency_test']
>>>>>>> a12f125f4a (.)
=======
        'properties' => ['action' => 'data_consistency_test'],
>>>>>>> b93ef594b4 (.)
    ]);

=======
    $aggregateUuid = \Illuminate\Support\Str::uuid();
    
    $activity = Activity::factory()->create([
        'causer_type' => User::class,
        'causer_id' => $user->id,
        'properties' => ['action' => 'data_consistency_test']
    ]);
    
>>>>>>> origin/develop
>>>>>>> b1cd7fc (.)
    $snapshot = Snapshot::factory()->create([
        'aggregate_uuid' => $aggregateUuid,
        'state' => [
            'activity_id' => $activity->id,
            'user_id' => $user->id,
<<<<<<< HEAD
            'consistent' => true,
        ],
    ]);

=======
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
            'consistent' => true,
        ],
=======
            'consistent' => true
        ]
>>>>>>> a12f125f4a (.)
=======
            'consistent' => true,
        ],
>>>>>>> b93ef594b4 (.)
    ]);

=======
            'consistent' => true
        ]
    ]);
    
>>>>>>> origin/develop
>>>>>>> b1cd7fc (.)
    $storedEvent = StoredEvent::factory()->create([
        'aggregate_uuid' => $aggregateUuid,
        'event_properties' => [
            'activity_id' => $activity->id,
            'snapshot_id' => $snapshot->id,
            'user_id' => $user->id,
<<<<<<< HEAD
            'consistent' => true,
        ],
=======
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
            'consistent' => true,
        ],
=======
            'consistent' => true
        ]
>>>>>>> a12f125f4a (.)
=======
            'consistent' => true,
        ],
>>>>>>> b93ef594b4 (.)
>>>>>>> b1cd7fc (.)
    ]);

    $activity->update(['properties' => array_merge($activity->properties->toArray(), ['verified' => true])]);

    $snapshot->update(['state' => array_merge($snapshot->state, ['verified' => true])]);

    $storedEvent->update(['event_properties' => array_merge($storedEvent->event_properties, ['verified' => true])]);

    $freshActivity = $activity->fresh();
    $freshSnapshot = $snapshot->fresh();
    $freshEvent = $storedEvent->fresh();

    expect($freshActivity->properties)->toHaveKey('verified', true);
    expect($freshSnapshot->state)->toHaveKey('verified', true);
    expect($freshEvent->event_properties)->toHaveKey('verified', true);

<<<<<<< HEAD
=======
=======
            'consistent' => true
        ]
    ]);
    
    $activity->update(['properties' => array_merge($activity->properties->toArray(), ['verified' => true])]);
    
    $snapshot->update(['state' => array_merge($snapshot->state, ['verified' => true])]);
    
    $storedEvent->update(['event_properties' => array_merge($storedEvent->event_properties, ['verified' => true])]);
    
    $freshActivity = $activity->fresh();
    $freshSnapshot = $snapshot->fresh();
    $freshEvent = $storedEvent->fresh();
    
    expect($freshActivity->properties)->toHaveKey('verified', true);
    expect($freshSnapshot->state)->toHaveKey('verified', true);
    expect($freshEvent->event_properties)->toHaveKey('verified', true);
    
>>>>>>> origin/develop
>>>>>>> b1cd7fc (.)
    expect($freshActivity->properties['action'])->toBe('data_consistency_test');
    expect($freshSnapshot->state['consistent'])->toBeTrue();
    expect($freshEvent->event_properties['consistent'])->toBeTrue();
});

test('activity module supports bulk operations efficiently', function () {
    $user = User::factory()->create();
<<<<<<< HEAD

=======
<<<<<<< HEAD

=======
    
>>>>>>> origin/develop
>>>>>>> b1cd7fc (.)
    $activitiesData = [];
    for ($i = 0; $i < 100; $i++) {
        $activitiesData[] = [
            'log_name' => 'bulk_operation',
            'description' => "Bulk activity {$i}",
            'causer_type' => User::class,
            'causer_id' => $user->id,
            'properties' => ['index' => $i, 'batch' => 'bulk_test'],
            'created_at' => now(),
<<<<<<< HEAD
            'updated_at' => now(),
=======
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
            'updated_at' => now(),
=======
            'updated_at' => now()
>>>>>>> a12f125f4a (.)
=======
            'updated_at' => now(),
>>>>>>> b93ef594b4 (.)
>>>>>>> b1cd7fc (.)
        ];
    }

    Activity::insert($activitiesData);

    $bulkActivities = Activity::where('log_name', 'bulk_operation')->get();

    expect($bulkActivities)->toHaveCount(100);

    $firstActivity = $bulkActivities->first();
    $lastActivity = $bulkActivities->last();

<<<<<<< HEAD
=======
=======
            'updated_at' => now()
        ];
    }
    
    Activity::insert($activitiesData);
    
    $bulkActivities = Activity::where('log_name', 'bulk_operation')->get();
    
    expect($bulkActivities)->toHaveCount(100);
    
    $firstActivity = $bulkActivities->first();
    $lastActivity = $bulkActivities->last();
    
>>>>>>> origin/develop
>>>>>>> b1cd7fc (.)
    expect($firstActivity->properties['index'])->toBe(0);
    expect($lastActivity->properties['index'])->toBe(99);
    expect($firstActivity->causer_id)->toBe($user->id);
    expect($lastActivity->causer_id)->toBe($user->id);
<<<<<<< HEAD
=======
<<<<<<< HEAD
>>>>>>> b1cd7fc (.)

    $userActivities = Activity::causedBy($user)->where('log_name', 'bulk_operation')->get();
    expect($userActivities)->toHaveCount(100);
});
<<<<<<< HEAD
=======
=======
    
    $userActivities = Activity::causedBy($user)->where('log_name', 'bulk_operation')->get();
    expect($userActivities)->toHaveCount(100);
});
>>>>>>> origin/develop
>>>>>>> b1cd7fc (.)
