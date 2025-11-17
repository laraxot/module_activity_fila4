<?php

declare(strict_types=1);

namespace Modules\Activity\Filament\Resources\ActivityResource\Pages;

use Filament\Tables\Columns\TextColumn;
use Modules\Activity\Filament\Resources\ActivityResource;
use Modules\Xot\Filament\Resources\Pages\XotBaseListRecords;

/**
 * @see ActivityResource
 */
class ListActivities extends XotBaseListRecords
{
    protected static string $resource = ActivityResource::class;

    public function getTableColumns(): array
    {
        return [
<<<<<<< HEAD
=======
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> b93ef594b4 (.)
>>>>>>> b1cd7fc (.)
            TextColumn::make('id')->sortable()->searchable(),
            TextColumn::make('description')->searchable()->limit(50),
            TextColumn::make('subject_type')->searchable(),
            TextColumn::make('subject_id')->searchable(),
            TextColumn::make('causer_type')->searchable(),
            TextColumn::make('causer_id')->searchable(),
            TextColumn::make('created_at')->dateTime()->sortable(),
<<<<<<< HEAD
=======
<<<<<<< HEAD
=======
=======
>>>>>>> origin/develop
            TextColumn::make('id')
                ->sortable()
                ->searchable(),
            TextColumn::make('description')
                ->searchable()
                ->limit(50),
            TextColumn::make('subject_type')
                ->searchable(),
            TextColumn::make('subject_id')
                ->searchable(),
            TextColumn::make('causer_type')
                ->searchable(),
            TextColumn::make('causer_id')
                ->searchable(),
            TextColumn::make('created_at')
                ->dateTime()
                ->sortable(),
<<<<<<< HEAD
>>>>>>> a12f125f4a (.)
=======
>>>>>>> b93ef594b4 (.)
=======
>>>>>>> origin/develop
>>>>>>> b1cd7fc (.)
        ];
    }
}
