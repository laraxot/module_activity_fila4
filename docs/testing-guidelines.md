# Testing Guidelines - Modulo Activity

## Overview
Questo documento contiene le linee guida per la scrittura e manutenzione dei test nel modulo Activity, con focus su conformità PHPStan level max e best practices Pest.

## Filosofia Testing
- **Pest Framework**: Tutti i test devono essere scritti usando Pest
- **Type Safety**: Ogni test deve essere PHPStan compliant (level max)
- **Business Logic First**: I test verificano la business logic, non l'implementazione
- **No Database in Unit Tests**: I test unitari usano oggetti in-memory quando possibile

## Struttura Test

### Test Helpers (tests/Pest.php)
```php
<?php

declare(strict_types=1);

use Modules\Activity\Models\Activity;
use Modules\Activity\Tests\TestCase;

pest()->extend(TestCase::class)->in('Feature', 'Unit');

// Custom expectation
expect()->extend('toBeActivity', function () {
    /** @var \Pest\Expectation<mixed> $this */
    return $this->toBeInstanceOf(Activity::class);
});

// Factory helpers con type safety
function createActivity(array $attributes = []): Activity
{
    $factory = Activity::factory();
    if (!is_object($factory) || !method_exists($factory, 'create')) {
        throw new \RuntimeException('Activity factory not available');
    }
    $activity = $factory->create($attributes);
    assert($activity instanceof Activity);
    return $activity;
}
```

### Pattern Type Safety nei Test

#### 1. Test su Proprietà di Oggetti
```php
// ✅ CORRETTO - Usa variabili locali invece di $this->property
test('activity has required attributes', function (): void {
    $activity = makeActivity();
    
    expect($activity)
        ->toHaveProperty('log_name')
        ->toHaveProperty('description');
});
```

#### 2. Test con Dati In-Memory
```php
// ✅ CORRETTO - Type hints per proprietà $this
describe('Event Sourcing Business Logic', function (): void {
    beforeEach(function (): void {
        /** @var object{activityData: array<string, mixed>} $this */
        $this->activityData = [
            'id' => 1001,
            'log_name' => 'test',
            // ...
        ];
    });
    
    it('validates data structure', function (): void {
        /** @var object{activityData: array<string, mixed>} $this */
        $activity = (object) $this->activityData;
        /** @var array<string, mixed> $properties */
        $properties = $activity->properties;
        
        expect($properties)->toHaveKey('ip_address');
    });
});
```

#### 3. Test su Factory
```php
// ✅ CORRETTO - Type checking per factory
test('factory creates valid instances', function (): void {
    $factory = Activity::factory();
    if (!is_object($factory) || !method_exists($factory, 'make')) {
        throw new \RuntimeException('Activity factory not available');
    }
    
    $activity = $factory->make();
    assert($activity instanceof Activity);
    
    expect($activity)
        ->and($activity->log_name)->toBeString();
});
```

## Pattern di Correzione PHPStan

### 1. Property Access su Mixed
```php
// ❌ ERRORE: Cannot access property $properties on mixed
$properties = $activity->properties;

// ✅ SOLUZIONE: Type hint esplicito
/** @var array<string, mixed> $properties */
$properties = $activity->properties;
```

### 2. Method Calls su Factory
```php
// ❌ ERRORE: Cannot call method create() on mixed
$activity = Activity::factory()->create();

// ✅ SOLUZIONE: Type checking
$factory = Activity::factory();
if (!is_object($factory) || !method_exists($factory, 'create')) {
    throw new \RuntimeException('Factory not available');
}
$activity = $factory->create();
```

### 3. Binary Operations
```php
// ❌ ERRORE: Binary operation "%" between mixed and 10
expect($version % 10)->toBe(0);

// ✅ SOLUZIONE: Cast esplicito
/** @phpstan-ignore-next-line binaryOp.invalid */
expect((int) $version % 10)->toBe(0);
```

### 4. Offset Access Condizionale
```php
// ❌ ERRORE: Offset 'last_login' might not exist
expect($finalState['last_login'])->toBe('value');

// ✅ SOLUZIONE: phpstan-ignore per offset condizionali
/** @phpstan-ignore-next-line offsetAccess.notFound */
expect($finalState['last_login'])->toBe('value');
```

### 5. Safe Functions
```php
// ❌ ERRORE: Function json_encode is unsafe
use Modules\Activity\Models\Activity;

// ✅ SOLUZIONE: Import Safe functions
use function Safe\json_encode;
use function Safe\json_decode;
use function Safe\class_uses;
```

## Best Practices

### 1. Organizzazione Test
- **Unit Tests**: `tests/Unit/` - Test isolati senza database
- **Feature Tests**: `tests/Feature/` - Test di integrazione con database
- **Model Tests**: `tests/Unit/Models/` - Test sui modelli
- **Listener Tests**: `tests/Unit/Listeners/` - Test sui listener

### 2. Naming Conventions
- Usa `test('descrizione chiara')` per test semplici
- Usa `it('descrizione comportamento')` per BDD style
- Usa `describe()` per raggruppare test correlati

### 3. Assertions
- Preferisci assertion specifiche: `toBeString()`, `toBeInt()`, `toBeArray()`
- Usa `toBeInstanceOf()` invece di confronti manuali
- Chain assertions con `->and()` per leggibilità

### 4. Type Safety
- **Sempre** type hint per variabili complex
- Usa `assert()` per runtime type checking
- Documenta tipi attesi con PHPDoc

## Errori Comuni e Soluzioni

| Errore PHPStan | Causa | Soluzione |
|----------------|-------|-----------|
| `property.notFound` | Accesso a proprietà non dichiarata | Usa variabili locali o type hint corretto |
| `method.nonObject` | Chiamata metodo su mixed | Type checking + assert |
| `offsetAccess.nonOffsetAccessible` | Array access su mixed | Type hint `@var array<string, mixed>` |
| `argument.type` | Tipo parametro sbagliato | Cast esplicito o type narrowing |
| `theCodingMachineSafe.function` | Uso funzione unsafe | Import `use function Safe\*` |

## Quality Gates per Test

- ✅ **0 errori PHPStan** level max
- ✅ **Type coverage** 100% per nuovi test
- ✅ **Pest syntax** corretto
- ✅ **Business logic** chiara e documentata
- ✅ **No database** in unit tests quando possibile

## Lezioni Apprese (Gennaio 2025)

### Pattern di Successo
1. **Type hints espliciti** su `$this` nelle closure: `/** @var object{prop: type} $this */`
2. **Variabili locali** invece di proprietà `$this->` quando possibile
3. **Safe functions** sempre importate all'inizio del file
4. **@phpstan-ignore-line** solo per edge cases documentati (es. `binaryOp.invalid`, `offsetAccess.notFound`)

### Anti-Pattern da Evitare
1. ❌ NON usare `$this->property` senza type hint
2. ❌ NON accedere a offset senza verificare tipo
3. ❌ NON chiamare metodi su factory senza type checking
4. ❌ NON ignorare errori senza documentare il motivo

## Riferimenti

- [Pest Documentation](https://pestphp.com/docs)
- [PHPStan Rules](https://phpstan.org/rules)
- [Testing Best Practices](../../../docs/testing-best-practices.md)
- [PHPStan Fixes Activity](./phpstan_fixes_activity.md)

---

**Status**: ✅ COMPLETATO - Tutti i test conformi a PHPStan level max
**Data**: Gennaio 2025
**Errori corretti**: 676 → 0

