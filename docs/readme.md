# Modulo Activity - Documentazione

## Descrizione

Modulo per il tracciamento delle attività degli utenti e la gestione di log delle azioni nel sistema PTVX. Utilizza il package Spatie Activity Log per registrare e visualizzare le modifiche sui modelli Eloquent.

## Caratteristiche Principali

- Tracciamento automatico delle attività sui modelli
- Visualizzazione storico modifiche con interfaccia Filament
- Ripristino di versioni precedenti dei record
- Integrazione con Event Sourcing di Spatie
- Pagina custom per visualizzare le attività di ogni record

## Struttura del Modulo

```
Activity/
├── app/
│   ├── Filament/
│   │   ├── Actions/
│   │   │   └── ListLogActivitiesAction.php (action per visualizzare attività)
│   │   └── Pages/
│   │       ├── ListLogActivities.php (classe base per activity log)
│   │       └── Concerns/
│   │           └── CanPaginate.php
│   ├── Providers/
│   │   ├── ActivityServiceProvider.php
│   │   └── Filament/
│   │       └── AdminPanelProvider.php
├── resources/
│   └── views/
│       └── filament/
│           └── pages/
│               └── list-log-activities.blade.php
├── config/
│   └── config.php
└── docs/
    ├── README.md
    └── errori/
        └── no-hint-path-defined.md
```

## ServiceProvider

Il modulo utilizza `ActivityServiceProvider` che estende `XotBaseServiceProvider`. Questo garantisce la corretta registrazione di:

- **View namespace**: `activity::` per le view blade
- **Traduzioni**: namespace `activity` per i file di lingua
- **Configurazioni**: merge del file config/config.php
- **Migrazioni**: caricamento automatico delle migration
- **Blade Icons**: registrazione icone SVG custom

### Configurazione ServiceProvider

```php
<?php

namespace Modules\Activity\Providers;

use Modules\Xot\Providers\XotBaseServiceProvider;

class ActivityServiceProvider extends XotBaseServiceProvider
{
    public string $name = 'Activity'; // Nome modulo (PascalCase)
    protected string $module_dir = __DIR__;
    protected string $module_ns = __NAMESPACE__;
}
```

## Dipendenze

- **Modulo Xot**: Base framework per tutti i moduli
- **Modulo User**: Per tracciare gli utenti che eseguono le azioni
- **spatie/laravel-activitylog**: Core per il tracciamento attività
- **spatie/laravel-event-sourcing**: Event sourcing pattern
- **spatie/laravel-translatable**: Per campi multilingua (se necessario)

## Componenti Forniti

### 1. ListLogActivities (Pagina Base)

Classe astratta base per visualizzare lo storico attività di un record.

**Regola Critica**: Estende `Modules\Xot\Filament\Pages\XotBasePage`, **NON** `Filament\Pages\Page` direttamente.

**Uso**: Estendere questa classe per creare una pagina custom di activity log.

```php
<?php

namespace Modules\IndennitaResponsabilita\Filament\Resources\IndennitaResponsabilitaResource\Pages;

use Modules\Activity\Filament\Pages\ListLogActivities;
use Modules\IndennitaResponsabilita\Filament\Resources\IndennitaResponsabilitaResource;

class ListSchedaLogActivities extends ListLogActivities
{
    protected static string $resource = IndennitaResponsabilitaResource::class;
}
```

### 2. ListLogActivitiesAction (Table Action)

Action Filament completa per aggiungere un pulsante "Cronologia" in qualsiasi tabella.

**Caratteristiche**:
- **Modal Preview**: Mostra anteprima delle ultime 5 attività
- **Auto-Discovery**: Trova automaticamente la pagina delle attività per il modello
- **Navigation**: Navigazione diretta alla pagina completa delle attività
- **Traduzioni Complete**: Supporto multilingua (IT/EN/DE)
- **Responsive Design**: Ottimizzato per mobile e desktop

**Uso**: Aggiungere nelle table actions di una Resource:

```php
<?php

namespace Modules\IndennitaResponsabilita\Filament\Resources\IndennitaResponsabilitaResource;

use Modules\Activity\Filament\Actions\ListLogActivitiesAction;
use Modules\Xot\Filament\Resources\XotBaseResource;

class IndennitaResponsabilitaResource extends XotBaseResource
{
    protected function getTableActions(): array
    {
        return [
            ListLogActivitiesAction::make(),
        ];
    }
}
```

**Documentazione completa**: [ListLogActivitiesAction](./actions/list-log-activities-action.md)

## Regole Critiche Laraxot

### 🚫 **Estensioni Classi Filament Vietate**
**Nel modulo Activity:**
- ❌ `extends Filament\Pages\Page` → VIETATO
- ❌ `extends Filament\Actions\Action` → VIETATO
- ✅ `extends Modules\Xot\Filament\Pages\XotBasePage` → CORRETTO
- ✅ `extends Modules\Xot\Filament\Actions\XotBaseAction` → CORRETTO

### 🚫 **Proprietà Vietate**
**Chi estende `XotBasePage` NON DEVE avere:**
```php
// ❌ VIETATO
protected static ?string $navigationIcon = 'heroicon-o-clock';
protected static ?string $title = 'Cronologia';
protected static ?string $navigationLabel = 'Attività';
```

### 🚫 **Traduzioni Hardcoded Vietate**
**NON usare mai:**
```php
// ❌ VIETATO
Action::make('view')->label('Visualizza')
TextColumn::make('event')->tooltip('Evento')
```

**✅ Traduzioni gestite automaticamente:**
```php
// ✅ CORRETTO
Action::make('view')
TextColumn::make('event')
```

### ✅ **Pattern Corretto per Actions**
```php
<?php

use Modules\Xot\Filament\Actions\XotBaseAction;

class ListLogActivitiesAction extends XotBaseAction
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->label(__('activity::actions.list_log_activities.label'))
            ->icon('heroicon-o-clock')
            ->color('gray')
            ->url(fn (Model $record) => ActivityPage::getUrl(['record' => $record]));
    }
}
```

## Errori Comuni

### No hint path defined for [activity]

Questo errore può avere diverse cause. Consultare la documentazione appropriata:

1. **[Modulo Disabilitato](./errori/modulo-disabilitato.md)** ⭐ **CASO PIÙ COMUNE**
   - Il modulo Activity è disabilitato nel sistema
   - Soluzione: `php artisan module:enable Activity`
   
2. **[Errore Completo "No hint path defined"](./errori/no-hint-path-defined.md)**
   - ServiceProvider non caricato
   - Cache Laravel stale
   - Configurazione errata
   - 6 cause possibili con soluzioni complete

**Diagnosi Rapida**:
```bash
# Verificare se modulo è abilitato
php artisan module:list | grep Activity

# Se disabilitato → soluzione 1
# Se abilitato → soluzione 2
```

### Duplicate Entry Durante Edit con Activity Log

⚠️ **ERRORE CRITICO** - Activity Log temporaneamente disabilitato in `BaseScheda`

**Errore**: `SQLSTATE[23000]: Integrity constraint violation: 1062 Duplicate entry 'XXX' for key 'PRIMARY'`

**Causa**: SchedaTrait ha 15+ accessor che chiamano `$this->save()` al loro interno. Quando Activity Log fa `$model->toArray()` per serializzare le properties, triggera questi accessor, causando errori di Duplicate Entry.

**Status**: 
- ❌ Activity Log DISABILITATO in BaseScheda (IndennitaResponsabilita, Progressioni, etc.)
- ✅ Edit funziona correttamente senza errore
- ⏳ Refactoring SchedaTrait in pianificazione

**Documentazione Completa**: 
- [Duplicate Entry Error - Analisi](./errori/duplicate-entry-accessor-save.md)
- [Status Attuale Activity Module](./current-status.md)
- [SchedaTrait Refactoring Plan](../../Sigma/docs/refactoring/scheda-trait-accessor-save-issue.md)

## Collegamenti Documentazione

### Documentazione Interna
- [Filament Actions - Guida Uso](./filament-actions-usage.md)
- [ListLogActivitiesAction - Table Action](./actions/list-log-activities-action.md)

### Errori e Fix
- [Errore: route() Method Does Not Exist](./errori/route-method-does-not-exist.md) ⚠️ **CRITICO**
- [Errore: Modulo Disabilitato](./errori/modulo-disabilitato.md)
- [Errore: No Hint Path Defined](./errori/no-hint-path-defined.md)

### Altri Moduli
- [IndennitaResponsabilita - Integrazione Activity Log](../../IndennitaResponsabilita/docs/activity-log-integration.md)
- [Xot - README](../../Xot/docs/README.md)
- [Xot - Service Provider Architecture](../../Xot/docs/service-provider-architecture.md)
- [UI - Componenti](../../UI/docs/README.md)

### Guide Generali
- [Laraxot Conventions](../../../docs/laraxot-conventions.md)
- [Spatie Translatable](../../../docs/spatie-translatable.md)

## Testing

Il modulo include test completi per:

### Test Unitari
- **ListLogActivitiesActionTest**: Test completi per l'Action di visualizzazione attività
- Registrazione corretta del ServiceProvider
- Caricamento view con namespace corretto
- Tracciamento attività sui modelli
- Visualizzazione pagina activity log

### Test Actions
- Istanziamento corretto dell'Action
- Configurazione proprietà (icona, colore, URL)
- Auto-discovery Resource e pagina appropriata
- Estrazione etichette campi
- Gestione record senza attività
- Generazione contenuto modal con attività
- Navigazione corretta

```bash
# Eseguire tutti i test del modulo
php artisan test --filter=Activity

# Eseguire solo i test delle Actions
php artisan test --filter=ListLogActivitiesActionTest

# Eseguire solo i test di conformità PHPStan
php artisan test --filter=PHPStanComplianceTest

# Eseguire solo i test di qualità del codice
php artisan test --filter=CodeQualityTest

# Analizzare qualità del codice con PHPInsights
./vendor/bin/phpinsights analyze Modules/Activity --no-interaction

# Eseguire test specifici
php artisan test --filter="test_can_instantiate_action"
```

## Manutenzione

### Aggiungere Nuovo Campo Tracciato

1. Aggiungere il campo al modello nel metodo `getActivityLogOptions()`
2. Aggiungere traduzione etichetta campo
3. Aggiornare test per il nuovo campo

### Estendere Funzionalità Activity Log

1. Creare nuova classe in `app/Filament/Pages/`
2. Estendere `ListLogActivities`
3. Personalizzare metodi necessari (es. `getActivities()`)
4. Registrare route in `RouteServiceProvider`

## Note Importanti

- Il namespace delle view DEVE essere in lowercase (`activity::`)
- Il nome del modulo nel ServiceProvider DEVE essere PascalCase (`Activity`)
- Le view DEVONO essere in `resources/views/`
- Il ServiceProvider DEVE chiamare `parent::boot()` per registrare le view

---

**Autore**: Sistema di documentazione automatica
**Versione**: 1.0

