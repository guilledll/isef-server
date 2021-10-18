<?php

use App\Http\Controllers\API\DepartamentoController;
use App\Http\Controllers\API\InventarioController;
use App\Http\Controllers\API\MaterialController;
use App\Http\Controllers\API\CategoriaController;
use App\Http\Controllers\API\DepositoController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'v1'], function () {
  Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/user', AuthController::class);
    Route::put('/users/{ci}/rol', [UserController::class, 'updateRol']);
    Route::apiResources([
      'users' => UserController::class,
      'departamentos' => DepartamentoController::class,
      'depositos' => DepositoController::class,
      'categorias' => CategoriaController::class,
      'materiales' => MaterialController::class,
      'inventario' => InventarioController::class
    ]);
  });

  Route::get('/departamentos', [DepartamentoController::class, 'index'])
    ->withoutMiddleware('auth:sanctum');
});
