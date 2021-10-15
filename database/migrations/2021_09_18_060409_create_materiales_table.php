<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaterialesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('materiales', function (Blueprint $table) {
      $table->bigIncrements('id');
      $table->string('nombre', 50);
      $table->foreignId('deposito_id')->constrained();
      $table->foreignId('categoria_id')->constrained();
      $table->integer('cantidad');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('materiales');
  }
}
