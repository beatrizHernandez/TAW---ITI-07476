<?php

namespace App\Http\Controllers;

use App\Receta2;
use Illuminate\Http\Request;

//Controlador de likes de las recetas (favoritas del usuario)
class LikesController extends Controller
{

    public function __construct()
    {
    	 //Filtrado de petición HTTP para la autenticación
        $this->middleware('auth');
    }
    //Función update (actualizaciones) de las preferencias en recetas del usuario
    public function update(Request $request, Receta2 $receta)
    {
    	//toggle aplica cuando la relación de modelos es de muchos a muchos
        return auth()->user()->meGusta()->toggle($receta);
    }
}
