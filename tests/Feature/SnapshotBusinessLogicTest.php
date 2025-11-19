<?php

declare(strict_types=1);

<<<<<<< HEAD
=======
namespace Modules\Activity\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
>>>>>>> 9baa519 (.)
use Illuminate\Support\Str;
use Modules\Activity\Models\Snapshot;
use Modules\Activity\Tests\TestCase;

use function Safe\json_encode;

uses(TestCase::class);

test('it can create snapshot with basic information', function (): void {
    $snapshotData = [
        'aggregate_uuid' => Str::uuid()->toString(),
        'aggregate_version' => 1,
        'state' => json_encode([
            'name' => 'Test Aggregate',
            'status' => 'active',
            'created_at' => now()->toISOString(),
        ]),
    ];

    /** @var Snapshot */
    $snapshot = Snapshot::create($snapshotData);

    expect($snapshot->aggregate_uuid)->toBe($snapshotData['aggregate_uuid'])
        ->and($snapshot->aggregate_version)->toBe(1)
        ->and($snapshot->state)->toBeArray()
        ->and($snapshot->state['name'])->toBe('Test Aggregate')
        ->and($snapshot->state['status'])->toBe('active');

    // Clean up
    $snapshot->delete();
});

test('it can create snapshot with complex state', function (): void {
    $complexState = [
        'user_info' => [
            'id' => 123,
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'profile' => [
                'avatar' => '/avatars/john.jpg',
                'bio' => 'Software Developer',
                'preferences' => [
                    'theme' => 'dark',
                    'language' => 'en',
                    'notifications' => true,
                ],
            ],
        ],
        'account_status' => [
            'is_active' => true,
            'last_login' => now()->subHours(2)->toISOString(),
            'login_count' => 45,
            'subscription' => [
                'plan' => 'premium',
                'expires_at' => now()->addYear()->toISOString(),
                'features' => ['api_access', 'priority_support', 'advanced_analytics'],
            ],
        ],
        'metadata' => [
            'created_by' => 'system',
            'source' => 'web_registration',
            'tags' => ['verified', 'premium_user'],
        ],
    ];

    /** @var Snapshot */
    $snapshot = Snapshot::create([
        'aggregate_uuid' => Str::uuid()->toString(),
        'aggregate_version' => 5,
        'state' => json_encode($complexState),
    ]);

    expect($snapshot->aggregate_version)->toBe(5)
        ->and($snapshot->state)->toBeArray()
        ->and($snapshot->state['user_info']['name'])->toBe('John Doe')
        ->and($snapshot->state['account_status']['subscription']['plan'])->toBe('premium')
        ->and($snapshot->state['account_status']['is_active'])->toBeTrue()
        ->and($snapshot->state['metadata']['tags'])->toContain('verified');

    // Clean up
    $snapshot->delete();
});

test('it can manage snapshot versioning', function (): void {
    $aggregateUuid = Str::uuid()->toString();

    // Crea snapshot con versioni progressive
    /** @var Snapshot */
    $snapshot1 = Snapshot::create([
        'aggregate_uuid' => $aggregateUuid,
        'aggregate_version' => 1,
        'state' => json_encode(['version' => 1, 'data' => 'Initial state']),
    ]);

    /** @var Snapshot */
    $snapshot2 = Snapshot::create([
        'aggregate_uuid' => $aggregateUuid,
        'aggregate_version' => 2,
        'state' => json_encode(['version' => 2, 'data' => 'Updated state']),
    ]);

    /** @var Snapshot */
    $snapshot3 = Snapshot::create([
        'aggregate_uuid' => $aggregateUuid,
        'aggregate_version' => 3,
        'state' => json_encode(['version' => 3, 'data' => 'Final state']),
    ]);

    // Verifica che tutti gli snapshot abbiano lo stesso UUID ma versioni diverse
    expect($snapshot1->aggregate_uuid)->toBe($aggregateUuid)
        ->and($snapshot2->aggregate_uuid)->toBe($aggregateUuid)
        ->and($snapshot3->aggregate_uuid)->toBe($aggregateUuid)
        ->and($snapshot1->aggregate_version)->toBe(1)
        ->and($snapshot2->aggregate_version)->toBe(2)
        ->and($snapshot3->aggregate_version)->toBe(3);

    // Clean up
    $snapshot1->delete();
    $snapshot2->delete();
    $snapshot3->delete();
});

test('it can query snapshots by aggregate uuid', function (): void {
    $uuid1 = Str::uuid()->toString();
    $uuid2 = Str::uuid()->toString();

    // Crea snapshot per il primo aggregate
    $s1 = Snapshot::create([
        'aggregate_uuid' => $uuid1,
        'aggregate_version' => 1,
        'state' => json_encode(['aggregate' => 'first', 'version' => 1]),
    ]);

    $s2 = Snapshot::create([
        'aggregate_uuid' => $uuid1,
        'aggregate_version' => 2,
        'state' => json_encode(['aggregate' => 'first', 'version' => 2]),
    ]);

    // Crea snapshot per il secondo aggregate
    $s3 = Snapshot::create([
        'aggregate_uuid' => $uuid2,
        'aggregate_version' => 1,
        'state' => json_encode(['aggregate' => 'second', 'version' => 1]),
    ]);

    // Query per UUID specifico
    $snapshots1 = Snapshot::where('aggregate_uuid', $uuid1)->get();
    $snapshots2 = Snapshot::where('aggregate_uuid', $uuid2)->get();

    expect($snapshots1)->toHaveCount(2)
        ->and($snapshots2)->toHaveCount(1)
        ->and($snapshots1->first()->aggregate_uuid)->toBe($uuid1)
        ->and($snapshots2->first()->aggregate_uuid)->toBe($uuid2);

    // Clean up
    $s1->delete();
    $s2->delete();
    $s3->delete();
});

test('it can query snapshots by version', function (): void {
    $uuid = Str::uuid()->toString();

    $s1 = Snapshot::create([
        'aggregate_uuid' => $uuid,
        'aggregate_version' => 1,
        'state' => json_encode(['version' => 1]),
    ]);

    $s2 = Snapshot::create([
        'aggregate_uuid' => $uuid,
        'aggregate_version' => 5,
        'state' => json_encode(['version' => 5]),
    ]);

    $s3 = Snapshot::create([
        'aggregate_uuid' => $uuid,
        'aggregate_version' => 10,
        'state' => json_encode(['version' => 10]),
    ]);

    // Query per versione specifica
    $version1Snapshot = Snapshot::where('aggregate_uuid', $uuid)->where('aggregate_version', 1)->first();
    $version5Snapshot = Snapshot::where('aggregate_uuid', $uuid)->where('aggregate_version', 5)->first();
    $version10Snapshot = Snapshot::where('aggregate_uuid', $uuid)->where('aggregate_version', 10)->first();

    expect($version1Snapshot)->not->toBeNull()
        ->and($version5Snapshot)->not->toBeNull()
        ->and($version10Snapshot)->not->toBeNull()
        ->and($version1Snapshot->aggregate_version)->toBe(1)
        ->and($version5Snapshot->aggregate_version)->toBe(5)
        ->and($version10Snapshot->aggregate_version)->toBe(10);

    // Clean up
    $s1->delete();
    $s2->delete();
    $s3->delete();
});

test('it can handle snapshot with empty state', function (): void {
    /** @var Snapshot */
    $snapshot = Snapshot::create([
        'aggregate_uuid' => Str::uuid()->toString(),
        'aggregate_version' => 1,
        'state' => json_encode([]),
    ]);

    expect($snapshot->state)->toBeArray()
        ->and($snapshot->state)->toBeEmpty();

    // Clean up
    $snapshot->delete();
});

test('it can handle snapshot with null state', function (): void {
    /** @var Snapshot */
    $snapshot = Snapshot::create([
        'aggregate_uuid' => Str::uuid()->toString(),
        'aggregate_version' => 1,
        'state' => null,
    ]);

    expect($snapshot->state)->toBeNull();

    // Clean up
    $snapshot->delete();
});

test('it can restore state from snapshot', function (): void {
    $originalState = [
        'user_id' => 456,
        'settings' => [
            'theme' => 'light',
            'language' => 'it',
            'notifications' => false,
        ],
        'preferences' => [
            'timezone' => 'Europe/Rome',
            'date_format' => 'd/m/Y',
            'currency' => 'EUR',
        ],
    ];

    /** @var Snapshot */
    $snapshot = Snapshot::create([
        'aggregate_uuid' => Str::uuid()->toString(),
        'aggregate_version' => 7,
        'state' => json_encode($originalState),
    ]);

    // Simula il ripristino dello stato
    $restoredState = $snapshot->state;

    expect($restoredState)->toBe($originalState)
        ->and($restoredState['user_id'])->toBe(456)
        ->and($restoredState['settings']['theme'])->toBe('light')
        ->and($restoredState['preferences']['timezone'])->toBe('Europe/Rome')
        ->and($restoredState['preferences']['currency'])->toBe('EUR');

    // Clean up
    $snapshot->delete();
});

test('it can compare snapshot versions', function (): void {
    $uuid = Str::uuid()->toString();

    /** @var Snapshot */
    $snapshot1 = Snapshot::create([
        'aggregate_uuid' => $uuid,
        'aggregate_version' => 1,
        'state' => json_encode(['value' => 100, 'status' => 'initial']),
    ]);

    /** @var Snapshot */
    $snapshot2 = Snapshot::create([
        'aggregate_uuid' => $uuid,
        'aggregate_version' => 2,
        'state' => json_encode(['value' => 200, 'status' => 'updated']),
    ]);

    /** @var Snapshot */
    $snapshot3 = Snapshot::create([
        'aggregate_uuid' => $uuid,
        'aggregate_version' => 3,
        'state' => json_encode(['value' => 300, 'status' => 'final']),
    ]);

    // Verifica che le versioni siano progressive
    expect($snapshot1->aggregate_version)->toBeLessThan($snapshot2->aggregate_version)
        ->and($snapshot2->aggregate_version)->toBeLessThan($snapshot3->aggregate_version);

    // Verifica che i valori cambino tra le versioni
    expect($snapshot1->state['value'])->toBe(100)
        ->and($snapshot2->state['value'])->toBe(200)
        ->and($snapshot3->state['value'])->toBe(300)
        ->and($snapshot1->state['status'])->toBe('initial')
        ->and($snapshot2->state['status'])->toBe('updated')
        ->and($snapshot3->state['status'])->toBe('final');

    // Clean up
    $snapshot1->delete();
    $snapshot2->delete();
    $snapshot3->delete();
});

test('it can handle snapshot with timestamps', function (): void {
    $now = now();

    /** @var Snapshot */
    $snapshot = Snapshot::create([
        'aggregate_uuid' => Str::uuid()->toString(),
        'aggregate_version' => 1,
        'state' => json_encode(['created_at' => $now->toISOString()]),
        'created_at' => $now,
        'updated_at' => $now,
    ]);

    expect($snapshot->created_at->timestamp)->toBe($now->timestamp)
        ->and($snapshot->updated_at->timestamp)->toBe($now->timestamp);

    // Clean up
    $snapshot->delete();
});

test('it can query snapshots by date range', function (): void {
    $yesterday = now()->subDay();
    $today = now();
    $tomorrow = now()->addDay();

    $s1 = Snapshot::create([
        'aggregate_uuid' => Str::uuid()->toString(),
        'aggregate_version' => 1,
        'state' => json_encode(['date' => 'yesterday']),
        'created_at' => $yesterday,
    ]);

    $s2 = Snapshot::create([
        'aggregate_uuid' => Str::uuid()->toString(),
        'aggregate_version' => 1,
        'state' => json_encode(['date' => 'today']),
        'created_at' => $today,
    ]);

    $s3 = Snapshot::create([
        'aggregate_uuid' => Str::uuid()->toString(),
        'aggregate_version' => 1,
        'state' => json_encode(['date' => 'tomorrow']),
        'created_at' => $tomorrow,
    ]);

    $todaySnapshots = Snapshot::whereDate('created_at', today())->get();
    expect($todaySnapshots)->toHaveCount(1)
        ->and($todaySnapshots->first()->state['date'])->toBe('today');

    $recentSnapshots = Snapshot::where('created_at', '>=', $yesterday)->get();
    expect($recentSnapshots)->toHaveCount(2);

    // Clean up
    $s1->delete();
    $s2->delete();
    $s3->delete();
});

test('it can handle snapshot with metadata', function (): void {
    $metadata = [
        'source' => 'user_action',
        'user_id' => 789,
        'action' => 'profile_update',
        'timestamp' => now()->toISOString(),
        'ip_address' => '192.168.1.100',
        'user_agent' => 'Mozilla/5.0',
        'session_id' => Str::random(40),
    ];

    /** @var Snapshot */
    $snapshot = Snapshot::create([
        'aggregate_uuid' => Str::uuid()->toString(),
        'aggregate_version' => 1,
        'state' => json_encode([
            'profile' => [
                'name' => 'Alice Johnson',
                'email' => 'alice@example.com',
            ],
            'metadata' => $metadata,
        ]),
    ]);

    expect($snapshot->state['profile']['name'])->toBe('Alice Johnson')
        ->and($snapshot->state['profile']['email'])->toBe('alice@example.com')
        ->and($snapshot->state['metadata']['source'])->toBe('user_action')
        ->and($snapshot->state['metadata']['user_id'])->toBe(789)
        ->and($snapshot->state['metadata']['action'])->toBe('profile_update');

    // Clean up
    $snapshot->delete();
});
