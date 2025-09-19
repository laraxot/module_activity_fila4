<?php

declare(strict_types=1);

namespace Modules\Activity\Models\Policies;

use Modules\Activity\Models\Snapshot;
<<<<<<< HEAD
use Modules\User\Models\Policies\UserBasePolicy;
use Modules\Xot\Contracts\UserContract;

class SnapshotPolicy extends UserBasePolicy
=======
use Modules\Xot\Contracts\UserContract;

class SnapshotPolicy extends ActivityBasePolicy
>>>>>>> 0a00ff2 (.)
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(UserContract $user): bool
    {
        return $user->hasPermissionTo('snapshot.viewAny');
    }

    /**
     * Determine whether the user can view the model.
     */
<<<<<<< HEAD
    public function view(UserContract $user, Snapshot $_snapshot): bool
=======
    public function view(UserContract $user, Snapshot $snapshot): bool
>>>>>>> 0a00ff2 (.)
    {
        return $user->hasPermissionTo('snapshot.view');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(UserContract $user): bool
    {
        return $user->hasPermissionTo('snapshot.create');
    }

    /**
     * Determine whether the user can update the model.
     */
<<<<<<< HEAD
    public function update(UserContract $user, Snapshot $_snapshot): bool
=======
    public function update(UserContract $user, Snapshot $snapshot): bool
>>>>>>> 0a00ff2 (.)
    {
        return $user->hasPermissionTo('snapshot.update');
    }

    /**
     * Determine whether the user can delete the model.
     */
<<<<<<< HEAD
    public function delete(UserContract $user, Snapshot $_snapshot): bool
=======
    public function delete(UserContract $user, Snapshot $snapshot): bool
>>>>>>> 0a00ff2 (.)
    {
        return $user->hasPermissionTo('snapshot.delete');
    }

    /**
     * Determine whether the user can restore the model.
     */
<<<<<<< HEAD
    public function restore(UserContract $user, Snapshot $_snapshot): bool
=======
    public function restore(UserContract $user, Snapshot $snapshot): bool
>>>>>>> 0a00ff2 (.)
    {
        return $user->hasPermissionTo('snapshot.restore');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(UserContract $user, Snapshot $snapshot): bool
    {
        return $user->hasPermissionTo('snapshot.forceDelete');
    }
<<<<<<< HEAD
}
=======
}
>>>>>>> 0a00ff2 (.)
