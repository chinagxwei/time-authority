<?php

use App\Http\Controllers\System\Business\WechatMiniProgramAccountController;
use App\Http\Controllers\System\Business\WechatOfficeAccountController;
use Illuminate\Support\Facades\Route;

Route::group([
    'middleware' => 'api',
    'prefix' => 'v1/system'
], function ($router) {
    Route::any('mini_program_account/index', [WechatMiniProgramAccountController::class, 'index']);
    Route::any('mini_program_account/view', [WechatMiniProgramAccountController::class, 'view']);
    Route::any('mini_program_account/delete', [WechatMiniProgramAccountController::class, 'delete']);

    Route::any('office_account/index', [WechatOfficeAccountController::class, 'index']);
    Route::any('office_account/view', [WechatOfficeAccountController::class, 'view']);
    Route::any('office_account/delete', [WechatOfficeAccountController::class, 'delete']);
});
