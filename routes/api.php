<?php

use App\Http\Controllers\API\DepartamentoController;
use App\Http\Controllers\API\UserController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'v1'], function () {
  Route::middleware(['auth:sanctum'])->group(function () {
    Route::apiResources([
      'users' => UserController::class,
      'departamentos' => DepartamentoController::class
    ]);
  });
  Route::get('/departamentos', [DepartamentoController::class, 'index'])->withoutMiddleware('auth:sanctum');
});
