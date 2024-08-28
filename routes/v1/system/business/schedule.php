<?php

use App\Http\Controllers\System\Business\ScheduleController;
use Illuminate\Support\Facades\Route;

Route::group([
    'middleware' => 'api',
    'prefix' => 'v1/system'
], function ($router) {
    Route::any('schedule/index', [ScheduleController::class, 'index']);
    Route::any('schedule/save', [ScheduleController::class, 'save']);
    Route::any('schedule/view', [ScheduleController::class, 'view']);
    Route::any('schedule/delete', [ScheduleController::class, 'delete']);
});
