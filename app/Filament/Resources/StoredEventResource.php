<?php

declare(strict_types=1);

namespace Modules\Activity\Filament\Resources;

<<<<<<< HEAD
use Override;
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
>>>>>>> b1cd7fc (.)
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\DateTimePicker;
use Modules\Activity\Filament\Resources\StoredEventResource\Pages\ListStoredEvents;
use Modules\Activity\Filament\Resources\StoredEventResource\Pages\CreateStoredEvent;
use Modules\Activity\Filament\Resources\StoredEventResource\Pages\EditStoredEvent;
<<<<<<< HEAD
=======
=======
>>>>>>> origin/develop
>>>>>>> b1cd7fc (.)
use Filament\Forms;
use Modules\Activity\Filament\Resources\StoredEventResource\Pages;
use Modules\Activity\Models\StoredEvent;
use Modules\Xot\Filament\Resources\XotBaseResource;

class StoredEventResource extends XotBaseResource
{
<<<<<<< HEAD
=======
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
>>>>>>> b1cd7fc (.)
    protected static null|string $model = StoredEvent::class;

    #[Override]
    public static function getFormSchema(): array
    {
        return [
            'event_class' => TextInput::make('event_class')->required()->maxLength(255),
            'event_properties' => KeyValue::make('event_properties')->columnSpanFull(),
            'aggregate_uuid' => TextInput::make('aggregate_uuid')->maxLength(36),
            'aggregate_version' => TextInput::make('aggregate_version')->numeric(),
            'meta_data' => Textarea::make('meta_data')->columnSpanFull(),
            'created_at' => DateTimePicker::make('created_at')->required(),
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
    protected static ?string $model = StoredEvent::class;
=======
    protected static null|string $model = StoredEvent::class;
>>>>>>> b93ef594b4 (.)

    #[Override]
    public static function getFormSchema(): array
    {
        return [
            'event_class' => TextInput::make('event_class')->required()->maxLength(255),
            'event_properties' => KeyValue::make('event_properties')->columnSpanFull(),
            'aggregate_uuid' => TextInput::make('aggregate_uuid')->maxLength(36),
            'aggregate_version' => TextInput::make('aggregate_version')->numeric(),
            'meta_data' => Textarea::make('meta_data')->columnSpanFull(),
            'created_at' => DateTimePicker::make('created_at')->required(),
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
            'index' => ListStoredEvents::route('/'),
            'create' => CreateStoredEvent::route('/create'),
            'edit' => EditStoredEvent::route('/{record}/edit'),
<<<<<<< HEAD
=======
=======
    protected static ?string $model = StoredEvent::class;

    public static function getFormSchema(): array
    {
        return [
            'event_class' => Forms\Components\TextInput::make('event_class')
                ->required()
                ->maxLength(255),

            'event_properties' => Forms\Components\KeyValue::make('event_properties')
                ->columnSpanFull(),

            'aggregate_uuid' => Forms\Components\TextInput::make('aggregate_uuid')
                ->maxLength(36),

            'aggregate_version' => Forms\Components\TextInput::make('aggregate_version')
                ->numeric(),

            'meta_data' => Forms\Components\Textarea::make('meta_data')
                ->columnSpanFull(),

            'created_at' => Forms\Components\DateTimePicker::make('created_at')
                ->required(),
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
            'index' => Pages\ListStoredEvents::route('/'),
            'create' => Pages\CreateStoredEvent::route('/create'),
            'edit' => Pages\EditStoredEvent::route('/{record}/edit'),
>>>>>>> origin/develop
>>>>>>> b1cd7fc (.)
        ];
    }
}
