<?php

declare(strict_types=1);

use Modules\Activity\Filament\Resources\ActivityResource;
use Modules\Activity\Filament\Resources\SnapshotResource;
use Modules\Activity\Filament\Resources\StoredEventResource;
use Modules\Xot\Filament\Resources\XotBaseResource;

test('activity resources extend xot base resource', function (): void {
    /* @phpstan-ignore-next-line method.notFound */
    expect(ActivityResource::class)->toBeSubclassOf(XotBaseResource::class);

    /* @phpstan-ignore-next-line method.notFound */
    expect(SnapshotResource::class)->toBeSubclassOf(XotBaseResource::class);

    /* @phpstan-ignore-next-line method.notFound */
    expect(StoredEventResource::class)->toBeSubclassOf(XotBaseResource::class);
});

test('activity resource does not implement unnecessary methods', function (): void {
    $reflection = new ReflectionClass(ActivityResource::class);

    expect($reflection->hasMethod('getPages'))
        ->toBeFalse()
        /* @phpstan-ignore-next-line method.nonObject */
        ->and($reflection->hasMethod('getRelations'))
        ->toBeFalse()
        /* @phpstan-ignore-next-line method.nonObject */
        ->and($reflection->hasMethod('form'))
        ->toBeFalse()
        /* @phpstan-ignore-next-line method.nonObject */
        ->and($reflection->hasMethod('table'))
        ->toBeFalse();
});

test('activity resource implements required getFormSchema method', function (): void {
    $reflection = new ReflectionClass(ActivityResource::class);

    expect($reflection->hasMethod('getFormSchema'))->toBeTrue();

    /** @phpstan-ignore-next-line method.nonObject */
    $method = $reflection->getMethod('getFormSchema');
    /* @phpstan-ignore-next-line argument.templateType */
    expect($method->isPublic())
        ->toBeTrue()
        /* @phpstan-ignore-next-line method.nonObject */
        ->and($method->isStatic())
        ->toBeTrue()
        /* @phpstan-ignore-next-line method.nonObject */
        ->and($method->getReturnType()?->getName())
        ->toBe('array');
});

test('snapshot resource should not implement unnecessary methods', function (): void {
    $reflection = new ReflectionClass(SnapshotResource::class);

    // These methods should NOT be implemented (they return standard values)
    /** @phpstan-ignore-next-line method.nonObject */
    $hasUnnecessaryPages = $reflection->hasMethod('getPages');
    /** @phpstan-ignore-next-line method.nonObject */
    $hasUnnecessaryRelations = $reflection->hasMethod('getRelations');

    if ($hasUnnecessaryPages) {
        /** @phpstan-ignore-next-line method.nonObject */
        $pagesMethod = $reflection->getMethod('getPages');
        /** @phpstan-ignore-next-line method.nonObject */
        $pagesValue = $pagesMethod->invoke(null);

        // If it returns standard pages, it shouldn't be implemented
        /** @phpstan-ignore-next-line offsetAccess.nonOffsetAccessible */
        $isStandardPages = isset($pagesValue['index'], $pagesValue['create'], $pagesValue['edit']);

        expect($isStandardPages, 'SnapshotResource should not implement getPages() for standard pages')
            ->toBeFalse();
    }

    if ($hasUnnecessaryRelations) {
        /** @phpstan-ignore-next-line method.nonObject */
        $relationsMethod = $reflection->getMethod('getRelations');
        /** @phpstan-ignore-next-line method.nonObject */
        $relationsValue = $relationsMethod->invoke(null);

        // If it returns empty array, it shouldn't be implemented
        $isEmptyRelations = empty($relationsValue);

        expect($isEmptyRelations, 'SnapshotResource should not implement getRelations() for empty relations')
            ->toBeFalse();
    }
});

test('stored event resource should not implement unnecessary methods', function (): void {
    $reflection = new ReflectionClass(StoredEventResource::class);

    // These methods should NOT be implemented (they return standard values)
    /** @phpstan-ignore-next-line method.nonObject */
    $hasUnnecessaryPages = $reflection->hasMethod('getPages');
    /** @phpstan-ignore-next-line method.nonObject */
    $hasUnnecessaryRelations = $reflection->hasMethod('getRelations');

    if ($hasUnnecessaryPages) {
        /** @phpstan-ignore-next-line method.nonObject */
        $pagesMethod = $reflection->getMethod('getPages');
        /** @phpstan-ignore-next-line method.nonObject */
        $pagesValue = $pagesMethod->invoke(null);

        // If it returns standard pages, it shouldn't be implemented
        /** @phpstan-ignore-next-line offsetAccess.nonOffsetAccessible */
        $isStandardPages = isset($pagesValue['index'], $pagesValue['create'], $pagesValue['edit']);

        expect($isStandardPages, 'StoredEventResource should not implement getPages() for standard pages')
            ->toBeFalse();
    }

    if ($hasUnnecessaryRelations) {
        /** @phpstan-ignore-next-line method.nonObject */
        $relationsMethod = $reflection->getMethod('getRelations');
        /** @phpstan-ignore-next-line method.nonObject */
        $relationsValue = $relationsMethod->invoke(null);

        // If it returns empty array, it shouldn't be implemented
        $isEmptyRelations = empty($relationsValue);

        expect($isEmptyRelations, 'StoredEventResource should not implement getRelations() for empty relations')
            ->toBeFalse();
    }
});

test('activity resource has correct model configuration', function (): void {
    expect(ActivityResource::getModel())->toBe('Modules\\Activity\\Models\\Activity');

    expect(SnapshotResource::getModel())->toBe('Modules\\Activity\\Models\\Snapshot');

    expect(StoredEventResource::getModel())->toBe('Modules\\Activity\\Models\\StoredEvent');
});

test('activity resource form schema returns array', function (): void {
    $form = ActivityResource::getFormSchema();

    /* @phpstan-ignore-next-line property.notFound */
    expect($form)->toBeArray()->not->toBeEmpty();

    // Verify it contains expected fields
    expect($form)->toHaveKeys([
        'log_name',
        'description',
        'subject_type',
        'subject_id',
        'properties',
    ]);
});

test('snapshot resource form schema returns array', function (): void {
    $form = SnapshotResource::getFormSchema();

    /* @phpstan-ignore-next-line property.notFound */
    expect($form)->toBeArray()->not->toBeEmpty();

    // Verify it contains expected fields
    expect($form)->toHaveKeys([
        'model_type',
        'model_id',
        'state',
    ]);
});

test('stored event resource form schema returns array', function (): void {
    $form = StoredEventResource::getFormSchema();

    /* @phpstan-ignore-next-line property.notFound */
    expect($form)->toBeArray()->not->toBeEmpty();

    // Verify it contains expected fields
    expect($form)->toHaveKeys([
        'event_class',
        'event_properties',
        'aggregate_uuid',
    ]);
});

test('resources use proper xot base resource functionality', function (): void {
    // Test that the base resource functionality works
    $activityPages = ActivityResource::getPages();
    $snapshotPages = SnapshotResource::getPages();
    $storedEventPages = StoredEventResource::getPages();

    expect($activityPages)->toHaveKeys(['index', 'create', 'edit']);
    expect($snapshotPages)->toHaveKeys(['index', 'create', 'edit']);
    expect($storedEventPages)->toHaveKeys(['index', 'create', 'edit']);

    // Test relation discovery
    $activityRelations = ActivityResource::getRelations();
    $snapshotRelations = SnapshotResource::getRelations();
    $storedEventRelations = StoredEventResource::getRelations();

    expect($activityRelations)->toBeArray();
    expect($snapshotRelations)->toBeArray();
    expect($storedEventRelations)->toBeArray();
});

test('resources follow xot base resource naming conventions', function (): void {
    // Test that resource names follow conventions
    expect(class_basename(ActivityResource::class))->toBe('ActivityResource');

    expect(class_basename(SnapshotResource::class))->toBe('SnapshotResource');

    expect(class_basename(StoredEventResource::class))->toBe('StoredEventResource');

    // Test that model names are correctly derived
    expect(ActivityResource::getModel())->toBe('Modules\\Activity\\Models\\Activity');

    expect(SnapshotResource::getModel())->toBe('Modules\\Activity\\Models\\Snapshot');

    expect(StoredEventResource::getModel())->toBe('Modules\\Activity\\Models\\StoredEvent');
});
