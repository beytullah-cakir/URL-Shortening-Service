<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Sadece Kayıt Ol Sayfasını Yükler (POST ve veritabanı işlemleri sizin tarafınızdan yazılacaktır)
Route::get('/register', function () {
    return view('auth.register');
});

Route::get('/login', function () {
    return view('auth.login');
});

Route::get("/dashboard", function () {return view("dashboard");})->name("dashboard");


Route::get("/dashboard", [DashboardController::class , "index"])->middleware("auth")->name("dashboard");

Route::post("/register",[AuthController::class, "register"]);

Route::post("/login",[AuthController::class, "login"]);
