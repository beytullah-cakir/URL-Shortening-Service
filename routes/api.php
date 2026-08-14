<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UrlController;

Route::post("/login", [AuthController::class, "login"]);
Route::post("/register", [AuthController::class, "register"]);

Route::middleware("auth:sanctum")->group(function () {
    Route::post("/urls", [UrlController::class, "saveURL"]);
    Route::get("/urls", [UrlController::class, "index"]);
    Route::get("/me", [AuthController::class, "me"]);
    Route::post("/logout", [AuthController::class, "logout"]);
});

