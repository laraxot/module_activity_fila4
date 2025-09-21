<?php

declare(strict_types=1);

namespace Modules\Activity\Filament\Resources\SnapshotResource\Pages;

<<<<<<< HEAD
=======
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> b93ef594b4 (.)
>>>>>>> b1cd7fc (.)
use Filament\Actions\BulkAction;
use Filament\Tables\Filters\BaseFilter;
use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
<<<<<<< HEAD
=======
<<<<<<< HEAD
=======
>>>>>>> a12f125f4a (.)
=======
>>>>>>> b93ef594b4 (.)
>>>>>>> b1cd7fc (.)
use Filament\Tables\Filters\SelectFilter;
use Filament\Actions\ViewAction;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
<<<<<<< HEAD
=======
<<<<<<< HEAD
<<<<<<< HEAD
=======
use Filament\Tables\Filters\BaseFilter;
use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
>>>>>>> a12f125f4a (.)
=======
>>>>>>> b93ef594b4 (.)
=======
>>>>>>> origin/develop
>>>>>>> b1cd7fc (.)
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ViewColumn;
use Modules\Activity\Filament\Resources\SnapshotResource;
use Modules\Xot\Filament\Resources\Pages\XotBaseListRecords;

/**
 * @see SnapshotResource
 */
class ListSnapshots extends XotBaseListRecords
{
    protected static string $resource = SnapshotResource::class;

    /**
     * Get the list table columns.
     *
     * @return array<Tables\Columns\Column>
     */
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
            TextColumn::make('aggregate_uuid')->searchable(),
            TextColumn::make('aggregate_version')->sortable(),
            TextColumn::make('state')->searchable(),
            TextColumn::make('created_at')->dateTime()->sortable(),
            TextColumn::make('updated_at')->dateTime()->sortable(),
<<<<<<< HEAD
=======
<<<<<<< HEAD
=======
=======
>>>>>>> origin/develop
            TextColumn::make('id')
                ->sortable()
                ->searchable(),
            TextColumn::make('aggregate_uuid')
                ->searchable(),
            TextColumn::make('aggregate_version')
                ->sortable(),
            TextColumn::make('state')
                ->searchable(),
            TextColumn::make('created_at')
                ->dateTime()
                ->sortable(),
            TextColumn::make('updated_at')
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

    /**
<<<<<<< HEAD
     * @return array<BaseFilter>
=======
<<<<<<< HEAD
     * @return array<BaseFilter>
=======
     * @return array<Tables\Filters\BaseFilter>
>>>>>>> origin/develop
>>>>>>> b1cd7fc (.)
     */
    public function getTableFilters(): array
    {
        return [
<<<<<<< HEAD
            SelectFilter::make('aggregate_type')
=======
<<<<<<< HEAD
            SelectFilter::make('aggregate_type')
=======
            Tables\Filters\SelectFilter::make('aggregate_type')
>>>>>>> origin/develop
>>>>>>> b1cd7fc (.)
                ->options([
                    'user' => 'User',
                    'profile' => 'Profile',
                    'role' => 'Role',
                ])
                ->multiple(),
        ];
    }

    /**
<<<<<<< HEAD
     * @return array<string, Action|ActionGroup>
=======
<<<<<<< HEAD
     * @return array<string, Action|ActionGroup>
=======
     * @return array<string, Tables\Actions\Action|Tables\Actions\ActionGroup>
>>>>>>> origin/develop
>>>>>>> b1cd7fc (.)
     */
    public function getTableActions(): array
    {
        return [
<<<<<<< HEAD
            'view' => ViewAction::make(),
            'edit' => EditAction::make(),
            'delete' => DeleteAction::make(),
=======
<<<<<<< HEAD
            'view' => ViewAction::make(),
            'edit' => EditAction::make(),
            'delete' => DeleteAction::make(),
=======
            'view' => Tables\Actions\ViewAction::make(),
            'edit' => Tables\Actions\EditAction::make(),
            'delete' => Tables\Actions\DeleteAction::make(),
>>>>>>> origin/develop
>>>>>>> b1cd7fc (.)
        ];
    }

    /**
<<<<<<< HEAD
     * @return array<BulkAction>
=======
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
     * @return array<BulkAction>
=======
     * @return array<\Filament\Actions\BulkAction>
>>>>>>> a12f125f4a (.)
=======
     * @return array<BulkAction>
>>>>>>> b93ef594b4 (.)
=======
     * @return array<Tables\Actions\BulkAction>
>>>>>>> origin/develop
>>>>>>> b1cd7fc (.)
     */
    public function getTableBulkActions(): array
    {
        return [
<<<<<<< HEAD
            DeleteBulkAction::make(),
=======
<<<<<<< HEAD
            DeleteBulkAction::make(),
=======
            Tables\Actions\DeleteBulkAction::make(),
>>>>>>> origin/develop
>>>>>>> b1cd7fc (.)
        ];
    }
}
