<?php

namespace App\Providers;

use App\Models\User;
use App\Models\AuditLog;
use Illuminate\Support\ServiceProvider;
use App\Repositories\Interface\UserInterface;
use App\Repositories\Eloquent\UserRepository;
use App\Repositories\Interface\AuditLogInterface;
use App\Repositories\Eloquent\AuditLogRepository;

class RepositoriesServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        $list = [
            AuditLogInterface::class => function() {return new AuditLogRepository(new AuditLog());},
            UserInterface::class => function() {return new UserRepository(new User());}
        ];

        foreach ($list as $key => $value) {
            $this->app->bind($key, $value);
        }
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(): void
    {
        //
    }
}
