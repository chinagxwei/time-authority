<?php

use App\Http\Controllers\System\Business\OrganizationController;
use Illuminate\Support\Facades\Route;

Route::group([
    'middleware' => 'api',
    'prefix' => 'v1/system'
], function ($router) {
    Route::any('organization/index', [OrganizationController::class, 'index']);
    Route::any('organization/save', [OrganizationController::class, 'save']);
    Route::any('organization/view', [OrganizationController::class, 'view']);
    Route::any('organization/delete', [OrganizationController::class, 'delete']);
});
