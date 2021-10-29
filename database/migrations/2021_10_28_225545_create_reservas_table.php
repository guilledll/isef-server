<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservasTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('reservas', function (Blueprint $table) {
      $table->bigIncrements('id');
      $table->foreignId('user_ci')->constrained();
      $table->dateTime('fecha_inicio');
      $table->dateTime('fecha_fin');
      $table->string('lugar', 50);
      $table->string('razon', 100);
      $table->integer('estado');
      $table->string('Notas_guardia', 100);
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('reservas');
  }
}
