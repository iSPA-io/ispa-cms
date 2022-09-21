<?php

namespace App\Repositories\Interface;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

interface RepositoryInterface
{
    /** Get Model instance */
    public function getModel();

    /** Set Model instance */
    public function setModel($model);

    /** Get the table name */
    public function getTable();

    /** Reset the Model repositories */
    public function resetModel();

    /**
     * Find by ID
     *
     * @param int $id
     * @param array $select
     * @param array $with
     *
     * @return Model|Collection|Builder|array|null
     */
    public function find(int $id, array $select = ['*'], array $with = []): Model|Collection|Builder|array|null;
}
