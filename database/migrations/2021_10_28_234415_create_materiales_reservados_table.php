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
      $table->unsignedBigInteger('id')->primary();
      $table->timestamps();
      $table->unsignedBigInteger('reserva_id');
      $table->unsignedBigInteger('material_id');
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
