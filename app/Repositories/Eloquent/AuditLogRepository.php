<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Interface\AuditLogInterface;
use App\Models\AuditLog;
use Illuminate\Contracts\Container\BindingResolutionException;

class AuditLogRepository extends RepositoriesAbstract implements AuditLogInterface
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
        $this->model = app()->make(AuditLog::class);
        $this->originalModel = $this->model;
    }
}
