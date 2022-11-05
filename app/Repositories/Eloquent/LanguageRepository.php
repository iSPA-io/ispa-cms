<?php

namespace App\Repositories\Eloquent;

use App\Models\Language;
use App\Repositories\Interface\LanguageInterface;
use Illuminate\Contracts\Container\BindingResolutionException;

class LanguageRepository extends RepositoriesAbstract implements LanguageInterface
{
    /**
     * Init new object with the model
     *
     * @throws BindingResolutionException
     * @since 7.0.0 - 2022-09-28, 23:34 ICT
     * @author malayvuong
     */
    public function __construct()
    {
        $this->model = app()->make(Language::class);
        $this->originalModel = $this->model;
    }
}
