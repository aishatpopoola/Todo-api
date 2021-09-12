<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::middleware('auth:sanctum')->group(
    function () {
        Route::get("logout", [UserController::class, 'logout'])->name('logout');
        Route::get("user", [UserController::class, 'getUser'])->name('user.get');
    }
);

Route::post("register", [UserController::class, 'register'])->name('register');
Route::post("/login", [UserController::class, 'login'])->name('login');
