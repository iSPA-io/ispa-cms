<?php

namespace App\Repositories\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Repositories\Interface\UserInterface;

class UserRepository extends RepositoriesAbstract implements UserInterface
{
    /**
     * Get user by the email or username
     *
     * @param string $condition
     * @param array $with
     * @param array $select
     *
     * @return Model|Builder|null
     * @author malayvuong
     * @since 7.0.0 - 2022-09-27, 00:09 ICT
     */
    public function getByUsernameOrEmail(string $condition, array $with, array $select): Model|Builder|null
    {
        $user = $this->model->where('username', $condition)
            ->orWhere('email', $condition)
            ->with($with)
            ->select($select)
            ->first();

        return $user;
    }
}
