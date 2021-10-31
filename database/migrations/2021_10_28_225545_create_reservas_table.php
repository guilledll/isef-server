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
      $table->unsignedBigInteger('id')->primary();
      $table->unsignedInteger('user_ci');
      $table->dateTime('fecha_inicio');
      $table->dateTime('fecha_fin');
      $table->string('lugar', 100);
      $table->string('razon', 200);
      $table->integer('estado')->default(0);
      $table->string('notas_guardia', 100);
      $table->timestamps();

      $table->foreign('user_ci')
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
    Schema::dropIfExists('reservas');
  }
}
