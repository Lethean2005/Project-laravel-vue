<?php

use App\Http\Controllers\Api\PostController as ApiPostController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('students')->group(function () {
    Route::get('/', [StudentController::class, 'index']);
    Route::get('/{id}', [StudentController::class, 'show']);
});

// Route::get('/posts', [ApiPostController::class, 'index']);

Route::fallback(function () {
    return "404 page not found!";
});

Route::resource('customer', CustomerController::class);


Route::resource('posts', PostController::class);
