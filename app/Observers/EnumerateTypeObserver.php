<?php

namespace App\Observers;

use App\Models\EnumerateType;

class EnumerateTypeObserver
{
    /**
     * Handle the EnumerateType "created" event.
     *
     * @param  \App\Models\EnumerateType  $model
     * @return void
     */
    public function created(EnumerateType $model)
    {
        //
    }

    /**
     * Handle the EnumerateType "updated" event.
     *
     * @param  \App\Models\EnumerateType  $model
     * @return void
     */
    public function updated(EnumerateType $model)
    {
        //
    }

    /**
     * Handle the EnumerateType "deleted" event.
     *
     * @param  \App\Models\EnumerateType  $model
     * @return void
     */
    public function deleted(EnumerateType $model)
    {
        //
    }
}
