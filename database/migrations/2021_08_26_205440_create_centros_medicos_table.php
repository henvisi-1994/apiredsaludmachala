<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCentrosMedicosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('centros_medicos', function (Blueprint $table) {
            $table->id('id_centroMedico');
            $table -> string('nombre_centroMedico',25);
            $table -> text('direccion_centroMedico');
            $table -> string('telef_centroMedico',190);
            $table->text('ubic_centroMedico');
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
        Schema::dropIfExists('centros_medicos');
    }
}
