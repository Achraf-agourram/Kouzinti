<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\RecipeController;
use Illuminate\Support\Facades\Route;

Route::get('/login', [AuthController::class, 'authPage'])->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])->middleware('guest');;

Route::get('/register', [AuthController::class, 'authPage'])->middleware('guest');;
Route::post('/register', [AuthController::class, 'register'])->middleware('guest');;

Route::get('/home', [RecipeController::class, 'recipesPage'])->middleware('auth');
Route::get('/recipes', [RecipeController::class, 'recipesPage'])->middleware('auth');