<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\DivisionsController;
use App\Http\Controllers\Api\KaryawanController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->group(function () {
    Route::resource('/divisions', DivisionsController::class);
    Route::resource('/employees', KaryawanController::class);
    Route::post('logout', [AuthController::class, 'logout']);
});
