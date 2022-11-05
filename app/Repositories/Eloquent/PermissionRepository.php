<?php

namespace App\Repositories\Eloquent;

use App\Models\Permission;
use App\Repositories\Interface\PermissionInterface;
use Illuminate\Contracts\Container\BindingResolutionException;

class PermissionRepository extends RepositoriesAbstract implements PermissionInterface
{
    /**
     * Init new object with the model
     *
     * @throws BindingResolutionException
     * @since 7.0.0 - 2022-09-28, 23:34 ICT
     * @author malayvuong
     */
    public function __construct()
    {
        $this->model = app()->make(Permission::class);
        $this->originalModel = $this->model;
    }
}
