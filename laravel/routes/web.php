<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\RecipeController;
use Illuminate\Support\Facades\Route;

Route::get('/login', [AuthController::class, 'authPage']);
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'authPage']);
Route::post('/register', [AuthController::class, 'register']);

Route::get('/home', [RecipeController::class, 'recipesPage']);