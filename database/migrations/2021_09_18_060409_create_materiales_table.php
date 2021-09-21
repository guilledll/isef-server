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
            $table->unsignedBigInteger('deposito_id');
            $table->unsignedBigInteger('categoria_id');
            $table->Integer('cantidad');


            /** Clave foranea a la tabla Depósito */
            $table->foreign('deposito_id')
                ->references('id')->on('depositos')
                ->onDelete('cascade');

            /** Clave foranea a la tabla Categoría */
            $table->foreign('categoria_id')
                ->references('id')->on('categorias')
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
        Schema::dropIfExists('materiales');
    }
}
