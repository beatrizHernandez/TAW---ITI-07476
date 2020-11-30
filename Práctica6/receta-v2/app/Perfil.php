<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Perfil extends Model
{
    //
    public function usuario()
    {
    	//Modelo del perfil del usuario
        return $this->belongsTo(User::class, 'user_id');
        //belongsTo hace referencia al manejo de relaciones de eloquent
    }
}
