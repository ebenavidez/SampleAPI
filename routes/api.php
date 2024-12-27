<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TagController;

Route::prefix('categories')->group(function () {
    Route::post('/', [CategoryController::class, 'store']); // Add a new category
    Route::get('/search', [CategoryController::class, 'search']);
});

Route::prefix('tags')->group(function () {
    Route::post('/', [TagController::class, 'store']); // Add a new tag
    Route::get('/search', [TagController::class, 'search']);
});