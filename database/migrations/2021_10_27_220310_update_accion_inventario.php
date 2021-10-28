<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateAccionInventario extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::table('inventarios', function (Blueprint $table) {
      $table->boolean('accion')->default(0)->change();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::table('inventarios', function (Blueprint $table) {
      $table->string('accion', 4)->change();
    });
  }
}
