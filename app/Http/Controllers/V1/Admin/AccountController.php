<?php

namespace App\Http\Controllers\V1\Admin;

use App\Responses\AppResponse;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\AdminController;
use App\Http\Requests\Account\AdminSignOutRequest;
use App\Http\Requests\Account\AdminChangePasswordRequest;

class AccountController extends AdminController
{
    /**
     * Get account information
     *
     * @author malayvuong
     * @since 7.0.0 - 2022-10-26, 22:55 ICT
     */
    public function account(AppResponse $res): AppResponse
    {
        return $res->data(user());
    }

    /**
     * Sign out
     *
     * @param AdminSignOutRequest $request
     * @param AppResponse $res
     *
     * @return AppResponse
     * @author malayvuong
     * @since 7.0.0 - 2022-10-24, 23:56 ICT
     */
    public function signOut(AdminSignOutRequest $request, AppResponse $res): AppResponse
    {
        user()->currentAccessToken()->delete();

        return $res->message('Sign out successfully');
    }

    /**
     * Change password
     *
     * @param AdminChangePasswordRequest $request
     * @param AppResponse $res
     *
     * @return AppResponse
     * @author malayvuong
     * @since 7.0.0 - 2022-10-24, 23:43 ICT
     */
    public function changePassword(AdminChangePasswordRequest $request, AppResponse $res): AppResponse
    {
        //  Process to check current password
        if (!Hash::check($request->input('current_password'), $request->user()->password)) {
            return $res->failed()->message('Current password is incorrect');
        }
        //  Process to change password
        $request->user()->update([
            'password' => Hash::make($request->input('new_password')),
        ]);

        return $res->message('Change password successfully');
    }
}
