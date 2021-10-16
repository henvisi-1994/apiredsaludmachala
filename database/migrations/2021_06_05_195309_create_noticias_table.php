<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNoticiasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('noticias', function (Blueprint $table) {
            $table->id('id_noticia');
            $table -> string('titulo_noticia',25);
            $table -> text('imagen_noticia',190);
            $table -> text('descripcion_noticia');
            $table->dateTime('fecha_inicio_noticia', $precision = 0);
            $table->dateTime('fecha_fin_noticia', $precision = 0);
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
        Schema::dropIfExists('noticias');
    }
}
