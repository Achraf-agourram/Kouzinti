<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/login', [AuthController::class, 'authPage']);
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'authPage']);
Route::post('/register', [AuthController::class, 'register']);