<?php

declare(strict_types=1);

use Modules\Activity\Filament\Resources\ActivityResource;
use Modules\Activity\Filament\Resources\SnapshotResource;
use Modules\Activity\Filament\Resources\StoredEventResource;
use Modules\Xot\Filament\Resources\XotBaseResource;

test('activity resources extend xot base resource', function () {
<<<<<<< HEAD
=======
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> b93ef594b4 (.)
>>>>>>> b1cd7fc (.)
    expect(ActivityResource::class)->toBeSubclassOf(XotBaseResource::class);

    expect(SnapshotResource::class)->toBeSubclassOf(XotBaseResource::class);

    expect(StoredEventResource::class)->toBeSubclassOf(XotBaseResource::class);
<<<<<<< HEAD
=======
<<<<<<< HEAD
=======
=======
>>>>>>> origin/develop
    expect(ActivityResource::class)
        ->toBeSubclassOf(XotBaseResource::class);
    
    expect(SnapshotResource::class)
        ->toBeSubclassOf(XotBaseResource::class);
    
    expect(StoredEventResource::class)
        ->toBeSubclassOf(XotBaseResource::class);
<<<<<<< HEAD
>>>>>>> a12f125f4a (.)
=======
>>>>>>> b93ef594b4 (.)
=======
>>>>>>> origin/develop
>>>>>>> b1cd7fc (.)
});

test('activity resource does not implement unnecessary methods', function () {
    $reflection = new ReflectionClass(ActivityResource::class);
<<<<<<< HEAD
=======
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> b93ef594b4 (.)
>>>>>>> b1cd7fc (.)

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
<<<<<<< HEAD
=======
=======
>>>>>>> origin/develop
    
    expect($reflection->hasMethod('getPages'))->toBeFalse()
        ->and($reflection->hasMethod('getRelations'))->toBeFalse()
        ->and($reflection->hasMethod('form'))->toBeFalse()
        ->and($reflection->hasMethod('table'))->toBeFalse();
<<<<<<< HEAD
>>>>>>> a12f125f4a (.)
=======
>>>>>>> b93ef594b4 (.)
=======
>>>>>>> origin/develop
>>>>>>> b1cd7fc (.)
});

test('activity resource implements required getFormSchema method', function () {
    $reflection = new ReflectionClass(ActivityResource::class);
<<<<<<< HEAD
=======
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
>>>>>>> b1cd7fc (.)

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
=======
    
=======

>>>>>>> b93ef594b4 (.)
    expect($reflection->hasMethod('getFormSchema'))->toBeTrue();

    $method = $reflection->getMethod('getFormSchema');
<<<<<<< HEAD
    expect($method->isPublic())->toBeTrue()
        ->and($method->isStatic())->toBeTrue()
        ->and($method->getReturnType()?->getName())->toBe('array');
>>>>>>> a12f125f4a (.)
=======
    expect($method->isPublic())
        ->toBeTrue()
        ->and($method->isStatic())
        ->toBeTrue()
        ->and($method->getReturnType()?->getName())
        ->toBe('array');
>>>>>>> b93ef594b4 (.)
=======
    
    expect($reflection->hasMethod('getFormSchema'))->toBeTrue();
    
    $method = $reflection->getMethod('getFormSchema');
    expect($method->isPublic())->toBeTrue()
        ->and($method->isStatic())->toBeTrue()
        ->and($method->getReturnType()?->getName())->toBe('array');
>>>>>>> origin/develop
>>>>>>> b1cd7fc (.)
});

test('snapshot resource should not implement unnecessary methods', function () {
    $reflection = new ReflectionClass(SnapshotResource::class);
<<<<<<< HEAD
=======
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
>>>>>>> b1cd7fc (.)

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
=======
    
=======

>>>>>>> b93ef594b4 (.)
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
<<<<<<< HEAD
        
        expect($isEmptyRelations)->toBeFalse()->with('SnapshotResource should not implement getRelations() for empty relations');
>>>>>>> a12f125f4a (.)
=======

        expect($isEmptyRelations)
            ->toBeFalse()
            ->with('SnapshotResource should not implement getRelations() for empty relations');
>>>>>>> b93ef594b4 (.)
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
>>>>>>> origin/develop
>>>>>>> b1cd7fc (.)
    }
});

test('stored event resource should not implement unnecessary methods', function () {
    $reflection = new ReflectionClass(StoredEventResource::class);
<<<<<<< HEAD
=======
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
>>>>>>> b1cd7fc (.)

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
=======
    
=======

>>>>>>> b93ef594b4 (.)
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
<<<<<<< HEAD
        
        expect($isEmptyRelations)->toBeFalse()->with('StoredEventResource should not implement getRelations() for empty relations');
>>>>>>> a12f125f4a (.)
=======

        expect($isEmptyRelations)
            ->toBeFalse()
            ->with('StoredEventResource should not implement getRelations() for empty relations');
>>>>>>> b93ef594b4 (.)
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
>>>>>>> origin/develop
>>>>>>> b1cd7fc (.)
    }
});

test('activity resource has correct model configuration', function () {
<<<<<<< HEAD
=======
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> b93ef594b4 (.)
>>>>>>> b1cd7fc (.)
    expect(ActivityResource::getModel())->toBe('Modules\\Activity\\Models\\Activity');

    expect(SnapshotResource::getModel())->toBe('Modules\\Activity\\Models\\Snapshot');

    expect(StoredEventResource::getModel())->toBe('Modules\\Activity\\Models\\StoredEvent');
<<<<<<< HEAD
=======
<<<<<<< HEAD
=======
=======
>>>>>>> origin/develop
    expect(ActivityResource::getModel())
        ->toBe('Modules\\Activity\\Models\\Activity');
    
    expect(SnapshotResource::getModel())
        ->toBe('Modules\\Activity\\Models\\Snapshot');
    
    expect(StoredEventResource::getModel())
        ->toBe('Modules\\Activity\\Models\\StoredEvent');
<<<<<<< HEAD
>>>>>>> a12f125f4a (.)
=======
>>>>>>> b93ef594b4 (.)
=======
>>>>>>> origin/develop
>>>>>>> b1cd7fc (.)
});

test('activity resource form schema returns array', function () {
    $schema = ActivityResource::getFormSchema();
<<<<<<< HEAD
=======
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
>>>>>>> b1cd7fc (.)

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
=======
    
=======

>>>>>>> b93ef594b4 (.)
    expect($schema)->toBeArray()->not->toBeEmpty();

    // Verify it contains expected fields
    expect($schema)->toHaveKeys([
        'log_name',
        'description',
        'subject_type',
        'subject_id',
<<<<<<< HEAD
        'properties'
>>>>>>> a12f125f4a (.)
=======
        'properties',
>>>>>>> b93ef594b4 (.)
=======
    
    expect($schema)->toBeArray()->not->toBeEmpty();
    
    // Verify it contains expected fields
    expect($schema)->toHaveKeys([
        'log_name',
        'description', 
        'subject_type',
        'subject_id',
        'properties'
>>>>>>> origin/develop
>>>>>>> b1cd7fc (.)
    ]);
});

test('snapshot resource form schema returns array', function () {
    $schema = SnapshotResource::getFormSchema();
<<<<<<< HEAD

    expect($schema)->toBeArray()->not->toBeEmpty();

=======
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD

    expect($schema)->toBeArray()->not->toBeEmpty();

=======
    
    expect($schema)->toBeArray()->not->toBeEmpty();
    
>>>>>>> a12f125f4a (.)
=======

    expect($schema)->toBeArray()->not->toBeEmpty();

>>>>>>> b93ef594b4 (.)
=======
    
    expect($schema)->toBeArray()->not->toBeEmpty();
    
>>>>>>> origin/develop
>>>>>>> b1cd7fc (.)
    // Verify it contains expected fields
    expect($schema)->toHaveKeys([
        'model_type',
        'model_id',
<<<<<<< HEAD
        'state',
=======
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
        'state',
=======
        'state'
>>>>>>> a12f125f4a (.)
=======
        'state',
>>>>>>> b93ef594b4 (.)
=======
        'state'
>>>>>>> origin/develop
>>>>>>> b1cd7fc (.)
    ]);
});

test('stored event resource form schema returns array', function () {
    $schema = StoredEventResource::getFormSchema();
<<<<<<< HEAD

    expect($schema)->toBeArray()->not->toBeEmpty();

=======
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD

    expect($schema)->toBeArray()->not->toBeEmpty();

=======
    
    expect($schema)->toBeArray()->not->toBeEmpty();
    
>>>>>>> a12f125f4a (.)
=======

    expect($schema)->toBeArray()->not->toBeEmpty();

>>>>>>> b93ef594b4 (.)
=======
    
    expect($schema)->toBeArray()->not->toBeEmpty();
    
>>>>>>> origin/develop
>>>>>>> b1cd7fc (.)
    // Verify it contains expected fields
    expect($schema)->toHaveKeys([
        'event_class',
        'event_properties',
<<<<<<< HEAD
        'aggregate_uuid',
=======
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
        'aggregate_uuid',
=======
        'aggregate_uuid'
>>>>>>> a12f125f4a (.)
=======
        'aggregate_uuid',
>>>>>>> b93ef594b4 (.)
=======
        'aggregate_uuid'
>>>>>>> origin/develop
>>>>>>> b1cd7fc (.)
    ]);
});

test('resources use proper xot base resource functionality', function () {
    // Test that the base resource functionality works
    $activityPages = ActivityResource::getPages();
    $snapshotPages = SnapshotResource::getPages();
    $storedEventPages = StoredEventResource::getPages();
<<<<<<< HEAD
=======
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
>>>>>>> b1cd7fc (.)

    expect($activityPages)->toHaveKeys(['index', 'create', 'edit']);
    expect($snapshotPages)->toHaveKeys(['index', 'create', 'edit']);
    expect($storedEventPages)->toHaveKeys(['index', 'create', 'edit']);

<<<<<<< HEAD
=======
=======
=======
>>>>>>> origin/develop
    
    expect($activityPages)->toHaveKeys(['index', 'create', 'edit']);
    expect($snapshotPages)->toHaveKeys(['index', 'create', 'edit']);
    expect($storedEventPages)->toHaveKeys(['index', 'create', 'edit']);
    
<<<<<<< HEAD
>>>>>>> a12f125f4a (.)
=======

    expect($activityPages)->toHaveKeys(['index', 'create', 'edit']);
    expect($snapshotPages)->toHaveKeys(['index', 'create', 'edit']);
    expect($storedEventPages)->toHaveKeys(['index', 'create', 'edit']);

>>>>>>> b93ef594b4 (.)
=======
>>>>>>> origin/develop
>>>>>>> b1cd7fc (.)
    // Test relation discovery
    $activityRelations = ActivityResource::getRelations();
    $snapshotRelations = SnapshotResource::getRelations();
    $storedEventRelations = StoredEventResource::getRelations();
<<<<<<< HEAD

=======
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD

=======
    
>>>>>>> a12f125f4a (.)
=======

>>>>>>> b93ef594b4 (.)
=======
    
>>>>>>> origin/develop
>>>>>>> b1cd7fc (.)
    expect($activityRelations)->toBeArray();
    expect($snapshotRelations)->toBeArray();
    expect($storedEventRelations)->toBeArray();
});

test('resources follow xot base resource naming conventions', function () {
    // Test that resource names follow conventions
<<<<<<< HEAD
=======
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> b93ef594b4 (.)
>>>>>>> b1cd7fc (.)
    expect(class_basename(ActivityResource::class))->toBe('ActivityResource');

    expect(class_basename(SnapshotResource::class))->toBe('SnapshotResource');

    expect(class_basename(StoredEventResource::class))->toBe('StoredEventResource');

<<<<<<< HEAD
=======
<<<<<<< HEAD
>>>>>>> b1cd7fc (.)
    // Test that model names are correctly derived
    expect(ActivityResource::getModel())->toBe('Modules\\Activity\\Models\\Activity');

    expect(SnapshotResource::getModel())->toBe('Modules\\Activity\\Models\\Snapshot');

    expect(StoredEventResource::getModel())->toBe('Modules\\Activity\\Models\\StoredEvent');
});
<<<<<<< HEAD
=======
=======
=======
>>>>>>> origin/develop
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
<<<<<<< HEAD
});
>>>>>>> a12f125f4a (.)
=======
    // Test that model names are correctly derived
    expect(ActivityResource::getModel())->toBe('Modules\\Activity\\Models\\Activity');

    expect(SnapshotResource::getModel())->toBe('Modules\\Activity\\Models\\Snapshot');

    expect(StoredEventResource::getModel())->toBe('Modules\\Activity\\Models\\StoredEvent');
});
>>>>>>> b93ef594b4 (.)
=======
});
>>>>>>> origin/develop
>>>>>>> b1cd7fc (.)
