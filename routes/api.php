<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\RecipeIngredientController;
use App\Http\Controllers\RecipeCategoryController;

Route::prefix('categories')->group(function () {
    Route::post('/', [CategoryController::class, 'store']);
    Route::get('/search', [CategoryController::class, 'search']);
});

Route::prefix('ingredients')->group(function () {
    Route::post('/', [CategoryController::class, 'store']);
    Route::get('/search', [CategoryController::class, 'search']);
});

Route::prefix('recipes')->group(function () {
    Route::get('/', [RecipeController::class, 'index']);
    Route::post('/', [RecipeController::class, 'store']);
    Route::get('/{recipe}', [RecipeController::class, 'show']);
    Route::put('/{recipe}', [RecipeController::class, 'update']);
    Route::delete('/{recipe}', [RecipeController::class, 'destroy']);
    Route::get('/search', [RecipeController::class, 'search']);
});

Route::prefix('recipes/{recipe}/ingredient')->group(function () {
    Route::post('/', [RecipeIngredientController::class, 'addIngredientToRecipe']);    
    // Update ingredient in a recipe (update quantity, unit)
    Route::put('/{ingredient}', [RecipeIngredientController::class, 'updateIngredientInRecipe']);
    Route::delete('/{ingredient}', [RecipeIngredientController::class, 'removeIngredientFromRecipe']);
});

Route::prefix('recipes/{recipe}/category')->group(function () {
    Route::post('/{category}', [RecipeCategoryController::class, 'addCategoryToRecipe']);
    Route::delete('/{category}', [RecipeCategoryController::class, 'removeIngredientFromRecipe']);
});