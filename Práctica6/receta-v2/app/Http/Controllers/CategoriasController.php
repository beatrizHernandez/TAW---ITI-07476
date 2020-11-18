<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Receta2;
use App\CategoriaReceta;

class CategoriasController extends Controller
{
    //
    public function show(Categoria $categoria) {
    	$recetas = Receta2::where('categoria_id', $categoria->id)->paginate(10);

    	return view('categorias.show', compact('recetas', 'categoria'));
    }
}
