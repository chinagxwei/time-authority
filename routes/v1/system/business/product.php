<?php

use App\Http\Controllers\System\Business\ProductVipController;
use Illuminate\Support\Facades\Route;

Route::group([
    'middleware' => 'api',
    'prefix' => 'v1/system'
], function ($router) {
    Route::any('product_vip/index', [ProductVipController::class, 'index']);
    Route::any('product_vip/save', [ProductVipController::class, 'save']);
    Route::any('product_vip/view', [ProductVipController::class, 'view']);
    Route::any('product_vip/delete', [ProductVipController::class, 'delete']);
});
