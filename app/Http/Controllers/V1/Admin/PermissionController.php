<?php

namespace App\Http\Controllers\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\AdminController;

class PermissionController extends AdminController
{
    /**
     * PermissionController constructor
     *
     * @author malayvuong
     * @since 7.0.0 - 2022-09-20, 23:52 ICT
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Get list Permission
     *
     * @return \Illuminate\Http\JsonResponse
     * @author malayvuong
     * @since 7.0.0 - 2022-09-20, 23:52 ICT
     */
    public function index()
    {
        if (! auth()->user()->tokenCan('{{ name_lower }}.viewAny') {
            return 403;
        }

        return response()->json([]);
    }
}
