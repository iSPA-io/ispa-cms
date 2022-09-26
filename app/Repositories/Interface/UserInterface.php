<?php

namespace App\Repositories\Interface;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

interface UserInterface extends RepositoryInterface
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
    public function getByUsernameOrEmail(string $condition, array $with, array $select): Model|Builder|null;
}
