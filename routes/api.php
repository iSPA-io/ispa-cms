<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('v1')->namespace('V1')->group(function () {
    Route::prefix('i18n')->namespace('Admin')->group(function () {
        Route::get('{version}/{type}/{locale}.json', 'I18nController@languages');
    });

    Route::prefix('admin')->namespace('Admin')->group(static function () {
        //  Route with no auth sanctum
        Route::prefix('auth')->namespace('Auth')->group(function () {
            Route::post('sign-in', 'AuthController@signIn');
//        Route::post('register', 'AuthController@register');
//        Route::post('logout', 'AuthController@logout');
//        Route::post('refresh', 'AuthController@refresh');
//        Route::post('me', 'AuthController@me');
        });

        Route::group(['middleware' => ['auth:sanctum']], static function () {
            //  Account
            Route::controller('AccountController')->prefix('account')->group(function () {
                Route::get('', 'account');
                Route::post('change-password', 'changePassword');
                Route::post('sign-out', 'signOut');
            });

            //  Language
            Route::controller('LanguageController')->prefix('languages')->group(function () {
                Route::get('/', 'index');
            });

            //  Enumerate
            Route::controller('EnumerateTypeController')->prefix('enumerate/type')->group(function () {
                Route::get('/', 'index');
                Route::post('/', 'store');
            });
        });
    });
});
