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
      $table->unsignedInteger('user_ci')->index();
      $table->unsignedInteger('guardia_ci')->index();
      $table->dateTime('inicio');
      $table->dateTime('fin');
      $table->string('lugar', 200);
      $table->string('razon', 200);
      $table->integer('estado')->default(0);
      $table->string('nota_guardia', 500);
      $table->string('nota_usuario', 500);
      $table->timestamps();

      $table->foreign('user_ci')
        ->references('ci')->on('users');

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
    Schema::dropIfExists('reservas');
  }
}
