<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

//Modelo de las recetas
class Receta2 extends Model
{
    //datos que deben ser llenados de la receta
    protected $fillable = ['titulo', 'preparacion', 'ingredientes', 'imagen', 'categoria_id'];

    public function categoria() {
        //A que categoría pertence la receta
    	return $this-> belongsTo(CategoriaReceta::class);
    }

    public function autor() {
        //a que usuario pertenece la receta
    	return $this->belongsTo(User::class, 'user_id');
    }

    public function likes() {
        //cuantos usuarios le han dado like a esta receta
    	return $this->belongsToMany(User::class, 'like_recetas');
    }
}
