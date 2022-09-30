<?php

namespace App\Http\Controllers\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\AdminController;

class UserController extends AdminController
{
    /**
     * UserController constructor
     *
     * @author malayvuong
     * @since 7.0.0 - 2022-09-20, 23:52 ICT
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Get list User
     *
     * @return \Illuminate\Http\JsonResponse
     * @author malayvuong
     * @since 7.0.0 - 2022-09-20, 23:52 ICT
     */
    public function index()
    {
        if (! auth()->user()->tokenCan('{{ name_lower }}.viewAny')) {
            return response()->json([], 403);
        }

        return response()->json([]);
    }
}
