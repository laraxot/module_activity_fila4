<?php

declare(strict_types=1);

use Modules\Activity\Filament\Resources\ActivityResource;
use Modules\Activity\Filament\Resources\SnapshotResource;
use Modules\Activity\Filament\Resources\StoredEventResource;
use Modules\Xot\Filament\Resources\XotBaseResource;

test('activity resources extend xot base resource', function () {
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> 18dcd64 (.)
    expect(ActivityResource::class)->toBeSubclassOf(XotBaseResource::class);

    expect(SnapshotResource::class)->toBeSubclassOf(XotBaseResource::class);

    expect(StoredEventResource::class)->toBeSubclassOf(XotBaseResource::class);
<<<<<<< HEAD
=======
    expect(ActivityResource::class)
        ->toBeSubclassOf(XotBaseResource::class);
    
    expect(SnapshotResource::class)
        ->toBeSubclassOf(XotBaseResource::class);
    
    expect(StoredEventResource::class)
        ->toBeSubclassOf(XotBaseResource::class);
>>>>>>> 0a00ff2 (.)
=======
>>>>>>> 18dcd64 (.)
});

test('activity resource does not implement unnecessary methods', function () {
    $reflection = new ReflectionClass(ActivityResource::class);
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> 18dcd64 (.)

    expect($reflection->hasMethod('getPages'))
        ->toBeFalse()
        ->and($reflection->hasMethod('getRelations'))
        ->toBeFalse()
        ->and($reflection->hasMethod('form'))
        ->toBeFalse()
        ->and($reflection->hasMethod('table'))
        ->toBeFalse();
<<<<<<< HEAD
=======
    
    expect($reflection->hasMethod('getPages'))->toBeFalse()
        ->and($reflection->hasMethod('getRelations'))->toBeFalse()
        ->and($reflection->hasMethod('form'))->toBeFalse()
        ->and($reflection->hasMethod('table'))->toBeFalse();
>>>>>>> 0a00ff2 (.)
=======
>>>>>>> 18dcd64 (.)
});

test('activity resource implements required getFormSchema method', function () {
    $reflection = new ReflectionClass(ActivityResource::class);
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> 18dcd64 (.)

    expect($reflection->hasMethod('getFormSchema'))->toBeTrue();

    $method = $reflection->getMethod('getFormSchema');
    expect($method->isPublic())
        ->toBeTrue()
        ->and($method->isStatic())
        ->toBeTrue()
        ->and($method->getReturnType()?->getName())
        ->toBe('array');
<<<<<<< HEAD
=======
    
    expect($reflection->hasMethod('getFormSchema'))->toBeTrue();
    
    $method = $reflection->getMethod('getFormSchema');
    expect($method->isPublic())->toBeTrue()
        ->and($method->isStatic())->toBeTrue()
        ->and($method->getReturnType()?->getName())->toBe('array');
>>>>>>> 0a00ff2 (.)
=======
>>>>>>> 18dcd64 (.)
});

test('snapshot resource should not implement unnecessary methods', function () {
    $reflection = new ReflectionClass(SnapshotResource::class);
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> 18dcd64 (.)

    // These methods should NOT be implemented (they return standard values)
    $hasUnnecessaryPages = $reflection->hasMethod('getPages');
    $hasUnnecessaryRelations = $reflection->hasMethod('getRelations');

    if ($hasUnnecessaryPages) {
        $pagesMethod = $reflection->getMethod('getPages');
        $pagesValue = $pagesMethod->invoke(null);

        // If it returns standard pages, it shouldn't be implemented
        $isStandardPages = isset($pagesValue['index'], $pagesValue['create'], $pagesValue['edit']);

        expect($isStandardPages)
            ->toBeFalse()
            ->with('SnapshotResource should not implement getPages() for standard pages');
    }

    if ($hasUnnecessaryRelations) {
        $relationsMethod = $reflection->getMethod('getRelations');
        $relationsValue = $relationsMethod->invoke(null);

        // If it returns empty array, it shouldn't be implemented
        $isEmptyRelations = empty($relationsValue);

        expect($isEmptyRelations)
            ->toBeFalse()
            ->with('SnapshotResource should not implement getRelations() for empty relations');
<<<<<<< HEAD
=======
    
    // These methods should NOT be implemented (they return standard values)
    $hasUnnecessaryPages = $reflection->hasMethod('getPages');
    $hasUnnecessaryRelations = $reflection->hasMethod('getRelations');
    
    if ($hasUnnecessaryPages) {
        $pagesMethod = $reflection->getMethod('getPages');
        $pagesValue = $pagesMethod->invoke(null);
        
        // If it returns standard pages, it shouldn't be implemented
        $isStandardPages = isset($pagesValue['index']) && 
                          isset($pagesValue['create']) && 
                          isset($pagesValue['edit']);
        
        expect($isStandardPages)->toBeFalse()->with('SnapshotResource should not implement getPages() for standard pages');
    }
    
    if ($hasUnnecessaryRelations) {
        $relationsMethod = $reflection->getMethod('getRelations');
        $relationsValue = $relationsMethod->invoke(null);
        
        // If it returns empty array, it shouldn't be implemented
        $isEmptyRelations = empty($relationsValue);
        
        expect($isEmptyRelations)->toBeFalse()->with('SnapshotResource should not implement getRelations() for empty relations');
>>>>>>> 0a00ff2 (.)
=======
>>>>>>> 18dcd64 (.)
    }
});

test('stored event resource should not implement unnecessary methods', function () {
    $reflection = new ReflectionClass(StoredEventResource::class);
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> 18dcd64 (.)

    // These methods should NOT be implemented (they return standard values)
    $hasUnnecessaryPages = $reflection->hasMethod('getPages');
    $hasUnnecessaryRelations = $reflection->hasMethod('getRelations');

    if ($hasUnnecessaryPages) {
        $pagesMethod = $reflection->getMethod('getPages');
        $pagesValue = $pagesMethod->invoke(null);

        // If it returns standard pages, it shouldn't be implemented
        $isStandardPages = isset($pagesValue['index'], $pagesValue['create'], $pagesValue['edit']);

        expect($isStandardPages)
            ->toBeFalse()
            ->with('StoredEventResource should not implement getPages() for standard pages');
    }

    if ($hasUnnecessaryRelations) {
        $relationsMethod = $reflection->getMethod('getRelations');
        $relationsValue = $relationsMethod->invoke(null);

        // If it returns empty array, it shouldn't be implemented
        $isEmptyRelations = empty($relationsValue);

        expect($isEmptyRelations)
            ->toBeFalse()
            ->with('StoredEventResource should not implement getRelations() for empty relations');
<<<<<<< HEAD
=======
    
    // These methods should NOT be implemented (they return standard values)
    $hasUnnecessaryPages = $reflection->hasMethod('getPages');
    $hasUnnecessaryRelations = $reflection->hasMethod('getRelations');
    
    if ($hasUnnecessaryPages) {
        $pagesMethod = $reflection->getMethod('getPages');
        $pagesValue = $pagesMethod->invoke(null);
        
        // If it returns standard pages, it shouldn't be implemented
        $isStandardPages = isset($pagesValue['index']) && 
                          isset($pagesValue['create']) && 
                          isset($pagesValue['edit']);
        
        expect($isStandardPages)->toBeFalse()->with('StoredEventResource should not implement getPages() for standard pages');
    }
    
    if ($hasUnnecessaryRelations) {
        $relationsMethod = $reflection->getMethod('getRelations');
        $relationsValue = $relationsMethod->invoke(null);
        
        // If it returns empty array, it shouldn't be implemented
        $isEmptyRelations = empty($relationsValue);
        
        expect($isEmptyRelations)->toBeFalse()->with('StoredEventResource should not implement getRelations() for empty relations');
>>>>>>> 0a00ff2 (.)
=======
>>>>>>> 18dcd64 (.)
    }
});

test('activity resource has correct model configuration', function () {
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> 18dcd64 (.)
    expect(ActivityResource::getModel())->toBe('Modules\\Activity\\Models\\Activity');

    expect(SnapshotResource::getModel())->toBe('Modules\\Activity\\Models\\Snapshot');

    expect(StoredEventResource::getModel())->toBe('Modules\\Activity\\Models\\StoredEvent');
<<<<<<< HEAD
=======
    expect(ActivityResource::getModel())
        ->toBe('Modules\\Activity\\Models\\Activity');
    
    expect(SnapshotResource::getModel())
        ->toBe('Modules\\Activity\\Models\\Snapshot');
    
    expect(StoredEventResource::getModel())
        ->toBe('Modules\\Activity\\Models\\StoredEvent');
>>>>>>> 0a00ff2 (.)
=======
>>>>>>> 18dcd64 (.)
});

test('activity resource form schema returns array', function () {
    $schema = ActivityResource::getFormSchema();
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> 18dcd64 (.)

    expect($schema)->toBeArray()->not->toBeEmpty();

    // Verify it contains expected fields
    expect($schema)->toHaveKeys([
        'log_name',
        'description',
        'subject_type',
        'subject_id',
        'properties',
<<<<<<< HEAD
=======
    
    expect($schema)->toBeArray()->not->toBeEmpty();
    
    // Verify it contains expected fields
    expect($schema)->toHaveKeys([
        'log_name',
        'description', 
        'subject_type',
        'subject_id',
        'properties'
>>>>>>> 0a00ff2 (.)
=======
>>>>>>> 18dcd64 (.)
    ]);
});

test('snapshot resource form schema returns array', function () {
    $schema = SnapshotResource::getFormSchema();
<<<<<<< HEAD
<<<<<<< HEAD

    expect($schema)->toBeArray()->not->toBeEmpty();

=======
    
    expect($schema)->toBeArray()->not->toBeEmpty();
    
>>>>>>> 0a00ff2 (.)
=======

    expect($schema)->toBeArray()->not->toBeEmpty();

>>>>>>> 18dcd64 (.)
    // Verify it contains expected fields
    expect($schema)->toHaveKeys([
        'model_type',
        'model_id',
<<<<<<< HEAD
<<<<<<< HEAD
        'state',
=======
        'state'
>>>>>>> 0a00ff2 (.)
=======
        'state',
>>>>>>> 18dcd64 (.)
    ]);
});

test('stored event resource form schema returns array', function () {
    $schema = StoredEventResource::getFormSchema();
<<<<<<< HEAD
<<<<<<< HEAD

    expect($schema)->toBeArray()->not->toBeEmpty();

=======
    
    expect($schema)->toBeArray()->not->toBeEmpty();
    
>>>>>>> 0a00ff2 (.)
=======

    expect($schema)->toBeArray()->not->toBeEmpty();

>>>>>>> 18dcd64 (.)
    // Verify it contains expected fields
    expect($schema)->toHaveKeys([
        'event_class',
        'event_properties',
<<<<<<< HEAD
<<<<<<< HEAD
        'aggregate_uuid',
=======
        'aggregate_uuid'
>>>>>>> 0a00ff2 (.)
=======
        'aggregate_uuid',
>>>>>>> 18dcd64 (.)
    ]);
});

test('resources use proper xot base resource functionality', function () {
    // Test that the base resource functionality works
    $activityPages = ActivityResource::getPages();
    $snapshotPages = SnapshotResource::getPages();
    $storedEventPages = StoredEventResource::getPages();
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> 18dcd64 (.)

    expect($activityPages)->toHaveKeys(['index', 'create', 'edit']);
    expect($snapshotPages)->toHaveKeys(['index', 'create', 'edit']);
    expect($storedEventPages)->toHaveKeys(['index', 'create', 'edit']);

<<<<<<< HEAD
=======
    
    expect($activityPages)->toHaveKeys(['index', 'create', 'edit']);
    expect($snapshotPages)->toHaveKeys(['index', 'create', 'edit']);
    expect($storedEventPages)->toHaveKeys(['index', 'create', 'edit']);
    
>>>>>>> 0a00ff2 (.)
=======
>>>>>>> 18dcd64 (.)
    // Test relation discovery
    $activityRelations = ActivityResource::getRelations();
    $snapshotRelations = SnapshotResource::getRelations();
    $storedEventRelations = StoredEventResource::getRelations();
<<<<<<< HEAD
<<<<<<< HEAD

=======
    
>>>>>>> 0a00ff2 (.)
=======

>>>>>>> 18dcd64 (.)
    expect($activityRelations)->toBeArray();
    expect($snapshotRelations)->toBeArray();
    expect($storedEventRelations)->toBeArray();
});

test('resources follow xot base resource naming conventions', function () {
    // Test that resource names follow conventions
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> 18dcd64 (.)
    expect(class_basename(ActivityResource::class))->toBe('ActivityResource');

    expect(class_basename(SnapshotResource::class))->toBe('SnapshotResource');

    expect(class_basename(StoredEventResource::class))->toBe('StoredEventResource');

    // Test that model names are correctly derived
    expect(ActivityResource::getModel())->toBe('Modules\\Activity\\Models\\Activity');

    expect(SnapshotResource::getModel())->toBe('Modules\\Activity\\Models\\Snapshot');

    expect(StoredEventResource::getModel())->toBe('Modules\\Activity\\Models\\StoredEvent');
});
<<<<<<< HEAD
=======
    expect(class_basename(ActivityResource::class))
        ->toBe('ActivityResource');
    
    expect(class_basename(SnapshotResource::class))
        ->toBe('SnapshotResource');
    
    expect(class_basename(StoredEventResource::class))
        ->toBe('StoredEventResource');
    
    // Test that model names are correctly derived
    expect(ActivityResource::getModel())
        ->toBe('Modules\\Activity\\Models\\Activity');
    
    expect(SnapshotResource::getModel())
        ->toBe('Modules\\Activity\\Models\\Snapshot');
    
    expect(StoredEventResource::getModel())
        ->toBe('Modules\\Activity\\Models\\StoredEvent');
});
>>>>>>> 0a00ff2 (.)
=======
>>>>>>> 18dcd64 (.)
