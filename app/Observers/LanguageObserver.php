<?php

namespace App\Observers;

use App\Models\Language;

class LanguageObserver
{
    /**
     * Handle the Language "created" event.
     *
     * @param  \App\Models\Language  $model
     * @return void
     */
    public function created(Language $model)
    {
        //
    }

    /**
     * Handle the Language "updated" event.
     *
     * @param  \App\Models\Language  $model
     * @return void
     */
    public function updated(Language $model)
    {
        //
    }

    /**
     * Handle the Language "deleted" event.
     *
     * @param  \App\Models\Language  $model
     * @return void
     */
    public function deleted(Language $model)
    {
        //
    }

    /**
     * Handle the Language "restored" event.
     *
     * @param  \App\Models\Language  $model
     * @return void
     */
    public function restored(Language $model)
    {
        //
    }

    /**
     * Handle the Language "force deleted" event.
     *
     * @param  \App\Models\Language  $model
     * @return void
     */
    public function forceDeleted(Language $model)
    {
        //
    }
}
