<?php

use App\Http\Controllers\API\DepartamentoController;
use App\Http\Controllers\API\DepositoController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'v1'], function () {
  Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/user', AuthController::class);
    Route::apiResources([
      'users' => UserController::class,
      'departamentos' => DepartamentoController::class,
      'depositos' => DepartamentoController::class
    ]);
  });
  Route::get('/departamentos', [DepartamentoController::class, 'index'])->withoutMiddleware('auth:sanctum');
  Route::post('/departamentos', [DepartamentoController::class, 'store'])->withoutMiddleware('auth:sanctum');

  //Depositos http://localhost:8000/api/v1/depositos
  Route::get('/depositos', [DepositoController::class, 'index'])->withoutMiddleware('auth:sanctum');
  Route::post('/depositos', [DepositoController::class, 'store'])->withoutMiddleware('auth:sanctum');

});
