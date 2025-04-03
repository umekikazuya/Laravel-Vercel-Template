<?php

/**
 * @file
 */

use Illuminate\Support\Facades\Route;

Route::get('/test', function () {
    return response()->json([
        'status' => 'success',
        'message' => 'Test API endpoint',
        'version' => '1.0.0',
    ]);
});
