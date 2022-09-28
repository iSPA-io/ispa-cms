<?php

namespace App\Policies;

use App\Models\User;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
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
        return $user->hasRole('user.viewAny');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  User  $user
     * @param  User  $model
     * @return bool
     */
    public function view(User $user, User $model): bool
    {
        return $user->hasRole('user.view') OR $user->id === $model->users_id;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  User  $user
     * @return bool
     */
    public function create(User $user): bool
    {
        return $user->hasRole('user.create');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  User  $user
     * @param  User  $model
     * @return bool
     */
    public function update(User $user, User $model): bool
    {
        return $user->hasRole('user.update') OR $user->id === $model->users_id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  User  $user
     * @param  User  $model
     * @return bool
     */
    public function delete(User $user, User $model): bool
    {
        return $user->hasRole('user.delete') OR $user->id === $model->users_id;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  User  $user
     * @param  User  $model
     * @return bool
     */
    public function restore(User $user, User $model): bool
    {
        return $user->hasRole('user.restore') OR $user->id === $model->users_id;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  User  $user
     * @param  User  $model
     * @return bool
     */
    public function forceDelete(User $user, User $model): bool
    {
        return $user->hasRole('user.forceDelete') OR $user->id === $model->users_id;
    }
}
