<?php

namespace App\Providers;

use Illuminate\Support\Str;
use Illuminate\Support\Collection;
use Illuminate\Support\ServiceProvider;

class CollectionMacro extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(): void
    {
        collect()->macro('keyByRecursive', function ($func) {
            return $this->keyBy(function ($value, $key) use($func) {
                return $func($value, $key);
            })->map(function ($item) use ($func) {
                if ($item instanceof Collection) {
                    return $item->keyByRecursive($func);
                }

                if (is_array($item) || is_object($item)) {
                    return collect($item)->keyByRecursive($func);
                }

                return $item;
            });
        });

        collect()->macro('toCamel', function () {
            return $this->keyByRecursive(function ($value, $key) {
                return Str::camel($key);
            });
        });
    }
}
