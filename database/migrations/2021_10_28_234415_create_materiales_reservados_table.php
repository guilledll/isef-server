<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaterialesReservadosTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('materiales_reservados', function (Blueprint $table) {
      $table->bigIncrements('id');
      $table->unsignedBigInteger('reserva_id')->index();
      $table->unsignedBigInteger('material_id')->index();
      $table->unsignedInteger('cantidad');

      $table->foreign('reserva_id')
        ->references('id')->on('reservas');

      $table->foreign('material_id')
        ->references('id')->on('materiales');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('materiales_reservados');
  }
}
