<?php

use Illuminate\Support\Facades\Route;
use Gridonic\AltTextGenerator\Controllers\AltTextGeneratorController;

Route::prefix('api')->group(function () {
    Route::post('altTextGeneratorEndpoint', [AltTextGeneratorController::class, 'submitData']);
});
