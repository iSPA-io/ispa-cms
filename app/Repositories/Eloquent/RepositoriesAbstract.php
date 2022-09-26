<?php

namespace App\Repositories\Eloquent;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
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

    /**
     * Get data by condition
     *
     * @param array $params
     *
     * @return Model|Collection|Builder|array|LengthAwarePaginator|null
     * @author malayvuong
     * @since 7.0.0 - 2022-09-26, 23:46 ICT
     */
    public function get(array $params): Model|Collection|Builder|array|null|LengthAwarePaginator
    {
        $params = array_merge([
            'where' => [],
            'order' => [],
            'pageSize' => -1,
            'take' => null,
            'select' => ['*'],
            'with' => [],
            'when' => [],
            'withTrashed' => false,
            'latest' => false,
            'has' => [],
        ], $params);

        //  Set the condition
        $this->where($params['where']);
        //  Set model data
        $data = $this->model;

        if ($params['latest']) {
            if (typeof($params['latest']) == 'string') {
                $data = $data->latest($params['latest']);
            } else {
                $data = $data->latest();
            }
        }

        //  Set the order
        foreach($params['order'] as $column => $direction) {
            $data = $data->orderBy($column, $direction);
        }

        //  Set select column
        if (! empty($params['select'])) {
            $data = $data->select($params['select']);
        }

        //  get data with trashed item
        if ($params['withTrashed']) {
            $data = $data->withTrashed();
        }

        //  set where has
        if (! empty($params['has']) && is_array($params['has'])) {
            foreach($params['has'] as $relation => $condition) {
                $data = $data->whereHas($relation, $condition);
            }
        }

        //  Set relationship
        if (! empty($params['with']) && is_array($params['with']) && count($params['with']) > 0) {
            $data = $data->with($params['with']);
        }

        //  Set when condition
        if (! empty($params['when']) && is_array($params['when']) && count($params['when']) > 0) {
            foreach($params['when'] as $when) {
                if (is_array($when) && count($when) === 2) {
                    $data = $data->when($when[0], $when[1]);
                }
            }
        }

        if ($params['take'] === 1) {
            $result = $data->first();
        } else if ($params['take'] > 1) {
            $result = $data->take($params['take'])->get();
        } else if (isset($params['pageSize']) && $params['pageSize'] > -1) {
            $result = $data->paginate($params['pageSize'] > 0 ? $params['pageSize'] : 20);
        } else {
            $result = $data->get();
        }

        $this->resetModel();

        return $result;
    }

    /**
     * Set where condition
     *
     * @param array $where
     * @param null $model
     *
     * @author malayvuong
     * @since 7.0.0 - 2022-09-26, 23:49 ICT
     */
    public function where(array $where, &$model = null): void
    {
        $model = null;

        if (!(null)) {
            $newModel = $this->getModel();
        } else {
            $newModel = null;
        }

        foreach ($where as $key => $value) {
            if (is_array($value)) {
                [$field, $condition, $val] = $value;
                $newModel = match(Str::upper($condition)) {
                    'IN' => $newModel->whereIn($field, $val),
                    'NOT_IN' => $newModel->whereNotIn($field, $val),
                    default => $newModel->where($field, $condition, $val),
                };
            } else {
                if (is_callable($value)) {
                    $newModel = $newModel->where($value);
                } else {
                    $newModel = $newModel->where($key, $value);
                }
            }
        }

        if (!(null)) {
            $this->model = $newModel;
        } else {
            $model = $newModel;
        }
    }
}
