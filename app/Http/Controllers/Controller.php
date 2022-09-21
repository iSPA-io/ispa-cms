<?php

namespace App\Http\Controllers;

use App\Repositories\Interface\TestInterface;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected TestInterface $test;

    public function __construct(TestInterface $test)
    {
        $this->test = $test;
    }

    public function test()
    {
        $user = $this->test->find(1);

        dd($user);
    }
}
