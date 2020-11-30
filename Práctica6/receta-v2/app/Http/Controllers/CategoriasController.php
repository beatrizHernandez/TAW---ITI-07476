<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Receta2;
use App\CategoriaReceta;

//Controlador de Categorías de la receta
class CategoriasController extends Controller
{
    //Función que muestra las categorías existentes
    public function show(Categoria $categoria) {
    	//Mostrar las categorías que se encuentran en el modelo dependiendo del id
    	//paginate() se usa para restricciones o paginación de resultados dependiendo del valor dentro de los ()
    	$recetas = Receta2::where('categoria_id', $categoria->id)->paginate(10);
    	//Retorna la vista "show" 
    	return view('categorias.show', compact('recetas', 'categoria'));
    }
}
