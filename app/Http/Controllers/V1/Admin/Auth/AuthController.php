<?php

namespace App\Http\Controllers\V1\Admin\Auth;

use App\Responses\AppResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Auth\SignInRequest;
use App\Repositories\Interface\UserInterface;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Contracts\Container\BindingResolutionException;

class AuthController extends Controller
{
    protected UserInterface $model;

    /**
     * Controller constructor
     *
     * @since 7.0.0 - 2022-09-26, 23:44 ICT
     * @author malayvuong
     */
    public function __construct(UserInterface $model)
    {
        $this->model = $model;
    }

    /**
     * Process to sign in
     *
     * @author malayvuong
     * @since 7.0.0 - 2022-09-25, 00:10 ICT
     */
    public function signIn(SignInRequest $request, AppResponse $response)
    {
        if ($request->validatorFails()) {
            return $response->setStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
                ->setMessage($request->validatorErrors())
                ->setError();
        }

        $user = $this->model->getByUsernameOrEmail($request->input('username'), [], ["*"]);

        if (! Hash::check($request->input('password'), $user->password)) {
            return $response->setStatus(Response::HTTP_NOT_ACCEPTABLE)
                ->setMessage(__('auth.failed') . '-pws: '. $request->input('password'))
                ->setError();
        } else if (is_null($user)) {
            return $response->setStatus(Response::HTTP_NOT_ACCEPTABLE)
                ->setMessage(__('auth.failed') . '....')
                ->setError();
        }

        // Todo: generate token

        return $response->setData([
            'user' => $user,
            'token' => 'token',
            'request' => $request->all(),
        ])->setMessage('Sign in successfully');
    }
}
