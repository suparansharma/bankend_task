<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;

// Default home route
Route::get('/', function () {
    return view('welcome');
});

// Book routes

Route::prefix('api')->group(function () {
    Route::get('/books', [BookController::class, 'index']);
    Route::post('/books', [BookController::class, 'store']);
    Route::get('/books/{id}', [BookController::class, 'show']);
    Route::put('/books/{id}', [BookController::class, 'update']);
    Route::delete('/books/{id}', [BookController::class, 'destroy']);
    
});

