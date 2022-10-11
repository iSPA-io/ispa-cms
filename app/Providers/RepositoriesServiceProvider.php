<?php

namespace App\Providers;

use App\Models\User;
use App\Models\AuditLog;
use Illuminate\Support\ServiceProvider;
use App\Repositories\Interface\UserInterface;
use App\Repositories\Eloquent\UserRepository;
use App\Repositories\Interface\RoleInterface;
use App\Repositories\Eloquent\RoleRepository;
use App\Repositories\Interface\AuditLogInterface;
use App\Repositories\Eloquent\AuditLogRepository;
use App\Repositories\Interface\LanguageInterface;
use App\Repositories\Eloquent\LanguageRepository;
use App\Repositories\Interface\PermissionInterface;
use App\Repositories\Eloquent\PermissionRepository;

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
            AuditLogInterface::class => AuditLogRepository::class,
            LanguageInterface::class => LanguageRepository::class,
            PermissionInterface::class => PermissionRepository::class,
            RoleInterface::class => RoleRepository::class,
            UserInterface::class => UserRepository::class,
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
