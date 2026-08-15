<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UrlController;
use App\Http\Controllers\Api\UrlRedirectController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return response()->json([
        'status' => 'success',
        'message' => 'URL Shortener API'
    ]);
});

Route::get('/{short_code}', [UrlRedirectController::class, 'redirect']);

