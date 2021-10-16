<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetalleCentrosMedicosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_centros_medicos', function (Blueprint $table) {
            $table->id('id_detalleCentroMed');
            $table->bigInteger('id_centroMedico');
            $table -> bigInteger('id_especialidad');
            $table->foreign('id_centroMedico')->references('id_centroMedico')->on('centros_medicos');
            $table->foreign('id_especialidad')->references('id_especialidad')->on('especialidades');
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
        Schema::dropIfExists('detalle_centros_medicos');
    }
}
