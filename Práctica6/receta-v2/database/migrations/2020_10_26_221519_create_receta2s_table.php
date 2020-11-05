<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReceta2sTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        //Crear schema de la tabla categorias:
        Schema::create('categoria_receta', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->timestamps();
        });


        Schema::create('receta2s', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->text('ingredientes');
            $table->text('preparacion');
            $table->string('imagen');

            //Agregamos el ID de usuario que viene de la tabla de usuarios e inserta la receta
            $table->foreignId('user_id')->references('id')->on('users')->comment('El usuario que crea la receta');

            //Agregamos el ID de la categoría que viene de la tabla de categoría 
            $table->foreignId('categoria_id')->references('id')->on('categoria_receta')->comment('La categoría de la receta');

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
        Schema::dropIfExists('categoria_receta');
        Schema::dropIfExists('receta2s');
    }
}
