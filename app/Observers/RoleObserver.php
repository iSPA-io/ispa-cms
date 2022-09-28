<?php

namespace App\Observers;

use App\Models\Role;

class RoleObserver
{
    /**
     * Handle the Role "created" event.
     *
     * @param  \App\Models\Role  $model
     * @return void
     */
    public function created(Role $model)
    {
        //
    }

    /**
     * Handle the Role "updated" event.
     *
     * @param  \App\Models\Role  $model
     * @return void
     */
    public function updated(Role $model)
    {
        //
    }

    /**
     * Handle the Role "deleted" event.
     *
     * @param  \App\Models\Role  $model
     * @return void
     */
    public function deleted(Role $model)
    {
        //
    }

    /**
     * Handle the Role "restored" event.
     *
     * @param  \App\Models\Role  $model
     * @return void
     */
    public function restored(Role $model)
    {
        //
    }

    /**
     * Handle the Role "force deleted" event.
     *
     * @param  \App\Models\Role  $model
     * @return void
     */
    public function forceDeleted(Role $model)
    {
        //
    }
}
