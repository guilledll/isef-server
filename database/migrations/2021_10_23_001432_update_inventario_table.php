<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateInventarioTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::table('inventarios', function (Blueprint $table) {
      $table->unsignedBigInteger('deposito_id');
      $table->foreign('deposito_id')
        ->references('id')->on('depositos');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropColumns('inventarios', ['deposito_id']);
  }
}
