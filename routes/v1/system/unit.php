<?php

use App\Http\Controllers\System\SystemUnitController;
use Illuminate\Support\Facades\Route;

Route::group([
    'middleware' => 'api',
    'prefix' => 'v1/system'

], function ($router) {
    Route::any('unit/index', [SystemUnitController::class, 'index']);
    Route::any('unit/save', [SystemUnitController::class, 'save']);
    Route::any('unit/view', [SystemUnitController::class, 'view']);
    Route::any('unit/delete', [SystemUnitController::class, 'delete']);
});
