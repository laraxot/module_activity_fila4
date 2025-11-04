# Activity Module - Spatie Laravel Activity Log Integration

## 📋 Overview

Modulo per il tracking completo delle attività utente utilizzando `spatie/laravel-activitylog`.

**Pacchetto:** [spatie/laravel-activitylog](https://github.com/spatie/laravel-activitylog) v4.10.2  
**Namespace:** `Modules\Activity`  
**Database:** `activity_log` table

---

## 🎯 Funzionalità Principali

### 1. Activity Log Automatico

- ✅ Tracking automatico modifiche modelli Eloquent
- ✅ Log eventi custom (email, PDF, export, etc.)
- ✅ Tracking utente autenticato (causedBy)
- ✅ Associazione a record specifico (performedOn)
- ✅ Properties JSON strutturate

### 2. Filament Integration

- ✅ `ListLogActivitiesAction` - Visualizza storico attività
- ✅ `ListLogActivities` Page - Pagina dettaglio attività
- ✅ Tabella formattata con filtri e ricerca
- ✅ Navigazione fluida tra Resource e Activity Log

### 3. Models

- ✅ `Activity` - Model activity log Spatie

---

## 🏗️ Struttura

```
Modules/Activity/
├── app/
│   ├── Filament/
│   │   ├── Actions/
│   │   │   └── ListLogActivitiesAction.php ⭐ Action per visualizzare log
│   │   ├── Pages/
│   │   │   └── ListLogActivities.php        Pagina dettaglio attività
│   │   └── Resources/
│   │       └── ActivityResource/
│   │           └── Pages/
│   │               └── ListActivities.php   Tabella tutte le attività
│   ├── Models/
│   │   └── Activity.php                     Model Spatie Activity
│   └── Providers/
│       └── ActivityServiceProvider.php      Service Provider
├── docs/
│   ├── README.md                            Questo file
│   ├── business-logic-analysis.md           Analisi logica business
│   ├── bugfix-filament-facade-namespace.md  ⭐ Bugfix namespace facade
│   └── use-cases/
│       └── tracking-email-sent-schede.md    Use case email schede
└── database/
    └── migrations/
        └── create_activity_log_table.php
```

---

## 🚀 Utilizzo

### 1. Logging Manuale

```php
use function activity;

// Log activity semplice
activity()
    ->log('Utente ha visualizzato il report');

// Log con record e utente
activity()
    ->performedOn($record)
    ->causedBy($user)
    ->log('Record modificato');

// Log con properties strutturate
activity()
    ->performedOn($record)
    ->causedBy($user)
    ->withProperties([
        'old' => ['status' => 'draft'],
        'new' => ['status' => 'published'],
    ])
    ->log('Status cambiato');
```

### 2. Filament Action in Resource

```php
use Modules\Activity\Filament\Actions\ListLogActivitiesAction;

class MyResource extends XotBaseResource
{
    public function getTableActions(): array
    {
        return [
            'log_activity' => ListLogActivitiesAction::make(),
            // Altre actions...
        ];
    }
}
```

### 3. Filament Page per Activity Log

```php
// In MyResource.php
public static function getPages(): array
{
    return [
        'index' => Pages\ListRecords::route('/'),
        'create' => Pages\CreateRecord::route('/create'),
        'edit' => Pages\EditRecord::route('/{record}/edit'),
        'log-activity' => Pages\ListLogActivities::route('/{record}/log-activity'),
    ];
}
```

---

## 📊 Database Schema

### Tabella `activity_log`

```sql
CREATE TABLE `activity_log` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `log_name` varchar(255) DEFAULT NULL,
  `description` text NOT NULL,
  `subject_type` varchar(255) DEFAULT NULL,
  `subject_id` bigint unsigned DEFAULT NULL,
  `causer_type` varchar(255) DEFAULT NULL,
  `causer_id` bigint unsigned DEFAULT NULL,
  `properties` json DEFAULT NULL,
  `batch_uuid` char(36) DEFAULT NULL,
  `event` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `subject` (`subject_type`,`subject_id`),
  KEY `causer` (`causer_type`,`causer_id`),
  KEY `activity_log_log_name_index` (`log_name`)
);
```

### Properties JSON Structure

```json
{
  "old": {
    "status": "draft"
  },
  "attributes": {
    "status": "published"
  },
  "custom_data": {
    "reason": "Manual approval",
    "approved_by": 123
  }
}
```

---

## 🎯 Use Cases

### 1. Email Tracking (Schede Valutazione)

**File:** [use-cases/tracking-email-sent-schede.md](./use-cases/tracking-email-sent-schede.md)

```php
activity()
    ->performedOn($scheda)
    ->causedBy($user)
    ->withProperties([
        'recipient' => 'user@example.com',
        'template' => 'schede',
        'filename' => 'scheda_123.pdf',
        'evaluation_data' => [
            'matr' => '12345',
            'cognome' => 'Rossi',
            // ...
        ],
    ])
    ->log('Email inviata per scheda');
```

### 2. Data Export Tracking

```php
activity()
    ->causedBy($user)
    ->withProperties([
        'format' => 'xlsx',
        'filters' => ['year' => 2024],
        'records_count' => 1500,
    ])
    ->log('Export dati eseguito');
```

### 3. PDF Generation Tracking

```php
activity()
    ->performedOn($record)
    ->causedBy($user)
    ->withProperties([
        'template' => 'report_valutazione',
        'pdf_size' => 245678,
    ])
    ->log('PDF generato');
```

---

## 🐛 Bugfix e Troubleshooting

### Errore: "Class Filament\Support\Facades\Filament not found"

**Causa:** Namespace facade errato (Filament 2.x vs 4.x)

**Versione Progetto:** Filament v4.2.0

**Fix:**
```php
// ❌ ERRATO (Filament 2.x)
use Filament\Support\Facades\Filament;

// ✅ CORRETTO (Filament 4.x)
use Filament\Facades\Filament;
```

**Nota Filament 4.x:** Parametro `panel:` rimosso da `getUrl()`:
```php
// ✅ CORRETTO (panel automatico dal contesto)
$resource::getUrl('edit', ['record' => $record]);
```

**Documentazione:** [bugfix-filament-facade-namespace.md](./bugfix-filament-facade-namespace.md)

---

## 📚 Collegamenti

### Documentazione Interna

- [Business Logic Analysis](./business-logic-analysis.md)
- [Bugfix Filament Facade](./bugfix-filament-facade-namespace.md)
- [Use Case: Email Tracking](./use-cases/tracking-email-sent-schede.md)

### Documentazione Esterna

- [Spatie Laravel Activity Log](https://spatie.be/docs/laravel-activitylog)
- [Filament 4.x Documentation](https://filamentphp.com/docs/4.x)
- [Filament 4.x Upgrade Guide](https://filamentphp.com/docs/4.x/panels/upgrade-guide)

### Altri Moduli

- [Ptv Module - Activity Log Email](../../Ptv/docs/activity-log-final-summary.md)
- [Xot Module - Filament Best Practices](../../Xot/docs/FILAMENT-BEST-PRACTICES.md)

---

## 🎓 Best Practices

### 1. Properties Strutturate

```php
// ✅ CORRETTO: Properties strutturate
activity()
    ->withProperties([
        'action_type' => 'email_sent',
        'metadata' => [
            'recipient' => 'user@example.com',
            'template' => 'welcome',
        ],
        'business_data' => [
            'entity_id' => 123,
            'entity_type' => 'Scheda',
        ],
    ])
    ->log('Email inviata');

// ❌ ERRATO: Properties piatte
activity()
    ->withProperties([
        'recipient' => 'user@example.com',
        'template' => 'welcome',
        'entity_id' => 123,
    ])
    ->log('Email inviata');
```

### 2. Description Standardizzate

```php
// ✅ CORRETTO: Description chiare e specifiche
activity()->log('Email scheda valutazione inviata con successo');
activity()->log('PDF report generato');
activity()->log('Dati esportati in formato Excel');

// ❌ ERRATO: Description generiche
activity()->log('Azione eseguita');
activity()->log('Operazione completata');
```

### 3. Namespace Facade e API Filament 4.x

**Versione Progetto:** Filament v4.2.0

```php
// ✅ SEMPRE usare Filament 4.x namespace
use Filament\Facades\Filament;

// ❌ MAI usare Filament 2.x namespace
use Filament\Support\Facades\Filament;
```

**Filament 4.x Breaking Change:**
```php
// ✅ CORRETTO (v4.x - panel automatico)
$resource::getUrl('edit', ['record' => $record]);

// ❌ OBSOLETO (v3.x - parametro panel rimosso)
$resource::getUrl('edit', ['record' => $record], panel: $panelId);
```

---

## 🔄 Prossimi Sviluppi

- [ ] Activity Log API REST
- [ ] Export attività in CSV/Excel
- [ ] Dashboard analytics attività
- [ ] Notifiche real-time attività critiche
- [ ] Retention policy automatica (GDPR)
- [ ] Activity Log bulk operations

---

**Ultimo Aggiornamento:** 2025-01-22  
**Versione:** 1.0.0  
**Status:** ✅ Production Ready
