<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicoProduccionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medico_produccions', function (Blueprint $table) {
            $table->id('id_medico_prod');
            $table -> string('nomb_medico',30);
            $table->bigInteger('id_especialidad');
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
        Schema::dropIfExists('medico_produccions');
    }
}
