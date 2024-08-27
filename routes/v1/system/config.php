<?php


use App\Http\Controllers\System\SystemConfigController;
use Illuminate\Support\Facades\Route;

Route::group([
    'middleware' => 'api',
    'prefix' => 'v1/system'

], function ($router) {
    Route::any('config/index', [SystemConfigController::class, 'index']);
    Route::any('config/save', [SystemConfigController::class, 'save']);
    Route::any('config/delete', [SystemConfigController::class, 'delete']);
});
