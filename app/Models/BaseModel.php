<?php

declare(strict_types=1);

namespace Modules\Activity\Models;

<<<<<<< HEAD
use Modules\Xot\Models\XotBaseModel;

/**
 * Base Model for Activity module.
 *
 * Extends XotBaseModel which provides:
 * - Standard properties (snakeAttributes, incrementing, timestamps, perPage, etc.)
 * - HasXotFactory trait
 * - Updater trait
 * - Standard casts (published_at, timestamps, audit fields)
 *
 * @see \Modules\Xot\Models\XotBaseModel
 */
abstract class BaseModel extends XotBaseModel
{
    /**
     * The connection name for the model.
     *
     * This is the ONLY property specific to Activity module.
     *
     * @var string
     */
    protected $connection = 'activity';

    /**
     * Get the attributes that should be cast.
     *
     * Extends parent casts with Activity-specific fields.
     * Common casts (id, uuid, published_at, created_at, updated_at, deleted_at, etc.)
     * are inherited from XotBaseModel.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return array_merge(parent::casts(), [
            // Module-specific casts only
        ]);
=======
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model as EloquentModel;
use Modules\Xot\Actions\Factory\GetFactoryAction;
use Modules\Xot\Traits\Updater;

/**
 * Class BaseModel.
 *
 * @template TFactory of \Illuminate\Database\Eloquent\Factories\Factory<static>
 */
abstract class BaseModel extends EloquentModel
{
    use HasFactory;
    use Updater;

    /**
     * Indicates whether attributes are snake cased on arrays.
     *
     * @see https://laravel-news.com/6-eloquent-secrets
     *
     * @var bool
     */
    public static $snakeAttributes = true;

    public $incrementing = true;

    public $timestamps = true;

    protected $perPage = 30;

    protected $connection = 'activity';

    protected $primaryKey = 'id';

    protected $keyType = 'string';

    /** @var list<string> */
    protected $hidden = [
        // 'password'
    ];

    /** @var list<string> */
    protected $fillable = [];

    /** @return array<string, string> */
    protected function casts(): array
    {
        return [
            'id' => 'string',
            'uuid' => 'string',

            'created_at' => 'datetime',
            'updated_at' => 'datetime',
            'deleted_at' => 'datetime',

            'updated_by' => 'string',
            'created_by' => 'string',
            'deleted_by' => 'string',

            'published_at' => 'datetime',
        ];
    }

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory<static>
     */
    protected static function newFactory(): Factory
    {
        return app(GetFactoryAction::class)->execute(static::class);
>>>>>>> 97b542c (.)
    }
}
