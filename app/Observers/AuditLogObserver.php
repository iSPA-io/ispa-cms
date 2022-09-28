<?php

namespace App\Observers;

use App\Models\AuditLog;

class AuditLogObserver
{
    /**
     * Handle the AuditLog "created" event.
     *
     * @param  \App\Models\AuditLog  $model
     * @return void
     */
    public function created(AuditLog $model)
    {
        //
    }

    /**
     * Handle the AuditLog "updated" event.
     *
     * @param  \App\Models\AuditLog  $model
     * @return void
     */
    public function updated(AuditLog $model)
    {
        //
    }

    /**
     * Handle the AuditLog "deleted" event.
     *
     * @param  \App\Models\AuditLog  $model
     * @return void
     */
    public function deleted(AuditLog $model)
    {
        //
    }

    /**
     * Handle the AuditLog "restored" event.
     *
     * @param  \App\Models\AuditLog  $model
     * @return void
     */
    public function restored(AuditLog $model)
    {
        //
    }

    /**
     * Handle the AuditLog "force deleted" event.
     *
     * @param  \App\Models\AuditLog  $model
     * @return void
     */
    public function forceDeleted(AuditLog $model)
    {
        //
    }
}
