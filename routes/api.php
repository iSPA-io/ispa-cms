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
});
