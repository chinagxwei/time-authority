<?php

use App\Http\Controllers\System\Business\WalletController;
use Illuminate\Support\Facades\Route;

Route::group([
    'middleware' => 'api',
    'prefix' => 'v1/system'
], function ($router) {
    Route::any('wallet/index', [WalletController::class, 'index']);
    Route::any('wallet/view', [WalletController::class, 'view']);
    Route::any('wallet/delete', [WalletController::class, 'delete']);
});
