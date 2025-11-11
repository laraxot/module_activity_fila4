<?php

declare(strict_types=1);

namespace Modules\Activity\Models\Policies;

use Modules\Activity\Models\StoredEvent;
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> 18dcd64 (.)
use Modules\User\Models\Policies\UserBasePolicy;
use Modules\Xot\Contracts\UserContract;

class StoredEventPolicy extends UserBasePolicy
<<<<<<< HEAD
=======
use Modules\Xot\Contracts\UserContract;

class StoredEventPolicy extends ActivityBasePolicy
>>>>>>> 0a00ff2 (.)
=======
>>>>>>> 18dcd64 (.)
{
    /**
     * Determine whether the user can view any models.
     */
    // public function viewAny(UserContract $user): bool
    // {
    //     return $user->hasPermissionTo('stored_event.viewAny');
    // }

    /**
     * Determine whether the user can view the model.
     */
<<<<<<< HEAD
<<<<<<< HEAD
    public function view(UserContract $user, StoredEvent $_stored_event): bool
=======
    public function view(UserContract $user, StoredEvent $stored_event): bool
>>>>>>> 0a00ff2 (.)
=======
    public function view(UserContract $user, StoredEvent $_stored_event): bool
>>>>>>> 18dcd64 (.)
    {
        return $user->hasPermissionTo('stored_event.view');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(UserContract $user): bool
    {
        return $user->hasPermissionTo('stored_event.create');
    }

    /**
     * Determine whether the user can update the model.
     */
<<<<<<< HEAD
<<<<<<< HEAD
    public function update(UserContract $user, StoredEvent $_stored_event): bool
=======
    public function update(UserContract $user, StoredEvent $stored_event): bool
>>>>>>> 0a00ff2 (.)
=======
    public function update(UserContract $user, StoredEvent $_stored_event): bool
>>>>>>> 18dcd64 (.)
    {
        return $user->hasPermissionTo('stored_event.update');
    }

    /**
     * Determine whether the user can delete the model.
     */
<<<<<<< HEAD
<<<<<<< HEAD
    public function delete(UserContract $user, StoredEvent $_stored_event): bool
=======
    public function delete(UserContract $user, StoredEvent $stored_event): bool
>>>>>>> 0a00ff2 (.)
=======
    public function delete(UserContract $user, StoredEvent $_stored_event): bool
>>>>>>> 18dcd64 (.)
    {
        return $user->hasPermissionTo('stored_event.delete');
    }

    /**
     * Determine whether the user can restore the model.
     */
<<<<<<< HEAD
<<<<<<< HEAD
    public function restore(UserContract $user, StoredEvent $_stored_event): bool
=======
    public function restore(UserContract $user, StoredEvent $stored_event): bool
>>>>>>> 0a00ff2 (.)
=======
    public function restore(UserContract $user, StoredEvent $_stored_event): bool
>>>>>>> 18dcd64 (.)
    {
        return $user->hasPermissionTo('stored_event.restore');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(UserContract $user, StoredEvent $stored_event): bool
    {
        return $user->hasPermissionTo('stored_event.forceDelete');
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
