<?php

namespace App\Repositories\Eloquent;

use App\Models\Role;
use App\Repositories\Interface\RoleInterface;
use Illuminate\Contracts\Container\BindingResolutionException;

class RoleRepository extends RepositoriesAbstract implements RoleInterface
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
        $this->model = app()->make(Role::class);
        $this->originalModel = $this->model;
    }
}
