<?php

use App\Http\Controllers\API\UserController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'v1'], function () {
  Route::apiResources([
    'users' => UserController::class,
  ]);
});
