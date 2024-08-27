<?php

use App\Http\Controllers\System\SystemFileController;
use Illuminate\Support\Facades\Route;

Route::group([
    'middleware' => 'api',
    'prefix' => 'v1/system'

], function ($router) {
    Route::any('image/index', [SystemFileController::class, 'index']);
    Route::any('image/save', [SystemFileController::class, 'save']);
    Route::any('image/delete', [SystemFileController::class, 'delete']);
});
