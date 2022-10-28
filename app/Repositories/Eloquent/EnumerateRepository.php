<?php

namespace App\Repositories\Eloquent;

use App\Models\Enumerate;
use App\Repositories\Interface\EnumerateInterface;
use Illuminate\Contracts\Container\BindingResolutionException;

class EnumerateRepository extends RepositoriesAbstract implements EnumerateInterface
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
        $this->model = app()->make(Enumerate::class);
        $this->originalModel = $this->model;
    }
}
