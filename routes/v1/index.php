<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

require_once "system/index.php";

Route::group([
    'middleware' => 'api',
    'prefix' => 'v1/auth'
], function ($router) {

    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
//    Route::post('refresh', [AuthController::class, 'refresh']);
//    Route::get('info', [AuthController::class, 'info']);

});
