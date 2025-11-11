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
    use InteractsWithFormActions;
    use InteractsWithRecord;
    use WithPagination {
        WithPagination::resetPage as resetLivewirePage;
    }

    protected string $view = 'activity::filament.pages.list-log-activities';

    protected static Collection $fieldLabelMap;

    public function mount(int|string $record): void
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
        // PHPStan Level 10: Convert Htmlable to string
        $recordTitle = $this->getRecordTitle();
        $titleString = $recordTitle instanceof \Illuminate\Contracts\Support\Htmlable
            ? $recordTitle->toHtml()
            : (string) $recordTitle;

        return __('activity::activities.title', ['record' => $titleString]);
    }

    public function getActivities(): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        // PHPStan Level 10: Type safety for Eloquent relations
        $record = $this->record;
        \Webmozart\Assert\Assert::isInstanceOf(
            $record,
            \Illuminate\Database\Eloquent\Model::class,
            'Record must be an Eloquent Model'
        );

        \Webmozart\Assert\Assert::true(
            method_exists($record, 'activities'),
            'Record must have activities relationship'
        );

        $relation = $record->activities();
        \Webmozart\Assert\Assert::isInstanceOf(
            $relation,
            \Illuminate\Database\Eloquent\Relations\Relation::class,
            'activities() must return a Relation'
        );

        $builderQuery = $relation
            ->with('causer')
            ->latest()
            ->getQuery();

        \Webmozart\Assert\Assert::isInstanceOf(
            $builderQuery,
            \Illuminate\Database\Eloquent\Builder::class,
            'Query must be an Eloquent Builder'
        );

        /** @var \Illuminate\Database\Eloquent\Builder<\Modules\Activity\Models\Activity> $builderQuery */
        $paginated = $this->paginateQuery($builderQuery);

        \Webmozart\Assert\Assert::isInstanceOf(
            $paginated,
            \Illuminate\Contracts\Pagination\LengthAwarePaginator::class,
            'paginateQuery() with PaginationMode::Default must return LengthAwarePaginator'
        );

        return $paginated;
    }

    public function getPaginationMode(): PaginationMode
    {
        return PaginationMode::Default;
    }

    public function getFieldLabel(string $name): string
    {
        static::$fieldLabelMap ??= $this->createFieldLabelMap();

        $fieldLabel = static::$fieldLabelMap[$name] ?? $name;

        // PHPStan Level 10: Ensure string return type
        if (! \is_string($fieldLabel)) {
            return $name;
        }

        return $fieldLabel;
    }

    protected function createFieldLabelMap(): Collection
    {
        $schema = static::getResource()::form(new Schema($this));

        // PHPStan Level 10: Type safety for schema components
        \Webmozart\Assert\Assert::isInstanceOf(
            $schema,
            Schema::class,
            'Form must return a Schema instance'
        );

        $componentsArray = $schema->getComponents();

        // componentsArray is always an array from getComponents()
        $components = collect($componentsArray);
        $extracted = collect();

        while (($component = $components->shift()) !== null) {
            if ($component instanceof Field || $component instanceof MorphToSelect) {
                $extracted->push($component);

                continue;
            }

            // PHPStan Level 10: Type-safe child components
            if (method_exists($component, 'getChildComponents')) {
                $children = $component->getChildComponents();

                if (\is_array($children) && count($children) > 0) {
                    /** @var array<int|string, \Filament\Schemas\Components\Component> $safeChildren */
                    $safeChildren = $children;
                    $components = $components->merge($safeChildren);

                    continue;
                }
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
        $resource = static::getResource();
        if (! class_exists($resource) || ! method_exists($resource, 'canRestore')) {
            return false;
        }

        $canRestore = $resource::canRestore($this->record);

        return \is_bool($canRestore) ? $canRestore : false;
    }

    public function restoreActivity(int|string $key): void
    {
        if (! $this->canRestoreActivity()) {
            abort(403);
        }

        $record = $this->record;
        if (! \is_object($record) || ! method_exists($record, 'activities')) {
            $this->sendRestoreFailureNotification('Invalid record');

            return;
        }

        $activitiesRelation = $record->activities();
        if (! \is_object($activitiesRelation) || ! method_exists($activitiesRelation, 'whereKey')) {
            $this->sendRestoreFailureNotification('Invalid activities relation');

            return;
        }

        $whereKeyQuery = $activitiesRelation->whereKey($key);
        if (! \is_object($whereKeyQuery) || ! method_exists($whereKeyQuery, 'first')) {
            $this->sendRestoreFailureNotification('Invalid query');

            return;
        }

        $activity = $whereKeyQuery->first();
        $oldProperties = data_get($activity, 'properties.old');

        if ($oldProperties === null) {
            $this->sendRestoreFailureNotification();

            return;
        }

        if (! \is_array($oldProperties)) {
            $this->sendRestoreFailureNotification('Invalid properties format');

            return;
        }

        try {
            /** @var array<string, mixed> $safeProperties */
            $safeProperties = $oldProperties;

            $record->update($safeProperties);

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