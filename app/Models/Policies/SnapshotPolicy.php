<?php

declare(strict_types=1);

namespace Modules\Activity\Models\Policies;

use Modules\Activity\Models\Snapshot;
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> 18dcd64 (.)
use Modules\User\Models\Policies\UserBasePolicy;
use Modules\Xot\Contracts\UserContract;

class SnapshotPolicy extends UserBasePolicy
<<<<<<< HEAD
=======
use Modules\Xot\Contracts\UserContract;

class SnapshotPolicy extends ActivityBasePolicy
>>>>>>> 0a00ff2 (.)
=======
>>>>>>> 18dcd64 (.)
{
    /**
     * Determine whether the user can view any models.
     */
    // public function viewAny(UserContract $user): bool
    // {
    //     return $user->hasPermissionTo('snapshot.viewAny');
    // }

    /**
     * Determine whether the user can view the model.
     */
<<<<<<< HEAD
<<<<<<< HEAD
    public function view(UserContract $user, Snapshot $_snapshot): bool
=======
    public function view(UserContract $user, Snapshot $snapshot): bool
>>>>>>> 0a00ff2 (.)
=======
    public function view(UserContract $user, Snapshot $_snapshot): bool
>>>>>>> 18dcd64 (.)
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
<<<<<<< HEAD
    public function update(UserContract $user, Snapshot $_snapshot): bool
=======
    public function update(UserContract $user, Snapshot $snapshot): bool
>>>>>>> 0a00ff2 (.)
=======
    public function update(UserContract $user, Snapshot $_snapshot): bool
>>>>>>> 18dcd64 (.)
    {
        return $user->hasPermissionTo('snapshot.update');
    }

    /**
     * Determine whether the user can delete the model.
     */
<<<<<<< HEAD
<<<<<<< HEAD
    public function delete(UserContract $user, Snapshot $_snapshot): bool
=======
    public function delete(UserContract $user, Snapshot $snapshot): bool
>>>>>>> 0a00ff2 (.)
=======
    public function delete(UserContract $user, Snapshot $_snapshot): bool
>>>>>>> 18dcd64 (.)
    {
        return $user->hasPermissionTo('snapshot.delete');
    }

    /**
     * Determine whether the user can restore the model.
     */
<<<<<<< HEAD
<<<<<<< HEAD
    public function restore(UserContract $user, Snapshot $_snapshot): bool
=======
    public function restore(UserContract $user, Snapshot $snapshot): bool
>>>>>>> 0a00ff2 (.)
=======
    public function restore(UserContract $user, Snapshot $_snapshot): bool
>>>>>>> 18dcd64 (.)
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
<<<<<<< HEAD
}
=======
}
>>>>>>> 0a00ff2 (.)
=======
}
>>>>>>> 18dcd64 (.)
