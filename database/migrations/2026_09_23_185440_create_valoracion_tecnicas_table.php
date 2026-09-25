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
        Schema::create('valoracion_tecnicas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_tipo_solicitud');
            $table->string('desincorporar');
            $table->text('descripcion');
            $table->date('fecha');

            // // Establecer relaciones con las tablas correspondientes
            $table->foreign('id_tipo_solicitud')->references('id')->on('tipo_solicitudes');
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
        Schema::dropIfExists('valoracion_tecnicas');
    }
};
