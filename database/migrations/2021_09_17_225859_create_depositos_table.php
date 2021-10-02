<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepositosTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void 
   */
  public function up()
  {
    Schema::create('depositos', function (Blueprint $table) {
      $table->bigIncrements('id');
      $table->string('nombre', 50);
      $table->unsignedBigInteger('departamento_id');

      /** Claves referencia a la tabla Departamento */
      $table->foreign('departamento_id')
        ->references('id')->on('departamentos')
        ->onDelete('cascade');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('depositos');
  }
}
