<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('perifericos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_tipo'); // Agregar columna de clave foránea
            $table->unsignedBigInteger('id_marca'); // Agregar columna de clave foránea
            $table->unsignedBigInteger('id_modelo'); // Agregar columna de clave foránea
            $table->string('serial');

            // Establecer relación con la tabla de marca
            $table->foreign('id_marca')->references('id')->on('marcas');
            // Establecer relación con la tabla de modelo
            $table->foreign('id_modelo')->references('id')->on('modelos');
            // Establecer relación con la tabla de tipo de periféricos
            $table->foreign('id_tipo')->references('id')->on('tipo_perifericos');

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('perifericos');
    }
};
