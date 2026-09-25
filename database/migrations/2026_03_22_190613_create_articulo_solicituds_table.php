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
        Schema::create('articulo_solicituds', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_solicitud'); // Agregar columna de clave foránea
            $table->unsignedBigInteger('id_articulo'); // Agregar columna de clave foránea

            // Establecer relación con la tabla de solicitudes
            $table->foreign('id_solicitud')->references('id')->on('solicitudes');

            // Establecer relación con la tabla de artículos
            $table->foreign('id_articulo')->references('id')->on('articulos');
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
        Schema::dropIfExists('articulo_solicituds');
    }
};
