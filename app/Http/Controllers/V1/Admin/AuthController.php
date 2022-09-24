<?php

namespace App\Http\Controllers\V1\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Auth\SignInRequest;

class AuthController extends Controller
{
    /**
     * Process to sign in
     *
     * @author malayvuong
     * @since 7.0.0 - 2022-09-25, 00:10 ICT
     */
    public function signIn(SignInRequest $request)
    {
        return response()->json([
            'message' => 'Sign in successfully',
            'data' => $request->validated()
        ]);
    }
}
