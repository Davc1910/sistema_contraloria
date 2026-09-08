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
        Schema::create('equipos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('articulo_id');
            $table->string('codigo_equipo');
            $table->string('cpu');
            $table->string('ram');
            $table->string('disco_duro');
            $table->string('sistema_operativo');
            $table->string('serial');
            $table->unsignedBigInteger('id_periferico');
            $table->text('descripcion_equipo');

            $table->timestamps();

            // Relación de integridad referencial con borrado en cascada
            $table->foreign('articulo_id')->references('id')->on('articulos');

            $table->foreign('id_periferico')->references('id')->on('perifericos');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('equipos');
    }
};
