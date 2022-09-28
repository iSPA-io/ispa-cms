<?php

namespace App\Observers;

use App\Models\Permission;

class PermissionObserver
{
    /**
     * Handle the Permission "created" event.
     *
     * @param  \App\Models\Permission  $model
     * @return void
     */
    public function created(Permission $model)
    {
        //
    }

    /**
     * Handle the Permission "updated" event.
     *
     * @param  \App\Models\Permission  $model
     * @return void
     */
    public function updated(Permission $model)
    {
        //
    }

    /**
     * Handle the Permission "deleted" event.
     *
     * @param  \App\Models\Permission  $model
     * @return void
     */
    public function deleted(Permission $model)
    {
        //
    }

    /**
     * Handle the Permission "restored" event.
     *
     * @param  \App\Models\Permission  $model
     * @return void
     */
    public function restored(Permission $model)
    {
        //
    }

    /**
     * Handle the Permission "force deleted" event.
     *
     * @param  \App\Models\Permission  $model
     * @return void
     */
    public function forceDeleted(Permission $model)
    {
        //
    }
}
