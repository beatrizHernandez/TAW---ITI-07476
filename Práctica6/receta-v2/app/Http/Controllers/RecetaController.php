<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Receta2;


class RecetaController extends Controller
{
    //
    public function hola() {

    	//Consulta no.1, envío del array 'recetas' a la vista
    	$recetas = ['Receta de fresa', 'Receta de uva', 'Receta de limon'];

    	//Consulta no.2, envío del array 'categorias' a la vista
    	$categorias = ['Comida mexicana', 'Comida argentina', 'Postres'];

       //$recetasbd = Receta2::get();

    	//Pasar a la vista el array (sintaxis 1):
    	//Retornar a la vista recetas/index
    	return view('recetas.index') 
    			-> with('recetas', $recetas)
    			-> with('categorias', $categorias);
               // -> with('recetasbd', $recetasbd);

    	//Pasar a la vista el array (sintaxis 2):
    	//return view('recetas.index', compact('recetas', 'categorias'));
    }
}
