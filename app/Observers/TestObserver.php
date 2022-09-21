<?php

namespace App\Observers;

use App\Models\Test;

class TestObserver
{
    /**
     * Handle the Test "created" event.
     *
     * @param  \App\Models\Test  $model
     * @return void
     */
    public function created(Test $model)
    {
        //
    }

    /**
     * Handle the Test "updated" event.
     *
     * @param  \App\Models\Test  $model
     * @return void
     */
    public function updated(Test $model)
    {
        //
    }

    /**
     * Handle the Test "deleted" event.
     *
     * @param  \App\Models\Test  $model
     * @return void
     */
    public function deleted(Test $model)
    {
        //
    }

    /**
     * Handle the Test "restored" event.
     *
     * @param  \App\Models\Test  $model
     * @return void
     */
    public function restored(Test $model)
    {
        //
    }

    /**
     * Handle the Test "force deleted" event.
     *
     * @param  \App\Models\Test  $model
     * @return void
     */
    public function forceDeleted(Test $model)
    {
        //
    }
}
