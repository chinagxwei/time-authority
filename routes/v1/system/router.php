<?php

use App\Http\Controllers\System\SystemRouterController;
use Illuminate\Support\Facades\Route;

Route::group([
    'middleware' => 'api',
    'prefix' => 'v1/system'

], function ($router) {
    Route::any('router/index', [SystemRouterController::class, 'index']);
    Route::any('router/save', [SystemRouterController::class, 'save']);
    Route::any('router/delete', [SystemRouterController::class, 'delete']);
    Route::any('router/system-router', [SystemRouterController::class, 'systemRouter']);
    Route::any('router/registered-router', [SystemRouterController::class, 'registeredRouter']);
});
