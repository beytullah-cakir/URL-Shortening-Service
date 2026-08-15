<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UrlController;
use App\Http\Controllers\Api\UrlRedirectController;

Route::post("/login", [AuthController::class, "login"]);
Route::post("/register", [AuthController::class, "register"]);



Route::middleware("auth:sanctum")->group(function () {
    Route::post("/urls", [UrlController::class, "store"]);
    Route::get("/urls", [UrlController::class, "index"]);
    Route::get("/me", [AuthController::class, "me"]);
    Route::post("/logout", [AuthController::class, "logout"]);
    Route::get("/urls/{url}", [UrlController::class, "show"]);
    Route::post("/urls/{url}", [UrlController::class, "update"]);
    Route::delete("/urls/{url}", [UrlController::class, "delete"]);
    Route::get("/urls/{url}/analytics", [UrlController::class, "analytics"]);
});

