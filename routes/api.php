<?php

use App\Http\Controllers AS Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/register', [Controller\AuthController::class, 'register']);
Route::post('/login', [Controller\AuthController::class, 'login']);
Route::get('/logout', [Controller\AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::get('/amounts', [Controller\AmountController::class, 'index']);
Route::get('/amounts/{id}', [Controller\AmountController::class, 'show'])->where('id', '[0-9].*');
Route::post('/amounts/{id}', [Controller\AmountController::class, 'store'])->where('id', '[0-9].*');
Route::get('/references', [Controller\ReferenceController::class, 'index']);
Route::get('/references/{id}', [Controller\ReferenceController::class, 'show'])->where('id', '[0-9].*');
Route::post('/references/{id}', [Controller\ReferenceController::class, 'store'])->where('id', '[0-9].*');
