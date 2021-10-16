<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCitasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('citas', function (Blueprint $table) {
            $table->id('id_cita');
            $table -> bigInteger('id_especialidad');
            $table->bigInteger('id_horario');
            $table->bigInteger('id_medico');
            $table->foreign('id_especialidad')->references('id_especialidad')->on('especialidades');
            $table->foreign('id_horario')->references('id_horario')->on('horarios');
            $table->foreign('id_medico')->references('id_medico')->on('medicos');
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
        Schema::dropIfExists('citas');
    }
}
