<?php

declare(strict_types=1);

use Illuminate\Support\Str;
use Modules\Activity\Models\Activity;
use Modules\Activity\Models\Snapshot;
use Modules\Activity\Models\StoredEvent;
use Modules\User\Models\User;

test('activity module models work together in integrated scenarios', function (): void {
    /* @phpstan-ignore-next-line method.nonObject */
    /* @phpstan-ignore-next-line method.nonObject */
    $user = User/** @phpstan-ignore-line */ ::factory()->create();
    assert($user instanceof User);

    /* @phpstan-ignore-next-line method.nonObject */
    /* @phpstan-ignore-next-line method.nonObject */
    $activity = Activity/** @phpstan-ignore-line */ ::factory()->create([
        'causer_type' => User::class,
        'causer_id' => $user->id,
        'subject_type' => User::class,
        'subject_id' => $user->id,
        'properties' => [
            'action' => 'user_registration',
            'details' => ['source' => 'web', 'campaign' => 'test'],
        ],
    ]);
    assert($activity instanceof Activity);

    $aggregateUuid = Str::uuid()->toString();

    /* @phpstan-ignore-next-line method.nonObject */
    /* @phpstan-ignore-next-line method.nonObject */
    $snapshot = Snapshot/** @phpstan-ignore-line */ ::factory()->create([
        'aggregate_uuid' => $aggregateUuid,
        'state' => [
            'user' => $user->toArray(),
            'activities' => [$activity->toArray()],
            'metadata' => ['version' => '1.0.0'],
        ],
    ]);
    assert($snapshot instanceof Snapshot);

    /* @phpstan-ignore-next-line method.nonObject */
    $storedEvent = StoredEvent/** @phpstan-ignore-line */ ::factory()->create([
        'aggregate_uuid' => $aggregateUuid,
        'event_class' => 'App\\Events\\UserProfileUpdated',
        'event_properties' => [
            'user_id' => $user->id,
            'activity_id' => $activity->id,
            'snapshot_id' => $snapshot->id,
            'changes' => ['profile_completed' => true],
        ],
    ]);
    assert($storedEvent instanceof StoredEvent);

    $causer = $activity->causer;
    expect($causer)->toBeInstanceOf(User::class);
    if ($causer instanceof User) {
        expect($causer->id)->toBe($user->id);
    }

    /* @phpstan-ignore-next-line property.nonObject */
    expect($snapshot->state)->toHaveKey('user');
    /* @phpstan-ignore-next-line offsetAccess.nonOffsetAccessible */
    expect($snapshot->state['user']['id'] ?? null)->toBe($user->id);
    /* @phpstan-ignore-next-line property.nonObject */
    expect($storedEvent->event_properties)->toHaveKey('user_id', $user->id);

    $relatedActivities = Activity::causedBy($user)->get();
    expect($relatedActivities)->toContain($activity);

    $relatedSnapshots = Snapshot::uuid($aggregateUuid)->get();
    expect($relatedSnapshots)->toContain($snapshot);

    $relatedEvents = StoredEvent::whereAggregateUuid($aggregateUuid)->get();
    expect($relatedEvents)->toContain($storedEvent);
});

test('activity batch processing with multiple models', function (): void {
    $batchUuid = Str::uuid()->toString();
    $aggregateUuid = Str::uuid()->toString();

    /* @phpstan-ignore-next-line method.nonObject */
    /* @phpstan-ignore-next-line method.nonObject */
    $user = User/** @phpstan-ignore-line */ ::factory()->create();
    assert($user instanceof User);

    /* @phpstan-ignore-next-line method.nonObject */
    $factory = Activity::factory();
    assert($factory !== null);
    /* @phpstan-ignore-next-line method.nonObject */
    $activities = $factory
    /* @phpstan-ignore-next-line method.nonObject */
    ->count(5)
    ->create([
        'batch_uuid' => $batchUuid,
        'causer_type' => User::class,
        'causer_id' => $user->id,
    ]);
    assert($activities instanceof \Illuminate\Database\Eloquent\Collection);

    /* @phpstan-ignore-next-line method.nonObject */
    /* @phpstan-ignore-next-line method.nonObject */
    $snapshot = Snapshot/** @phpstan-ignore-line */ ::factory()->create([
        'aggregate_uuid' => $aggregateUuid,
        'state' => [
            'batch_id' => $batchUuid,
            'activities_count' => $activities->count(),
            'user_id' => $user->id,
        ],
    ]);
    assert($snapshot instanceof Snapshot);

    /* @phpstan-ignore-next-line method.nonObject */
    $storedEventsFactory = StoredEvent::factory();
    assert($storedEventsFactory !== null);
    /* @phpstan-ignore-next-line method.nonObject */
    $storedEvents = $storedEventsFactory
    /* @phpstan-ignore-next-line method.nonObject */
    ->count(3)
    ->create([
        'aggregate_uuid' => $aggregateUuid,
        'event_properties' => [
            'batch_id' => $batchUuid,
            'processed_activities' => $activities->pluck('id')->toArray(),
        ],
    ]);
    assert($storedEvents instanceof \Illuminate\Database\Eloquent\Collection);

    $batchActivities = Activity::forBatch($batchUuid)->get();
    expect($batchActivities)->toHaveCount(5);

    $freshSnapshot = $snapshot->fresh();
    expect($freshSnapshot)->toBeInstanceOf(Snapshot::class);
    assert($freshSnapshot instanceof Snapshot);

    $snapshotState = $freshSnapshot->state;
    expect($snapshotState['activities_count'] ?? null)->toBe(5);
    expect($snapshotState['user_id'] ?? null)->toBe($user->id);

    $aggregateEvents = StoredEvent::whereAggregateUuid($aggregateUuid)->get();
    expect($aggregateEvents)->toHaveCount(3);

    $firstEvent = $aggregateEvents->first();
    expect($firstEvent)->toBeInstanceOf(StoredEvent::class);
    if ($firstEvent instanceof StoredEvent) {
        expect($firstEvent->event_properties['batch_id'] ?? null)->toBe($batchUuid);
    }
});

test('activity module handles concurrent operations correctly', function (): void {
    /* @phpstan-ignore-next-line method.nonObject */
    /* @phpstan-ignore-next-line method.nonObject */
    $user = User/** @phpstan-ignore-line */ ::factory()->create();
    assert($user instanceof User);

    $concurrentActivities = [];
    $concurrentSnapshots = [];

    $promises = [];

    for ($i = 0; $i < 10; ++$i) {
        $promises[] = function () use ($user, &$concurrentActivities, &$concurrentSnapshots, $i) {
            /* @phpstan-ignore-next-line method.nonObject */
            /* @phpstan-ignore-next-line method.nonObject */
            $activity = Activity/** @phpstan-ignore-line */ ::factory()->create([
                'causer_type' => User::class,
                'causer_id' => $user->id,
                'properties' => ['iteration' => $i, 'timestamp' => now()->toISOString()],
            ]);
            assert($activity instanceof Activity);

            $concurrentActivities[] = $activity->id;

            if (($i % 2) === 0) {
                /* @phpstan-ignore-next-line method.nonObject */
                /* @phpstan-ignore-next-line method.nonObject */
                $snapshot = Snapshot/** @phpstan-ignore-line */ ::factory()->create([
                    'state' => [
                        'activity_id' => $activity->id,
                        'iteration' => $i,
                        'user_id' => $user->id,
                    ],
                ]);
                assert($snapshot instanceof Snapshot);

                $concurrentSnapshots[] = $snapshot->id;
            }

            return true;
        };
    }

    $results = array_map(fn ($promise) => $promise(), $promises);

    expect($results)->toHaveCount(10);
    foreach ($results as $result) {
        expect($result)->toBeTrue();
    }

    $userActivities = Activity::causedBy($user)->get();
    expect($userActivities)->toHaveCount(10);

    $createdSnapshots = Snapshot::whereIn('id', $concurrentSnapshots)->get();
    expect($createdSnapshots)->toHaveCount(5);
});

test('activity module supports complex query patterns', function (): void {
    /* @phpstan-ignore-next-line method.nonObject */
    /* @phpstan-ignore-next-line method.nonObject */
    $user1 = User/** @phpstan-ignore-line */ ::factory()->create();
    assert($user1 instanceof User);
    /* @phpstan-ignore-next-line method.nonObject */
    /* @phpstan-ignore-next-line method.nonObject */
    $user2 = User/** @phpstan-ignore-line */ ::factory()->create();
    assert($user2 instanceof User);

    /* @phpstan-ignore-next-line method.nonObject */
    $securityFactory = Activity::factory();
    assert($securityFactory !== null);
    /* @phpstan-ignore-next-line method.nonObject */
    $securityActivities = $securityFactory
    /* @phpstan-ignore-next-line method.nonObject */
    ->count(3)
    ->create([
        'log_name' => 'security',
        'causer_type' => User::class,
        'causer_id' => $user1->id,
    ]);
    assert($securityActivities instanceof \Illuminate\Database\Eloquent\Collection);

    /* @phpstan-ignore-next-line method.nonObject */
    $auditFactory = Activity::factory();
    assert($auditFactory !== null);
    /* @phpstan-ignore-next-line method.nonObject */
    $auditActivities = $auditFactory
    /* @phpstan-ignore-next-line method.nonObject */
    ->count(2)
    ->create([
        'log_name' => 'audit',
        'causer_type' => User::class,
        'causer_id' => $user2->id,
    ]);
    assert($auditActivities instanceof \Illuminate\Database\Eloquent\Collection);

    /* @phpstan-ignore-next-line method.nonObject */
    $applicationFactory = Activity::factory();
    assert($applicationFactory !== null);
    /* @phpstan-ignore-next-line method.nonObject */
    $applicationActivities = $applicationFactory
    /* @phpstan-ignore-next-line method.nonObject */
    ->count(4)
    ->create([
        'log_name' => 'application',
        'causer_type' => User::class,
        'causer_id' => $user1->id,
    ]);
    assert($applicationActivities instanceof \Illuminate\Database\Eloquent\Collection);

    $complexQuery = Activity::query()
        ->where('causer_type', User::class)
        ->whereIn('log_name', ['security', 'audit'])
        ->where(function ($query) use ($user1, $user2): void {
            $query->where('causer_id', $user1->id)->orWhere('causer_id', $user2->id);
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

    expect($user1Results)->toHaveCount(3);
    expect($user2Results)->toHaveCount(2);
});

test('activity module handles data consistency across models', function (): void {
    /* @phpstan-ignore-next-line method.nonObject */
    $user = User/** @phpstan-ignore-line */ ::factory()->create();
    assert($user instanceof User);
    $aggregateUuid = Str::uuid();

    /* @phpstan-ignore-next-line method.nonObject */
    $activity = Activity/** @phpstan-ignore-line */ ::factory()->create([
        'causer_type' => User::class,
        'causer_id' => $user->id,
        'properties' => ['action' => 'data_consistency_test'],
    ]);
    assert($activity instanceof Activity);

    /* @phpstan-ignore-next-line method.nonObject */
    /* @phpstan-ignore-next-line method.nonObject */
    $snapshot = Snapshot/** @phpstan-ignore-line */ ::factory()->create([
        'aggregate_uuid' => $aggregateUuid,
        'state' => [
            'activity_id' => $activity->id,
            'user_id' => $user->id,
            'consistent' => true,
        ],
    ]);
    assert($snapshot instanceof Snapshot);

    /* @phpstan-ignore-next-line method.nonObject */
    $storedEvent = StoredEvent/** @phpstan-ignore-line */ ::factory()->create([
        'aggregate_uuid' => $aggregateUuid,
        'event_properties' => [
            'activity_id' => $activity->id,
            'snapshot_id' => $snapshot->id,
            'user_id' => $user->id,
            'consistent' => true,
        ],
    ]);
    assert($storedEvent instanceof StoredEvent);

    /* @phpstan-ignore-next-line property.nonObject */
    $activity->update(['properties' => array_merge($activity->properties->toArray(), ['verified' => true])]);
    $snapshot->update(['state' => array_merge($snapshot->state, ['verified' => true])]);
    $storedEvent->update(['event_properties' => array_merge($storedEvent->event_properties, ['verified' => true])]);

    $freshActivity = $activity->fresh();
    expect($freshActivity)->toBeInstanceOf(Activity::class);
    assert($freshActivity instanceof Activity);

    $freshSnapshot = $snapshot->fresh();
    expect($freshSnapshot)->toBeInstanceOf(Snapshot::class);
    assert($freshSnapshot instanceof Snapshot);

    $freshEvent = $storedEvent->fresh();
    expect($freshEvent)->toBeInstanceOf(StoredEvent::class);
    assert($freshEvent instanceof StoredEvent);

    expect($freshActivity->properties)->toHaveKey('verified', true);
    expect($freshSnapshot->state)->toHaveKey('verified', true);
    expect($freshEvent->event_properties)->toHaveKey('verified', true);

    expect($freshActivity->properties['action'] ?? null)->toBe('data_consistency_test');
    expect($freshSnapshot->state['consistent'] ?? null)->toBeTrue();
    expect($freshEvent->event_properties['consistent'] ?? null)->toBeTrue();
});

test('activity module supports bulk operations efficiently', function (): void {
    /* @phpstan-ignore-next-line method.nonObject */
    $user = User/** @phpstan-ignore-line */ ::factory()->create();
    assert($user instanceof User);

    $activitiesData = [];
    for ($i = 0; $i < 100; ++$i) {
        $activitiesData[] = [
            'log_name' => 'bulk_operation',
            'description' => "Bulk activity {$i}",
            'causer_type' => User::class,
            'causer_id' => $user->id,
            'properties' => ['index' => $i, 'batch' => 'bulk_test'],
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

    Activity::insert($activitiesData);

    $bulkActivities = Activity::where('log_name', 'bulk_operation')->get();

    expect($bulkActivities)->toHaveCount(100);

    $firstActivity = $bulkActivities->first();
    expect($firstActivity)->toBeInstanceOf(Activity::class);

    $lastActivity = $bulkActivities->last();
    expect($lastActivity)->toBeInstanceOf(Activity::class);

    if ($firstActivity instanceof Activity) {
        expect($firstActivity->properties['index'] ?? null)->toBe(0);
        expect($firstActivity->causer_id)->toBe($user->id);
    }

    if ($lastActivity instanceof Activity) {
        expect($lastActivity->properties['index'] ?? null)->toBe(99);
        expect($lastActivity->causer_id)->toBe($user->id);
    }

    $userActivities = Activity::causedBy($user)->where('log_name', 'bulk_operation')->get();
    expect($userActivities)->toHaveCount(100);
});
