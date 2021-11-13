<?php

use App\Http\Controllers\API\DepartamentoController;
use App\Http\Controllers\API\InventarioController;
use App\Http\Controllers\API\MaterialController;
use App\Http\Controllers\API\CategoriaController;
use App\Http\Controllers\API\DepositoController;
use App\Http\Controllers\API\ReservaController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MaterialesPerdidosController;
use App\Models\MaterialesPerdidos;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'v1'], function () {
  Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    // Rutas de usuario
    Route::get('/user', AuthController::class)->withoutMiddleware('verified');
    Route::put('/users/{user}/rol', [UserController::class, 'updateRol']);
    // Rutas de departamentos
    Route::get('departamentos/{id}/depositos', [DepartamentoController::class, 'depositos']);
    Route::get('departamentos/{id}/usuarios', [DepartamentoController::class, 'usuarios']);
    // Rutas de depositos
    Route::get('depositos/{id}/materiales', [DepositoController::class, 'materiales']);
    // Rutas de categorias
    Route::get('categorias/{id}/materiales', [CategoriaController::class, 'materiales']);
    // Rutas de materiales
    Route::get('material/{id}/movimientos', [MaterialController::class, 'movimientos']);
    // Rutas de reservas
    Route::post('reservas/iniciar', [ReservaController::class, 'iniciar']);

    Route::apiResources([
      'users' => UserController::class,
      'departamentos' => DepartamentoController::class,
      'depositos' => DepositoController::class,
      'categorias' => CategoriaController::class,
      'material' => MaterialController::class,
      'inventario' => InventarioController::class,
      'reservas' => ReservaController::class,
      'materialesPerdidos' => MaterialesPerdidosController::class,
    ]);
  });

  // Declarada a parte por ser pública.
  Route::get('/departamentos', [DepartamentoController::class, 'index'])
    ->withoutMiddleware('auth:sanctum')
    ->withoutMiddleware('verified');
});
