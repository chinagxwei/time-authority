<?php


use App\Http\Controllers\System\SystemMessageController;
use Illuminate\Support\Facades\Route;

Route::group([
    'middleware' => 'api',
    'prefix' => 'v1/system'

], function ($router) {
    Route::any('message/index', [SystemMessageController::class, 'index']);
    Route::any('message/save', [SystemMessageController::class, 'save']);
    Route::any('message/delete', [SystemMessageController::class, 'delete']);
});
