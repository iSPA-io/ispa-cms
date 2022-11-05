<?php

namespace App\Http\Controllers\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\AdminController;

class EnumerateController extends AdminController
{
    protected EnumerateInterface $model;

    /**
     * EnumerateController constructor
     *
     * @param LanguageInterface $model
     *
     * @author malayvuong
     * @since 7.0.0 - 2022-09-20, 23:52 ICT
     */
    public function __construct(EnumerateInterface $model)
    {
        parent::__construct();

        $this->model = $model;
    }

    /**
     * Get list Enumerate
     *
     * @return \Illuminate\Http\JsonResponse
     * @author malayvuong
     * @since 7.0.0 - 2022-09-20, 23:52 ICT
     */
    public function index()
    {
        if (! auth()->user()->tokenCan('enumerate.viewAny')) {
            return response()->json([], 403);
        }

        return response()->json([]);
    }
}
