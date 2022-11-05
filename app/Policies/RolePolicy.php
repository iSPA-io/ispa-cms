<?php

namespace App\Policies;

use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RolePolicy
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
        return $user->hasRole('role.viewAny');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  User  $user
     * @param  Role  $model
     * @return bool
     */
    public function view(User $user, Role $model): bool
    {
        return $user->hasRole('role.view') OR $user->id === $model->users_id;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  User  $user
     * @return bool
     */
    public function create(User $user): bool
    {
        return $user->hasRole('role.create');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  User  $user
     * @param  Role  $model
     * @return bool
     */
    public function update(User $user, Role $model): bool
    {
        return $user->hasRole('role.update') OR $user->id === $model->users_id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  User  $user
     * @param  Role  $model
     * @return bool
     */
    public function delete(User $user, Role $model): bool
    {
        return $user->hasRole('role.delete') OR $user->id === $model->users_id;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  User  $user
     * @param  Role  $model
     * @return bool
     */
    public function restore(User $user, Role $model): bool
    {
        return $user->hasRole('role.restore') OR $user->id === $model->users_id;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  User  $user
     * @param  Role  $model
     * @return bool
     */
    public function forceDelete(User $user, Role $model): bool
    {
        return $user->hasRole('role.forceDelete') OR $user->id === $model->users_id;
    }
}
