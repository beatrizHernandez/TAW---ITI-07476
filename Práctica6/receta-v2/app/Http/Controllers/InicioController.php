<?php

namespace App\Http\Controllers;

use App\Receta2;
use App\CategoriaReceta;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class InicioController extends Controller
{
    //
    public function index()
    {        
       
        //$votadas = Receta2::withCount('likes')->orderBy('likes_count', 'desc')->take(3)->get();
        //Nuevas recetas dentro del modelo (al menos 3)
        $nuevas = Receta2::latest()->take(3)->get();
        //Todas las recetas
        $categorias = CategoriaReceta::all();

        $recetas = [];

        foreach($categorias as $categoria) {
            $recetas[ Str::slug($categoria->nombre) ][] = Receta2::where('categoria_id', $categoria->id)->take(3)->get();
        }
        return view('inicio.index', compact('nuevas', 'recetas','votadas'));
    }
}
