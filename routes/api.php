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
        Route::apiResources([
            'users' => UserController::class,
            'departamentos' => DepartamentoController::class,
            'depositos' => DepositoController::class,
            'categorias' => CategoriaController::class,
            'materiales' => CategoriaController::class,
            'inventario' => InventarioController::class
        ]);
    });
    Route::get('/departamentos', [DepartamentoController::class, 'index'])->withoutMiddleware('auth:sanctum');
    Route::post('/departamentos', [DepartamentoController::class, 'store'])->withoutMiddleware('auth:sanctum');

    //Depositos http://localhost:8000/api/v1/depositos
    Route::get('/depositos', [DepositoController::class, 'index'])->withoutMiddleware('auth:sanctum');
    Route::post('/depositos', [DepositoController::class, 'store'])->withoutMiddleware('auth:sanctum');

    //Categorias http://localhost:8000/api/v1/categorias
    Route::get('/categorias', [CategoriaController::class, 'index'])->withoutMiddleware('auth:sanctum');
    Route::post('/categorias', [CategoriaController::class, 'store'])->withoutMiddleware('auth:sanctum');

    //Materiales http://localhost:8000/api/v1/materiales
    Route::get('/materiales', [MaterialController::class, 'index'])->withoutMiddleware('auth:sanctum');
    Route::post('/materiales', [MaterialController::class, 'store'])->withoutMiddleware('auth:sanctum');

    //Inventario http://localhost:8000/api/v1/inventario
    Route::get('/inventario', [InventarioController::class, 'index'])->withoutMiddleware('auth:sanctum');
});
