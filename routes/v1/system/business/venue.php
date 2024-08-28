<?php

use App\Http\Controllers\System\Business\VenueController;
use Illuminate\Support\Facades\Route;

Route::group([
    'middleware' => 'api',
    'prefix' => 'v1/system'
], function ($router) {
    Route::any('venue/index', [VenueController::class, 'index']);
    Route::any('venue/save', [VenueController::class, 'save']);
    Route::any('venue/view', [VenueController::class, 'view']);
    Route::any('venue/delete', [VenueController::class, 'delete']);
});
