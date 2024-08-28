<?php

use App\Http\Controllers\System\Business\TagController;
use Illuminate\Support\Facades\Route;

Route::group([
    'middleware' => 'api',
    'prefix' => 'v1/system'
], function ($router) {
    Route::any('tag/index', [TagController::class, 'index']);
    Route::any('tag/save', [TagController::class, 'save']);
    Route::any('tag/view', [TagController::class, 'view']);
    Route::any('tag/delete', [TagController::class, 'delete']);
});
