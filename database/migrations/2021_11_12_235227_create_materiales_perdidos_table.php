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
      $table->unsignedInteger('guardia_ci')->index();
      $table->unsignedInteger('reserva_id')->constrained();
      $table->string('materiales', 1000)->nullable();
      $table->string('nota', 500)->nullable();
      $table->dateTime('fecha');

      $table->foreign('guardia_ci')
        ->references('ci')->on('users');
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
