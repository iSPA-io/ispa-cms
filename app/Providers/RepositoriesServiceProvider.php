<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Interface\UserInterface;
use App\Repositories\Eloquent\UserRepository;
use App\Repositories\Interface\RoleInterface;
use App\Repositories\Eloquent\RoleRepository;
use App\Repositories\Interface\AuditLogInterface;
use App\Repositories\Eloquent\AuditLogRepository;
use App\Repositories\Interface\LanguageInterface;
use App\Repositories\Eloquent\LanguageRepository;
use App\Repositories\Interface\EnumerateInterface;
use App\Repositories\Eloquent\EnumerateRepository;
use App\Repositories\Interface\PermissionInterface;
use App\Repositories\Eloquent\PermissionRepository;
use App\Repositories\Interface\EnumerateTypeInterface;
use App\Repositories\Eloquent\EnumerateTypeRepository;

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
            EnumerateInterface::class => EnumerateRepository::class,
            EnumerateTypeInterface::class => EnumerateTypeRepository::class,
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
