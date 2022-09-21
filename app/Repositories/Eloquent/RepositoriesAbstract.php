<?php

namespace App\Repositories\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\Interface\RepositoryInterface;

abstract class RepositoriesAbstract implements RepositoryInterface
{
    /** @var Model|Builder $model */
    protected Model|Builder $model;

    /** @var Model|Builder $originalModel */
    protected Model|Builder $originalModel;

    /**
     * RepositoriesAbstract constructor
     *
     * @author malayvuong
     * @since 7.0.0 - 2022-09-19, 22:55 ICT
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
        $this->originalModel = $model;
    }

    /**
     * Get Model instance
     *
     * @return Model|Builder
     */
    public function getModel(): Model|Builder
    {
        return $this->model;
    }

    /**
     * Set Model instance
     *
     * @param $model
     *
     * @return RepositoriesAbstract
     */
    public function setModel($model): self
    {
        $this->model = $model;

        return $this;
    }

    /**
     * Get the table name
     *
     * @return string
     */
    public function getTable(): string
    {
        return $this->model->getTable();
    }

    /**
     * Reset the Model repositories
     *
     * @return RepositoriesAbstract
     */
    public function resetModel(): self
    {
        $this->model = new $this->originalModel;

        return $this;
    }

    /**
     * Find by ID
     *
     * @param int $id
     * @param array $select
     * @param array $with
     *
     * @return Model|Collection|Builder|array|null
     */
    public function find(int $id, array $select = ['*'], array $with = []): Model|Collection|Builder|array|null
    {
        $model = $this->with($with)->select($select)->find($id);

        return $model;
    }

    /**
     * Init the with* relationship
     *
     * @param array $with
     *
     * @return Model|Builder
     * @author malayvuong
     * @since 7.0.0 - 2022-09-21, 23:46 ICT
     */
    protected function with(array $with = []): Model|Builder
    {
        if (! empty($with)) {
            $this->model = $this->getModel()->with($with);
        }

        return $this->model;
    }
}
