<?php

namespace App\Policies;

use App\Models\Permission;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PermissionPolicy
{
    use HandlesAuthorization;

    public function before($user, $ability)
    {
        if (env('APP_ENV', 'production') === 'local' || $user->isWebmaster()) {
            return true;
        }
    }

    /**
     * Determine whether the user can view any models.
     *
     * @param  User  $user
     * @return bool
     */
    public function viewAny(User $user): bool
    {
        return $user->hasRole('permission.viewAny');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  User  $user
     * @param  Permission  $model
     * @return bool
     */
    public function view(User $user, Permission $model): bool
    {
        return $user->hasRole('permission.view') OR $user->id === $model->users_id;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  User  $user
     * @return bool
     */
    public function create(User $user): bool
    {
        return $user->hasRole('permission.create');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  User  $user
     * @param  Permission  $model
     * @return bool
     */
    public function update(User $user, Permission $model): bool
    {
        return $user->hasRole('permission.update') OR $user->id === $model->users_id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  User  $user
     * @param  Permission  $model
     * @return bool
     */
    public function delete(User $user, Permission $model): bool
    {
        return $user->hasRole('permission.delete') OR $user->id === $model->users_id;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  User  $user
     * @param  Permission  $model
     * @return bool
     */
    public function restore(User $user, Permission $model): bool
    {
        return $user->hasRole('permission.restore') OR $user->id === $model->users_id;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  User  $user
     * @param  Permission  $model
     * @return bool
     */
    public function forceDelete(User $user, Permission $model): bool
    {
        return $user->hasRole('permission.forceDelete') OR $user->id === $model->users_id;
    }
}
