<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Deposito;
use App\Models\Inventario;
use App\Models\Material;
use App\Models\Reserva;
use Illuminate\Http\Request;

class ExistenController extends Controller
{
  /**
   * Retorna si existe o no algun registro de cada modelo
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function __invoke(Request $request)
  {
    return response()->json([
      'depositos' => Deposito::first() ? true : false,
      'materiales' => Material::where('cantidad', '>', 0)->first() ? true : false,
      'reservas' => Reserva::first() ? true : false,
      // 'registros' => Inventario::first() ? true : false,
    ]);
  }
}
