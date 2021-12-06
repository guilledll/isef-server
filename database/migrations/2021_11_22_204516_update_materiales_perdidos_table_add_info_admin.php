<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateMaterialesPerdidosTableAddInfoAdmin extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::table('materiales_perdidos', function (Blueprint $table) {
      $table->unsignedInteger('admin_ci')->nullable()->index();
      $table->string('nota_admin', 500)->nullable();
      $table->renameColumn('nota', 'nota_guardia');
      $table->unsignedInteger('deposito_id')->constrained();
      $table->boolean('accion_tomada')->default(false);

      $table->foreign('admin_ci')
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
    Schema::table('materiales_perdidos', function (Blueprint $table) {
      $table->dropColumn('nota_guardia');
      $table->dropColumn('admin_ci');
      $table->dropColumn('nota_admin');
      $table->dropColumn('accion_tomada');
      $table->dropColumn('deposito_id');
    });
  }
}
