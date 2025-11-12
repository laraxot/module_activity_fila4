<?php

declare(strict_types=1);

namespace Modules\Activity\Models\Policies;

use Modules\Activity\Models\Activity;
<<<<<<< HEAD
=======
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
>>>>>>> b1cd7fc (.)
use Modules\User\Models\Policies\UserBasePolicy;
use Modules\Xot\Contracts\UserContract;

class ActivityPolicy extends UserBasePolicy
<<<<<<< HEAD
=======
=======
use Modules\Xot\Contracts\UserContract;

class ActivityPolicy extends ActivityBasePolicy
>>>>>>> a12f125f4a (.)
=======
use Modules\User\Models\Policies\UserBasePolicy;
use Modules\Xot\Contracts\UserContract;

class ActivityPolicy extends UserBasePolicy
>>>>>>> b93ef594b4 (.)
=======
use Modules\Xot\Contracts\UserContract;

class ActivityPolicy extends ActivityBasePolicy
>>>>>>> origin/develop
>>>>>>> b1cd7fc (.)
{
    /**
     * Determine whether the user can view any models.
     */
    // public function viewAny(UserContract $user): bool
    // {
    //     return $user->hasPermissionTo('activity.viewAny');
    // }

    /**
     * Determine whether the user can view the model.
     */
<<<<<<< HEAD
    public function view(UserContract $user, Activity $_activity): bool
=======
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
    public function view(UserContract $user, Activity $_activity): bool
=======
    public function view(UserContract $user, Activity $activity): bool
>>>>>>> a12f125f4a (.)
=======
    public function view(UserContract $user, Activity $_activity): bool
>>>>>>> b93ef594b4 (.)
=======
    public function view(UserContract $user, Activity $activity): bool
>>>>>>> origin/develop
>>>>>>> b1cd7fc (.)
    {
        return $user->hasPermissionTo('activity.view');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(UserContract $user): bool
    {
        return $user->hasPermissionTo('activity.create');
    }

    /**
     * Determine whether the user can update the model.
     */
<<<<<<< HEAD
    public function update(UserContract $user, Activity $_activity): bool
=======
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
    public function update(UserContract $user, Activity $_activity): bool
=======
    public function update(UserContract $user, Activity $activity): bool
>>>>>>> a12f125f4a (.)
=======
    public function update(UserContract $user, Activity $_activity): bool
>>>>>>> b93ef594b4 (.)
=======
    public function update(UserContract $user, Activity $activity): bool
>>>>>>> origin/develop
>>>>>>> b1cd7fc (.)
    {
        return $user->hasPermissionTo('activity.update');
    }

    /**
     * Determine whether the user can delete the model.
     */
<<<<<<< HEAD
    public function delete(UserContract $user, Activity $_activity): bool
=======
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
    public function delete(UserContract $user, Activity $_activity): bool
=======
    public function delete(UserContract $user, Activity $activity): bool
>>>>>>> a12f125f4a (.)
=======
    public function delete(UserContract $user, Activity $_activity): bool
>>>>>>> b93ef594b4 (.)
=======
    public function delete(UserContract $user, Activity $activity): bool
>>>>>>> origin/develop
>>>>>>> b1cd7fc (.)
    {
        return $user->hasPermissionTo('activity.delete');
    }

    /**
     * Determine whether the user can restore the model.
     */
<<<<<<< HEAD
    public function restore(UserContract $user, Activity $_activity): bool
=======
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
    public function restore(UserContract $user, Activity $_activity): bool
=======
    public function restore(UserContract $user, Activity $activity): bool
>>>>>>> a12f125f4a (.)
=======
    public function restore(UserContract $user, Activity $_activity): bool
>>>>>>> b93ef594b4 (.)
=======
    public function restore(UserContract $user, Activity $activity): bool
>>>>>>> origin/develop
>>>>>>> b1cd7fc (.)
    {
        return $user->hasPermissionTo('activity.restore');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(UserContract $user, Activity $activity): bool
    {
        return $user->hasPermissionTo('activity.forceDelete');
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
