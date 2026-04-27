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
        Schema::create('asignaciones', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_persona');
            $table->unsignedBigInteger('id_mobiliario');
            $table->unsignedBigInteger('id_periferico');
            $table->date('fecha');

            // Establecer relaciones con las tablas correspondientes
            $table->foreign('id_persona')->references('id')->on('personas');

            $table->foreign('id_mobiliario')->references('id')->on('mobiliarios');

            $table->foreign('id_periferico')->references('id')->on('perifericos');

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
        Schema::dropIfExists('asignaciones');
    }
};
