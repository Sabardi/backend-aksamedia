<?php

use App\Http\Controllers\Api\DivisionsController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('login', [UserController::class, 'login']);
Route::resource('/divison', DivisionsController::class,);
Route::get('search', [DivisionsController::class, 'search']);
