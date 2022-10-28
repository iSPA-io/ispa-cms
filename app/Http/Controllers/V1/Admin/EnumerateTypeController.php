<?php

namespace App\Http\Controllers\V1\Admin;

use Exception;
use ErrorException;
use App\Responses\AppResponse;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\AdminController;
use Symfony\Component\HttpFoundation\Response;
use App\Repositories\Interface\EnumerateTypeInterface;
use App\Http\Requests\EnumerateType\GetEnumerateTypeRequest;
use App\Http\Requests\EnumerateType\StoreEnumerateTypeRequest;

class EnumerateTypeController extends AdminController
{
    protected EnumerateTypeInterface $model;

    /**
     * EnumerateTypeController constructor
     *
     * @param EnumerateTypeInterface $model
     *
     * @author malayvuong
     * @since 7.0.0 - 2022-09-20, 23:52 ICT
     */
    public function __construct(EnumerateTypeInterface $model)
    {
        parent::__construct();

        $this->model = $model;
    }

    /**
     * Get list EnumerateType
     *
     * @param GetEnumerateTypeRequest $request
     * @param AppResponse $res
     *
     * @return AppResponse
     * @author malayvuong
     * @since 7.0.0 - 2022-09-20, 23:52 ICT
     */
    public function index(GetEnumerateTypeRequest $request, AppResponse $res): AppResponse
    {
//        if (! user()->can('viewAny', $this->model->getModel())) {
//            return $res->noPermission();
//        }
        $data = $this->model->get([]);

        return $res->data($data);
    }

    /**
     * Create new EnumerateType
     *
     * @param StoreEnumerateTypeRequest $request
     * @param AppResponse $res
     *
     * @return AppResponse
     * @author malayvuong
     * @since 7.0.0 - 2022-10-26, 23:46 ICT
     */
    public function store(StoreEnumerateTypeRequest $request, AppResponse $res): AppResponse
    {
//        if (! user()->can('create', $this->model->getModel())) {
//            return $res->failed()->message('You do not have permission to create this resource.')->code(Response::HTTP_FORBIDDEN);
//        }

        $model = $this->model->getModel()->fill($request->validated());

        try {
            $model->save();
        } catch (ErrorException $e) {
            return $res->failed()->message($e->getMessage())->code(Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return $res->data($model)->code(Response::HTTP_CREATED)->message('Create successfully.');
    }
}
