<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHorariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('horarios', function (Blueprint $table) {
            $table->id('id_horario');
            $table -> date('fecha');
            $table->bigInteger('id_hora');
            $table->bigInteger('id_medico');
            $table->foreign('id_hora')->references('id_hora')->on('horas');
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
        Schema::dropIfExists('horarios');
    }
}
