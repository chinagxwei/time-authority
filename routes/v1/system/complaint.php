<?php

use App\Http\Controllers\System\SystemComplaintController;
use Illuminate\Support\Facades\Route;

Route::group([
    'middleware' => 'api',
    'prefix' => 'v1/system'

], function ($router) {
    Route::any('complaint/index', [SystemComplaintController::class, 'index']);
    Route::any('complaint/save', [SystemComplaintController::class, 'save']);
    Route::any('complaint/view', [SystemComplaintController::class, 'view']);
    Route::any('complaint/delete', [SystemComplaintController::class, 'delete']);
});
