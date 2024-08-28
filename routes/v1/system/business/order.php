<?php

use App\Http\Controllers\System\Business\OrderController;
use App\Http\Controllers\System\Business\OrderRevenuesConfigController;
use Illuminate\Support\Facades\Route;

Route::group([
    'middleware' => 'api',
    'prefix' => 'v1/system'
], function ($router) {
    Route::any('order/index', [OrderController::class, 'index']);
    Route::any('order/view', [OrderController::class, 'view']);
    Route::any('order/delete', [OrderController::class, 'delete']);

    Route::any('order_revenues_config/index', [OrderRevenuesConfigController::class, 'index']);
    Route::any('order_revenues_config/view', [OrderRevenuesConfigController::class, 'view']);
    Route::any('order_revenues_config/save', [OrderRevenuesConfigController::class, 'save']);
    Route::any('order_revenues_config/delete', [OrderRevenuesConfigController::class, 'delete']);
});
