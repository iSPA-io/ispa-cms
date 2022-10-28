<?php

namespace App\Repositories\Eloquent;

use App\Models\EnumerateType;
use App\Repositories\Interface\EnumerateTypeInterface;
use Illuminate\Contracts\Container\BindingResolutionException;

class EnumerateTypeRepository extends RepositoriesAbstract implements EnumerateTypeInterface
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
        $this->model = app()->make(EnumerateType::class);
        $this->originalModel = $this->model;
    }
}
