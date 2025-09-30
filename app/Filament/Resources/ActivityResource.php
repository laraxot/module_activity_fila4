<?php

/**
 * Activity Resource Class.
 *
 * This class manages the Activity model in the Filament admin panel.
 * It provides functionality for listing, creating, and editing activity records.
 */

declare(strict_types=1);

namespace Modules\Activity\Filament\Resources;

<<<<<<< HEAD
use Filament\Schemas\Components\Component;
use Override;
=======
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
use Filament\Schemas\Components\Component;
use Override;
=======
>>>>>>> a12f125f4a (.)
=======
use Filament\Schemas\Components\Component;
use Override;
>>>>>>> b93ef594b4 (.)
=======
>>>>>>> origin/develop
>>>>>>> b1cd7fc (.)
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\TextInput;
use Modules\Activity\Models\Activity;
use Modules\Xot\Filament\Resources\XotBaseResource;

/**
 * Activity Resource Class.
 *
 * This resource class is responsible for configuring the Activity model in the Filament admin panel.
 * It defines the form schema, relations, and pages for managing activity records.
 */
class ActivityResource extends XotBaseResource
{
<<<<<<< HEAD
    protected static null|string $model = Activity::class;
=======
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
    protected static null|string $model = Activity::class;
=======
    protected static ?string $model = Activity::class;
>>>>>>> a12f125f4a (.)
=======
    protected static null|string $model = Activity::class;
>>>>>>> b93ef594b4 (.)
=======
    protected static ?string $model = Activity::class;
>>>>>>> origin/develop
>>>>>>> b1cd7fc (.)

    /**
     * Define the form schema for the Activity resource.
     *
<<<<<<< HEAD
=======
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
>>>>>>> b1cd7fc (.)
     * @return array<string, Component>
     */
    #[Override]
    public static function getFormSchema(): array
    {
        return [
            'log_name' => TextInput::make('log_name')->required()->maxLength(255),
            'description' => TextInput::make('description')->required()->maxLength(255),
            'subject_type' => TextInput::make('subject_type')->required()->maxLength(255),
            'subject_id' => TextInput::make('subject_id')->numeric()->required(),
            'causer_type' => TextInput::make('causer_type')->maxLength(255),
            'causer_id' => TextInput::make('causer_id')->numeric(),
            'properties' => KeyValue::make('properties')->columnSpanFull(),
            'batch_uuid' => TextInput::make('batch_uuid')->maxLength(36),
<<<<<<< HEAD
=======
=======
     * @return array<string, \Filament\Schemas\Components\Component>
=======
     * @return array<string, Component>
>>>>>>> b93ef594b4 (.)
     */
    #[Override]
    public static function getFormSchema(): array
    {
        return [
<<<<<<< HEAD
=======
     * @return array<string, \Filament\Forms\Components\Component>
     */
    public static function getFormSchema(): array
    {
        return [
>>>>>>> origin/develop
            'log_name' => TextInput::make('log_name')
                ->required()
                ->maxLength(255),

            'description' => TextInput::make('description')
                ->required()
                ->maxLength(255),

            'subject_type' => TextInput::make('subject_type')
                ->required()
                ->maxLength(255),

            'subject_id' => TextInput::make('subject_id')
                ->numeric()
                ->required(),

            'causer_type' => TextInput::make('causer_type')
                ->maxLength(255),

            'causer_id' => TextInput::make('causer_id')
                ->numeric(),

            'properties' => KeyValue::make('properties')
                ->columnSpanFull(),

            'batch_uuid' => TextInput::make('batch_uuid')
                ->maxLength(36),
<<<<<<< HEAD
>>>>>>> a12f125f4a (.)
=======
            'log_name' => TextInput::make('log_name')->required()->maxLength(255),
            'description' => TextInput::make('description')->required()->maxLength(255),
            'subject_type' => TextInput::make('subject_type')->required()->maxLength(255),
            'subject_id' => TextInput::make('subject_id')->numeric()->required(),
            'causer_type' => TextInput::make('causer_type')->maxLength(255),
            'causer_id' => TextInput::make('causer_id')->numeric(),
            'properties' => KeyValue::make('properties')->columnSpanFull(),
            'batch_uuid' => TextInput::make('batch_uuid')->maxLength(36),
>>>>>>> b93ef594b4 (.)
=======
>>>>>>> origin/develop
>>>>>>> b1cd7fc (.)
        ];
    }
}
