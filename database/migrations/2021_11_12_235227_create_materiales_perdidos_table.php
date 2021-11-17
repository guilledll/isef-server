<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaterialesPerdidosTable extends Migration
{

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('materiales_perdidos', function (Blueprint $table) {
      $table->bigIncrements('id');
      $table->unsignedInteger('reportador_ci')->index();
      $table->unsignedBigInteger('reserva_id')->index();
      $table->string('nota', 500);
      $table->dateTime('fecha');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('materiales_perdidos');
  }
}
