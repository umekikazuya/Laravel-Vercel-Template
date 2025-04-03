<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return response()->json([
        'status' => 'success',
        'message' => 'Test Web endpoint',
        'version' => '1.0.0',
    ]);
});
