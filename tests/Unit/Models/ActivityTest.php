<?php

declare(strict_types=1);

use Modules\Activity\Models\Activity;

test('activity can be created', function (): void {
    $activity = createActivity([
        'log_name' => 'test',
        'description' => 'Test Description',
    ]);

    expect($activity)
        ->and($activity->log_name)
        ->toBe('test')
        ->and($activity->description)
        ->toBe('Test Description');
});

test('activity has required attributes', function (): void {
    $activity = makeActivity();

    expect($activity)
        ->toHaveProperty('log_name')
        ->toHaveProperty('description')
        ->toHaveProperty('created_at')
        ->toHaveProperty('updated_at');
});

test('activity can be soft deleted', function (): void {
    $activity = createActivity();

    $activity->delete();

    // @phpstan-ignore-next-line
    expect($activity->trashed())->toBeTrue();
});

test('activity factory creates valid instances', function (): void {
    $factory = Activity::factory();
    if (! is_object($factory) || ! method_exists($factory, 'make')) {
        throw new \RuntimeException('Activity factory not available');
    }

    $activity = $factory->make();
    assert($activity instanceof Activity);

    expect($activity)
        ->and($activity->log_name)->toBeString()
        ->and($activity->description)->toBeString();
});
