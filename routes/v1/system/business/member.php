<?php

use App\Http\Controllers\System\Business\MemberController;
use Illuminate\Support\Facades\Route;

Route::group([
    'middleware' => 'api',
    'prefix' => 'v1/system'
], function ($router) {
    Route::any('member/index', [MemberController::class, 'index']);
    Route::any('member/view', [MemberController::class, 'view']);
    Route::any('member/delete', [MemberController::class, 'delete']);
});
