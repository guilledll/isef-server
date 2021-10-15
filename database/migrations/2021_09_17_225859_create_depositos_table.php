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
      $table->foreignId('departamento_id')->constrained();
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
