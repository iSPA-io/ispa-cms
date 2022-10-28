<?php

namespace App\Policies;

use App\Models\Enumerate;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class EnumeratePolicy
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
        return $user->hasRole('enumerate.viewAny');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  User  $user
     * @param  Enumerate  $model
     * @return bool
     */
    public function view(User $user, Enumerate $model): bool
    {
        return $user->hasRole('enumerate.view') OR $user->id === $model->users_id;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  User  $user
     * @return bool
     */
    public function create(User $user): bool
    {
        return $user->hasRole('enumerate.create');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  User  $user
     * @param  Enumerate  $model
     * @return bool
     */
    public function update(User $user, Enumerate $model): bool
    {
        return $user->hasRole('enumerate.update') OR $user->id === $model->users_id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  User  $user
     * @param  Enumerate  $model
     * @return bool
     */
    public function delete(User $user, Enumerate $model): bool
    {
        return $user->hasRole('enumerate.delete') OR $user->id === $model->users_id;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  User  $user
     * @param  Enumerate  $model
     * @return bool
     */
    public function restore(User $user, Enumerate $model): bool
    {
        return $user->hasRole('enumerate.restore') OR $user->id === $model->users_id;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  User  $user
     * @param  Enumerate  $model
     * @return bool
     */
    public function forceDelete(User $user, Enumerate $model): bool
    {
        return $user->hasRole('enumerate.forceDelete') OR $user->id === $model->users_id;
    }
}
