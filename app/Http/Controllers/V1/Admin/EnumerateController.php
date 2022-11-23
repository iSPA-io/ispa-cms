<?php

namespace App\Http\Controllers\V1\Admin;

use App\Responses\AppResponse;
use App\Http\Controllers\AdminController;
use App\Repositories\Interface\EnumerateInterface;
use App\Http\Requests\Enumerate\GetEnumerateRequest;
use App\Http\Resources\Enumerate\EnumerateCollection;

class EnumerateController extends AdminController
{
    protected EnumerateInterface $model;

    /**
     * EnumerateController constructor
     *
     * @param EnumerateInterface $model
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
     * @param GetEnumerateRequest $request
     * @param AppResponse $res
     *
     * @return AppResponse
     * @author malayvuong
     * @since 7.0.0 - 2022-09-20, 23:52 ICT
     */
    public function index(GetEnumerateRequest $request, AppResponse $res): AppResponse
    {
        if (! user()->tokenCan('enumerate.viewAny')) {
            return $res->noPermission();
        }

        $data = $this->model->get([
            'perPage' => $request->input('perPage', 10),
            'latest' => true,
        ]);

        return $res->data(new EnumerateCollection($data));
    }
}
