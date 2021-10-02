<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventariosTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('inventarios', function (Blueprint $table) {
      $table->bigIncrements('id');
      $table->unsignedBigInteger('material_id');
      $table->unsignedInteger('user_ci');
      $table->Integer('cantidad');
      $table->String('accion');
      $table->datetime('fecha');

      /** Clave foranea a la tabla Materiales */
      $table->foreign('material_id')
        ->references('id')->on('materiales');

      /** Clave foranea a la tabla Usuario */
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
    Schema::dropIfExists('inventarios');
  }
}
