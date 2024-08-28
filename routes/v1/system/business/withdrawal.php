<?php

use App\Http\Controllers\System\Business\WithdrawalConfigController;
use App\Http\Controllers\System\Business\WithdrawalController;
use Illuminate\Support\Facades\Route;

Route::group([
    'middleware' => 'api',
    'prefix' => 'v1/system'
], function ($router) {
    Route::any('withdrawal/index', [WithdrawalController::class, 'index']);
    Route::any('withdrawal/view', [WithdrawalController::class, 'view']);
    Route::any('withdrawal/delete', [WithdrawalController::class, 'delete']);

    Route::any('withdrawal_config/index', [WithdrawalConfigController::class, 'index']);
    Route::any('withdrawal_config/view', [WithdrawalConfigController::class, 'view']);
    Route::any('withdrawal_config/save', [WithdrawalConfigController::class, 'save']);
    Route::any('withdrawal_config/delete', [WithdrawalConfigController::class, 'delete']);
});
