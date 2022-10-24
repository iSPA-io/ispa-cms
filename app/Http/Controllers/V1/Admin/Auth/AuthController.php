<?php

namespace App\Http\Controllers\V1\Admin\Auth;

use App\Events\AuditLogEvent;
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
    public function signIn(SignInRequest $request, AppResponse $response): AppResponse
    {
        $user = $this->model->getByUsernameOrEmail($request->input('username'), [], ["*"]);

        if (is_null($user) || ! Hash::check($request->input('password'), $user->password)) {
            return $response->failed()->message(__('auth.failed'));
        }

        // Token generation
        $token = $user->createToken('auth_token')->plainTextToken;

        //  fire event to log user login
        event(new AuditLogEvent('auth.sign-in', 'fa fa-sign-in-alt', 'success', get_class($user), $user->id, [], []));

        return $response->data([
            'account' => $user,
            'token' => $token,
        ])->message('Sign in successfully');
    }
}
