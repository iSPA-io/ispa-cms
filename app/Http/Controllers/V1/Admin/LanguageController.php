<?php

namespace App\Http\Controllers\V1\Admin;

use App\Responses\AppResponse;
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
     * @param AppResponse $res
     *
     * @return AppResponse
     * @author malayvuong
     * @since 7.0.0 - 2022-09-20, 23:52 ICT
     */
    public function index(AppResponse $res): AppResponse
    {
//        if (! user()->tokenCan('language.viewAny')) {
//            return $res->failed()->code(403);
//        }

        return $res->data($this->model->getModel()->all());
    }
}
