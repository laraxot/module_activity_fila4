<?php

declare(strict_types=1);

namespace Modules\Activity\Models;

<<<<<<< HEAD
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
=======
<<<<<<< HEAD
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
=======
>>>>>>> origin/develop
>>>>>>> b1cd7fc (.)
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\EventSourcing\Snapshots\EloquentSnapshot as SpatieSnapshot;

/**
 * Modules\Activity\Models\Snapshot.
 *
 * @property int $id
 * @property string $aggregate_uuid
 * @property int $aggregate_version
 * @property array $state
<<<<<<< HEAD
=======
<<<<<<< HEAD
>>>>>>> b1cd7fc (.)
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $updated_by
 * @property string|null $created_by
 * @method static Builder|Snapshot newModelQuery()
 * @method static Builder|Snapshot newQuery()
 * @method static Builder|Snapshot query()
 * @method static Builder|Snapshot uuid(string $uuid)
 * @method static Builder|Snapshot whereAggregateUuid($value)
 * @method static Builder|Snapshot whereAggregateVersion($value)
 * @method static Builder|Snapshot whereCreatedAt($value)
 * @method static Builder|Snapshot whereCreatedBy($value)
 * @method static Builder|Snapshot whereId($value)
 * @method static Builder|Snapshot whereState($value)
 * @method static Builder|Snapshot whereUpdatedAt($value)
 * @method static Builder|Snapshot whereUpdatedBy($value)
<<<<<<< HEAD
=======
=======
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $updated_by
 * @property string|null $created_by
 * @method static \Illuminate\Database\Eloquent\Builder|Snapshot newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Snapshot newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Snapshot query()
 * @method static \Illuminate\Database\Eloquent\Builder|Snapshot uuid(string $uuid)
 * @method static \Illuminate\Database\Eloquent\Builder|Snapshot whereAggregateUuid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Snapshot whereAggregateVersion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Snapshot whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Snapshot whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Snapshot whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Snapshot whereState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Snapshot whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Snapshot whereUpdatedBy($value)
>>>>>>> origin/develop
>>>>>>> b1cd7fc (.)
 * @mixin IdeHelperSnapshot
 * @mixin \Eloquent
 */
class Snapshot extends SpatieSnapshot
{
    use HasFactory;
<<<<<<< HEAD
=======
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
>>>>>>> b1cd7fc (.)

    /** @var string */
    protected $connection = 'activity';

    /** @var list<string> */
    protected $fillable = ['id', 'aggregate_uuid', 'aggregate_version', 'state', 'created_at', 'updated_at'];
<<<<<<< HEAD
=======
=======
=======

>>>>>>> b93ef594b4 (.)
    /** @var string */
    protected $connection = 'activity';

    /** @var list<string> */
    protected $fillable = ['id', 'aggregate_uuid', 'aggregate_version', 'state', 'created_at', 'updated_at'];
<<<<<<< HEAD

>>>>>>> a12f125f4a (.)
=======
>>>>>>> b93ef594b4 (.)
=======
    /** @var string */
    protected $connection = 'activity';
    
    /** @var list<string> */
    protected $fillable = ['id', 'aggregate_uuid', 'aggregate_version', 'state', 'created_at', 'updated_at'];

>>>>>>> origin/develop
>>>>>>> b1cd7fc (.)
}
