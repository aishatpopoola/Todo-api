<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BookController;

Route::middleware('auth:sanctum')->group(
    function () {
        Route::get("sign-out", [UserController::class, 'signOut'])->name('signout');
        // Route::get("user", [UserController::class, 'getUser'])->name('user.get');
        Route::get("books/{book_id?}", [BookController::class, 'getBooks'])->name('books.get');
        Route::post("books", [BookController::class, 'createBook'])->name('book.create');
        Route::patch("books", [BookController::class, 'updateBook'])->name('book.update');
        Route::delete("books/{book_id}", [BookController::class, 'deleteBook'])->name('book.delete');
    }
);

Route::post("sign-up", [UserController::class, 'signUp'])->name('signup');
Route::post("/sign-in", [UserController::class, 'signIn'])->name('signin');
// https://peaceful-cove-38084.herokuapp.com/api/update-book
