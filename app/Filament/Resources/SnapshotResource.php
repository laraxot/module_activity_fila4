<?php

declare(strict_types=1);

namespace Modules\Activity\Filament\Resources;

<<<<<<< HEAD
use Override;
use Modules\Activity\Filament\Resources\SnapshotResource\Pages\ListSnapshots;
use Modules\Activity\Filament\Resources\SnapshotResource\Pages\CreateSnapshot;
use Modules\Activity\Filament\Resources\SnapshotResource\Pages\EditSnapshot;
=======
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
use Override;
=======
>>>>>>> a12f125f4a (.)
=======
use Override;
>>>>>>> b93ef594b4 (.)
use Modules\Activity\Filament\Resources\SnapshotResource\Pages\ListSnapshots;
use Modules\Activity\Filament\Resources\SnapshotResource\Pages\CreateSnapshot;
use Modules\Activity\Filament\Resources\SnapshotResource\Pages\EditSnapshot;
=======
>>>>>>> origin/develop
>>>>>>> b1cd7fc (.)
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\TextInput;
use Modules\Activity\Filament\Resources\SnapshotResource\Pages;
use Modules\Activity\Models\Snapshot;
use Modules\Xot\Filament\Resources\XotBaseResource;

class SnapshotResource extends XotBaseResource
{
<<<<<<< HEAD
=======
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
>>>>>>> b1cd7fc (.)
    protected static null|string $model = Snapshot::class;

    #[Override]
    public static function getFormSchema(): array
    {
        return [
            'model_type' => TextInput::make('model_type')->required()->maxLength(255),
            'model_id' => TextInput::make('model_id')->numeric()->required(),
            'state' => KeyValue::make('state')->columnSpanFull(),
            'created_by_type' => TextInput::make('created_by_type')->maxLength(255),
            'created_by_id' => TextInput::make('created_by_id')->numeric(),
        ];
    }

    #[Override]
    public static function getRelations(): array
    {
        return [];
    }

    #[Override]
<<<<<<< HEAD
=======
=======
    protected static ?string $model = Snapshot::class;
=======
    protected static null|string $model = Snapshot::class;
>>>>>>> b93ef594b4 (.)

    #[Override]
    public static function getFormSchema(): array
    {
        return [
            'model_type' => TextInput::make('model_type')->required()->maxLength(255),
            'model_id' => TextInput::make('model_id')->numeric()->required(),
            'state' => KeyValue::make('state')->columnSpanFull(),
            'created_by_type' => TextInput::make('created_by_type')->maxLength(255),
            'created_by_id' => TextInput::make('created_by_id')->numeric(),
        ];
    }

    #[Override]
    public static function getRelations(): array
    {
        return [];
    }

<<<<<<< HEAD
>>>>>>> a12f125f4a (.)
=======
    #[Override]
>>>>>>> b93ef594b4 (.)
>>>>>>> b1cd7fc (.)
    public static function getPages(): array
    {
        return [
            'index' => ListSnapshots::route('/'),
            'create' => CreateSnapshot::route('/create'),
            'edit' => EditSnapshot::route('/{record}/edit'),
<<<<<<< HEAD
=======
=======
    protected static ?string $model = Snapshot::class;

    public static function getFormSchema(): array
    {
        return [
            'model_type' => TextInput::make('model_type')
                ->required()
                ->maxLength(255),
            'model_id' => TextInput::make('model_id')
                ->numeric()
                ->required(),
            'state' => KeyValue::make('state')
                ->columnSpanFull(),
            'created_by_type' => TextInput::make('created_by_type')
                ->maxLength(255),
            'created_by_id' => TextInput::make('created_by_id')
                ->numeric(),
        ];
    }

    public static function getRelations(): array
    {
        return [
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSnapshots::route('/'),
            'create' => Pages\CreateSnapshot::route('/create'),
            'edit' => Pages\EditSnapshot::route('/{record}/edit'),
>>>>>>> origin/develop
>>>>>>> b1cd7fc (.)
        ];
    }
}
