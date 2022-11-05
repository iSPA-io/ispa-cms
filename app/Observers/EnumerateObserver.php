<?php

namespace App\Observers;

use App\Models\Enumerate;

class EnumerateObserver
{
    /**
     * Handle the Enumerate "created" event.
     *
     * @param  \App\Models\Enumerate  $model
     * @return void
     */
    public function created(Enumerate $model)
    {
        //
    }

    /**
     * Handle the Enumerate "updated" event.
     *
     * @param  \App\Models\Enumerate  $model
     * @return void
     */
    public function updated(Enumerate $model)
    {
        //
    }

    /**
     * Handle the Enumerate "deleted" event.
     *
     * @param  \App\Models\Enumerate  $model
     * @return void
     */
    public function deleted(Enumerate $model)
    {
        //
    }

    /**
     * Handle the Enumerate "restored" event.
     *
     * @param  \App\Models\Enumerate  $model
     * @return void
     */
    public function restored(Enumerate $model)
    {
        //
    }

    /**
     * Handle the Enumerate "force deleted" event.
     *
     * @param  \App\Models\Enumerate  $model
     * @return void
     */
    public function forceDeleted(Enumerate $model)
    {
        //
    }
}
