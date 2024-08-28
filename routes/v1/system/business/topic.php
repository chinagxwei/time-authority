<?php

use App\Http\Controllers\System\Business\TopicController;
use Illuminate\Support\Facades\Route;

Route::group([
    'middleware' => 'api',
    'prefix' => 'v1/system'
], function ($router) {
    Route::any('topic/index', [TopicController::class, 'index']);
    Route::any('topic/save', [TopicController::class, 'save']);
    Route::any('topic/view', [TopicController::class, 'view']);
    Route::any('topic/delete', [TopicController::class, 'delete']);
});
