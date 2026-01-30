<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;

Route::get('/login', [AuthController::class, 'authPage'])->middleware('guest')->name('login');
Route::post('/login', [AuthController::class, 'login'])->middleware('guest')->name('login');

Route::get('/register', [AuthController::class, 'authPage'])->middleware('guest')->name('login');
Route::post('/register', [AuthController::class, 'register'])->middleware('guest')->name('login');

Route::get('/home', [RecipeController::class, 'home'])->middleware('auth');
Route::get('/recipes', [RecipeController::class, 'recipes'])->middleware('auth');

Route::post('/addRecipe', [RecipeController::class, 'addRecipe'])->middleware('auth');
Route::get('/editRecipe/{id}', [RecipeController::class, 'editRecipeForm'])->middleware('auth');
Route::post('/editRecipe', [RecipeController::class, 'editRecipe'])->middleware('auth');
Route::post('/deleteRecipe', [RecipeController::class, 'deleteRecipe'])->middleware('auth');

Route::get('/category/{category}', [RecipeController::class, 'recipesByCategory'])->middleware('auth');
Route::get('/searchRecipe', [RecipeController::class, 'search'])->middleware('auth');
Route::get('/recipe/{id}', [RecipeController::class, 'showRecipe'])->middleware('auth');

Route::post('/addComment', [CommentController::class, 'addComment'])->middleware('auth');
Route::post('/editComment', [CommentController::class, 'editComment'])->middleware('auth');
Route::post('/deleteComment', [CommentController::class, 'deleteComment'])->middleware('auth');