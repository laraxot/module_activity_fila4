<?php

declare(strict_types=1);

namespace Modules\Activity\Filament\Pages;

use Filament\Forms\Components\Field;
use Filament\Forms\Components\MorphToSelect;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Filament\Pages\Concerns\InteractsWithFormActions;
use Filament\Resources\Pages\Concerns\InteractsWithRecord;
use Filament\Schemas\Schema;
use Filament\Tables\Enums\PaginationMode;
use Illuminate\Support\Collection;
use Livewire\WithPagination;
use Modules\Xot\Filament\Resources\Pages\XotBasePage;

/**
 * Classe base per visualizzare lo storico delle attività di un record.
 *
 * ⚠️ IMPORTANTE: Estende XotBasePage da Resources/Pages/ (Resource Page)
 *                NON da Pages/ (Standalone Page)!
 *
 * Motivo: Questa classe è usata in getPages() delle Resources, quindi DEVE
 *         essere una Resource Page per avere il metodo route().
 *
 * @see \Modules\Xot\Filament\Resources\Pages\XotBasePage
 * @see \Modules\Activity\docs\errori\route-method-does-not-exist.md
 */
abstract class ListLogActivities extends XotBasePage implements HasForms
{
    use Concerns\CanPaginate;
    use WithPagination {
        WithPagination::resetPage as resetLivewirePage;
    }
    use InteractsWithFormActions;
    use InteractsWithRecord;

    protected string $view = 'activity::filament.pages.list-log-activities';

    protected static Collection $fieldLabelMap;

    public function mount($record)
    {
        $this->record = $this->resolveRecord($record);
        $this->recordsPerPage = $this->getDefaultRecordsPerPageSelectOption();
    }

    public function getBreadcrumb(): string
    {
        return static::$breadcrumb ?? __('activity::activities.breadcrumb');
    }

    public function getTitle(): string
    {
        return __('activity::activities.title', ['record' => $this->getRecordTitle()]);
    }

    public function getActivities()
    {
        return $this->paginateQuery(
            $this->record->activities()->with('causer')->latest()->getQuery()
        );
    }

    public function getPaginationMode(): PaginationMode
    {
        return PaginationMode::Default;
    }

    public function getFieldLabel(string $name): string
    {
        static::$fieldLabelMap ??= $this->createFieldLabelMap();

        return static::$fieldLabelMap[$name] ?? $name;
    }

    protected function createFieldLabelMap(): Collection
    {
        $schema = static::getResource()::form(new Schema($this));

        $components = collect($schema->getComponents());
        $extracted = collect();

        while (($component = $components->shift()) !== null) {
            if ($component instanceof Field || $component instanceof MorphToSelect) {
                $extracted->push($component);

                continue;
            }

            $children = $component->getChildComponents();

            if (count($children) > 0) {
                $components = $components->merge($children);

                continue;
            }

            $extracted->push($component);
        }

        return $extracted
            ->filter(fn ($field) => $field instanceof Field)
            ->mapWithKeys(fn (Field $field) => [
                $field->getName() => $field->getLabel(),
            ]);
    }

    public function canRestoreActivity(): bool
    {
        return static::getResource()::canRestore($this->record);
    }

    public function restoreActivity(int|string $key)
    {
        if (! $this->canRestoreActivity()) {
            abort(403);
        }

        $activity = $this->record->activities()
            ->whereKey($key)
            ->first();

        $oldProperties = data_get($activity, 'properties.old');

        if (null === $oldProperties) {
            $this->sendRestoreFailureNotification();

            return;
        }

        try {
            $this->record->update($oldProperties);

            $this->sendRestoreSuccessNotification();
        } catch (\Exception $e) {
            $this->sendRestoreFailureNotification($e->getMessage());
        }
    }

    protected function sendRestoreSuccessNotification(): Notification
    {
        return Notification::make()
            ->title(__('activity::activities.events.restore_successful'))
            ->success()
            ->send();
    }

    protected function sendRestoreFailureNotification(?string $message = null): Notification
    {
        return Notification::make()
            ->title(__('activity::activities.events.restore_failed'))
            ->body($message)
            ->danger()
            ->send();
    }
}
