<?php

use App\Http\Controllers\System\SystemLogController;
use Illuminate\Support\Facades\Route;

Route::group([
    'middleware' => 'api',
    'prefix' => 'v1/system'

], function ($router) {
    Route::any('log/index', [SystemLogController::class, 'index']);
});
