<?php

use App\Http\Controllers\System\Business\AreaController;
use Illuminate\Support\Facades\Route;

Route::group([
    'middleware' => 'api',
    'prefix' => 'v1/system'
], function ($router) {
    Route::any('area/index', [AreaController::class, 'index']);
    Route::any('area/save', [AreaController::class, 'save']);
    Route::any('area/view', [AreaController::class, 'view']);
    Route::any('area/delete', [AreaController::class, 'delete']);
});
