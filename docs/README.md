# Modulo Activity - Documentazione Completa

[![Laravel 12.x](https://img.shields.io/badge/Laravel-12.x-red.svg)](https://laravel.com/)
[![Filament 4.x](https://img.shields.io/badge/Filament-4.x-blue.svg)](https://filamentphp.com/)
[![PHPStan Level 10](https://img.shields.io/badge/PHPStan-Level%2010-brightgreen.svg)](https://phpstan.org/)
[![Translation Ready](https://img.shields.io/badge/Translation-IT%20%7C%20EN%20%7C%20DE-green.svg)](https://laravel.com/docs/localization)
[![Event Sourcing Ready](https://img.shields.io/badge/Event-Sourcing%20Ready-orange.svg)](https://martinfowler.com/eaaDev/EventSourcing.html)
[![Audit Trail](https://img.shields.io/badge/Audit-Trail%20Ready-yellow.svg)](https://en.wikipedia.org/wiki/Audit_trail)

##  Stato del Modulo

> **🚀 Modulo Activity**: Sistema completo per audit trail, event sourcing e logging avanzato con dashboard Filament e analytics in tempo reale.

**Pacchetto:** [spatie/laravel-activitylog](https://github.com/spatie/laravel-activitylog) v4.10.2  
**Namespace:** `Modules\Activity`  

## 📋 Panoramica

Il modulo **Activity** è il sistema di monitoraggio e audit dell'applicazione, fornendo:

- 📊 **Audit Trail Completo** - Tracciamento di tutte le attività utente.
- 🎯 **Event Sourcing** - Concetti di base per un sistema di eventi per ricostruzione stato.
- 📈 **Analytics Dashboard** - Dashboard Filament per analisi attività.
- 🔍 **Advanced Filtering** - Filtri avanzati per ricerca attività.
- 🔐 **Security Compliance** - Strumenti per conformità GDPR e sicurezza.

---

## 🏗️ Struttura del Modulo

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
│   └── README.md                            Questo file
└── database/
    └── migrations/
        └── create_activity_log_table.php    Migrazione per la tabella activity_log
```

---

## 🚀 Quick Start

### 📦 Installazione

```bash
# Abilitare il modulo
php artisan module:enable Activity

# Eseguire le migrazioni per creare la tabella `activity_log`
php artisan migrate
```

### ⚙️ Configurazione Base

Il logging delle attività dei modelli Eloquent è una delle funzionalità più potenti.

```php
// Esempio: tracciare le modifiche su un modello
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class User extends Model
{
    use LogsActivity;
    
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['name', 'email', 'status']) // Traccia solo questi attributi
            ->logOnlyDirty() // Registra solo se ci sono modifiche
            ->dontSubmitEmptyLogs(); // Non salvare log vuoti
    }
}
```

---

## ⚡ Utilizzo Avanzato

### Logging Manuale

Per tracciare azioni non legate direttamente a modelli Eloquent (es. invio email, export, etc.).

```php
use function activity;

// Log activity semplice
activity()->log('Utente ha visualizzato il report');

// Log con record e utente
activity()
    ->performedOn($someRecord)
    ->causedBy($someUser)
    ->log('Record modificato');

// Log con properties JSON strutturate (Best Practice)
activity()
    ->performedOn($scheda)
    ->causedBy($user)
    ->withProperties([
        'action_type' => 'email_sent',
        'metadata' => [
            'recipient' => 'user@example.com',
            'template' => 'schede',
            'filename' => 'scheda_123.pdf',
        ]
    ])
    ->log('Email inviata per scheda di valutazione');
```

### Database Schema

La tabella `activity_log` ha una struttura flessibile. Le `properties` sono un campo JSON dove memorizzare dati contestuali.

**Esempio Properties JSON:**
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

## 🐛 Troubleshooting

### Errore: "Class Filament\Support\Facades\Filament not found"

Questo errore è comune quando si usano snippet di codice da versioni precedenti di Filament.

- **Causa:** Namespace della facade `Filament` errato.
- **Versione Progetto:** Filament v4.x

**Soluzione:**

```php
// ❌ ERRATO (Sintassi di Filament 2.x/3.x)
use Filament\Support\Facades\Filament;

// ✅ CORRETTO (Sintassi di Filament 4.x)
use Filament\Facades\Filament;
```

**Nota su Filament 4.x:** Il parametro `panel:` è stato rimosso da `getUrl()`. Il panel viene inferito automaticamente dal contesto.

```php
// ✅ CORRETTO (v4.x)
$resource::getUrl('edit', ['record' => $record]);

// ❌ OBSOLETO (v3.x)
$resource::getUrl('edit', ['record' => $record], panel: $panelId);
```

---

## 📚 Documentazione

### Documentazione Interna al Modulo
- [Business Logic Analysis](./business-logic-analysis.md)
- [Bugfix Filament Facade](./bugfix-filament-facade-namespace.md)
- [Use Case: Email Tracking](./use-cases/tracking-email-sent-schede.md)

### Documentazione Esterna
- [Spatie Laravel Activity Log](https://spatie.be/docs/laravel-activitylog)
- [Filament 4.x Documentation](https://filamentphp.com/docs/4.x)

---

**🔄 Ultimo aggiornamento**: 23 Dicembre 2025 (contenuti unificati da merge)  
**📦 Versione**: 2.4.0  
**⭐ Status**: ✅ Production Ready
