<?php

declare(strict_types=1);

namespace Modules\Activity\Filament\Resources\StoredEventResource\Pages;

<<<<<<< HEAD
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ViewColumn;
=======
<<<<<<< HEAD
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ViewColumn;
=======
>>>>>>> origin/develop
>>>>>>> b1cd7fc (.)
use Filament\Tables;
use Modules\Activity\Filament\Resources\StoredEventResource;
use Modules\Xot\Filament\Resources\Pages\XotBaseListRecords;

class ListStoredEvents extends XotBaseListRecords
{
    protected static string $resource = StoredEventResource::class;

    /**
     * @return array<Tables\Columns\Column>
     */
    public function getTableColumns(): array
    {
        return [
<<<<<<< HEAD
            TextColumn::make('id'),
            TextColumn::make('event_class'),
            ViewColumn::make('event_properties')->view(
                'activity::filament.tables.columns.event-properties',
            ),
=======
<<<<<<< HEAD
            TextColumn::make('id'),
            TextColumn::make('event_class'),
<<<<<<< HEAD
<<<<<<< HEAD
            ViewColumn::make('event_properties')->view(
                'activity::filament.tables.columns.event-properties',
            ),
=======
            ViewColumn::make('event_properties')
                ->view('activity::filament.tables.columns.event-properties'),
>>>>>>> a12f125f4a (.)
=======
            ViewColumn::make('event_properties')->view(
                'activity::filament.tables.columns.event-properties',
            ),
>>>>>>> b93ef594b4 (.)
=======
            Tables\Columns\TextColumn::make('id'),
            Tables\Columns\TextColumn::make('event_class'),
            Tables\Columns\ViewColumn::make('event_properties')
                ->view('activity::filament.tables.columns.event-properties'),
>>>>>>> origin/develop
>>>>>>> b1cd7fc (.)
        ];
    }
}
