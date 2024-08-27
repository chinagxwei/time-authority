<?php

use App\Http\Controllers\System\SystemAgreementController;
use Illuminate\Support\Facades\Route;

Route::group([
    'middleware' => 'api',
    'prefix' => 'v1/system'

], function ($router) {
    Route::any('agreement/index', [SystemAgreementController::class, 'index']);
    Route::any('agreement/save', [SystemAgreementController::class, 'save']);
    Route::any('agreement/view', [SystemAgreementController::class, 'view']);
    Route::any('agreement/delete', [SystemAgreementController::class, 'delete']);
});
