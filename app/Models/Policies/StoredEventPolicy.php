<?php

declare(strict_types=1);

namespace Modules\Activity\Models\Policies;

use Modules\Activity\Models\StoredEvent;
<<<<<<< HEAD
=======
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
>>>>>>> b1cd7fc (.)
use Modules\User\Models\Policies\UserBasePolicy;
use Modules\Xot\Contracts\UserContract;

class StoredEventPolicy extends UserBasePolicy
<<<<<<< HEAD
=======
=======
use Modules\Xot\Contracts\UserContract;

class StoredEventPolicy extends ActivityBasePolicy
>>>>>>> a12f125f4a (.)
=======
use Modules\User\Models\Policies\UserBasePolicy;
use Modules\Xot\Contracts\UserContract;

class StoredEventPolicy extends UserBasePolicy
>>>>>>> b93ef594b4 (.)
=======
use Modules\Xot\Contracts\UserContract;

class StoredEventPolicy extends ActivityBasePolicy
>>>>>>> origin/develop
>>>>>>> b1cd7fc (.)
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(UserContract $user): bool
    {
        return $user->hasPermissionTo('stored_event.viewAny');
    }

    /**
     * Determine whether the user can view the model.
     */
<<<<<<< HEAD
    public function view(UserContract $user, StoredEvent $_stored_event): bool
=======
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
    public function view(UserContract $user, StoredEvent $_stored_event): bool
=======
    public function view(UserContract $user, StoredEvent $stored_event): bool
>>>>>>> a12f125f4a (.)
=======
    public function view(UserContract $user, StoredEvent $_stored_event): bool
>>>>>>> b93ef594b4 (.)
=======
    public function view(UserContract $user, StoredEvent $stored_event): bool
>>>>>>> origin/develop
>>>>>>> b1cd7fc (.)
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
    public function update(UserContract $user, StoredEvent $_stored_event): bool
=======
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
    public function update(UserContract $user, StoredEvent $_stored_event): bool
=======
    public function update(UserContract $user, StoredEvent $stored_event): bool
>>>>>>> a12f125f4a (.)
=======
    public function update(UserContract $user, StoredEvent $_stored_event): bool
>>>>>>> b93ef594b4 (.)
=======
    public function update(UserContract $user, StoredEvent $stored_event): bool
>>>>>>> origin/develop
>>>>>>> b1cd7fc (.)
    {
        return $user->hasPermissionTo('stored_event.update');
    }

    /**
     * Determine whether the user can delete the model.
     */
<<<<<<< HEAD
    public function delete(UserContract $user, StoredEvent $_stored_event): bool
=======
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
    public function delete(UserContract $user, StoredEvent $_stored_event): bool
=======
    public function delete(UserContract $user, StoredEvent $stored_event): bool
>>>>>>> a12f125f4a (.)
=======
    public function delete(UserContract $user, StoredEvent $_stored_event): bool
>>>>>>> b93ef594b4 (.)
=======
    public function delete(UserContract $user, StoredEvent $stored_event): bool
>>>>>>> origin/develop
>>>>>>> b1cd7fc (.)
    {
        return $user->hasPermissionTo('stored_event.delete');
    }

    /**
     * Determine whether the user can restore the model.
     */
<<<<<<< HEAD
    public function restore(UserContract $user, StoredEvent $_stored_event): bool
=======
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
    public function restore(UserContract $user, StoredEvent $_stored_event): bool
=======
    public function restore(UserContract $user, StoredEvent $stored_event): bool
>>>>>>> a12f125f4a (.)
=======
    public function restore(UserContract $user, StoredEvent $_stored_event): bool
>>>>>>> b93ef594b4 (.)
=======
    public function restore(UserContract $user, StoredEvent $stored_event): bool
>>>>>>> origin/develop
>>>>>>> b1cd7fc (.)
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
}
=======
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
}
=======
}
>>>>>>> a12f125f4a (.)
=======
}
>>>>>>> b93ef594b4 (.)
=======
}
>>>>>>> origin/develop
>>>>>>> b1cd7fc (.)
