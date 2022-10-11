<?php

namespace App\Http\Controllers\V1\Admin;

use Illuminate\Http\JsonResponse;
use App\Http\Controllers\AdminController;
use App\Repositories\Interface\LanguageInterface;

class LanguageController extends AdminController
{
    protected LanguageInterface $model;

    /**
     * LanguageController constructor
     *
     * @param LanguageInterface $model
     *
     * @author malayvuong
     * @since 7.0.0 - 2022-09-20, 23:52 ICT
     */
    public function __construct(LanguageInterface $model)
    {
        parent::__construct();

        $this->model = $model;
    }

    /**
     * Get list Language
     *
     * @return JsonResponse
     * @author malayvuong
     * @since 7.0.0 - 2022-09-20, 23:52 ICT
     */
    public function index()
    {
        if (! auth()->user()->tokenCan('language.viewAny')) {
            return response()->json([], 403);
        }

        return response()->json([]);
    }
}
