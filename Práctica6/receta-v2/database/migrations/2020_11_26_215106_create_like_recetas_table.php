<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLikeRecetasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //migración de la tabla de likes con los campos que piden ser llenados
        Schema::create('like_recetas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->references('id')->on('users'); 
            //constrained() utiliza una convención para determinar la tabla y el nombre
            //de la columna a la que se hace referencia
            $table->foreignId('receta2_id')->constrained();
            //$table->foreignId('receta_id')->references('id')->on('receta2s');
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
        Schema::dropIfExists('like_recetas');
    }
}
