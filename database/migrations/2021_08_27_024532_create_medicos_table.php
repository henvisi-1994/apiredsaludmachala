<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medicos', function (Blueprint $table) {
            $table->id('id_medico');
            $table -> string('tipo_medico',30);
            $table->bigInteger('id_detalleCentroMed');
            $table -> string('nombre_medico',30);
            $table->foreign('id_detalleCentroMed')->references('id_detalleCentroMed')->on('detalle_centros_medicos');
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
        Schema::dropIfExists('medicos');
    }
}
