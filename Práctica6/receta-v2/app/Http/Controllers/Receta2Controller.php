<?php

namespace App\Http\Controllers;

use App\Receta2;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Receta2Controller extends Controller
{

    //Validar la restricción a todos los métodos de usuario autenticado
    public function _construct() {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        //return Receta2::get();
        return view('recetas.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Creamos una consulta a la BD sobre las categorias de las recetas
        $categorias=DB::table('categoria_receta')->get()->pluck('nombre', 'id');
        //Esta consulta retorna un array con los elementos de la tabla categoria

        //Manda a la vista del formulario
        return view('recetas.create')->with('categorias', $categorias);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //dd($request->all());
        $data=request()->validate([
            //Reglas de validación
            'titulo'=>'required|min:6',
            'categoria'=>'required',
            'preparacion'=>'required',
            'ingredientes'=>'required',
            'imagen'=>'required|image|size:2000',
        ]);

        //Fascade (librerías de laravel)
        DB::table('receta2s')->insert([
           'titulo' => $data['titulo']
        ]);

        echo '<script language="javascript">alert("¡Se ha guardado la receta!");</script>';

        //
        /*$receta = new Receta2();
        $receta->nombre = $request->nombre;

        $receta->save();

       // RecetaController::hola($request->all());
        //Redireccion de la página a el alias en la ruta
        return redirect('recetas');

       // echo 'Hola';*/
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Receta2  $receta2
     * @return \Illuminate\Http\Response
     */
    public function show(Receta2 $receta2)
    {
        //

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Receta2  $receta2
     * @return \Illuminate\Http\Response
     */
    public function edit(Receta2 $receta2)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Receta2  $receta2
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Receta2 $receta2)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Receta2  $receta2
     * @return \Illuminate\Http\Response
     */
    public function destroy(Receta2 $receta2)
    {
        //
    }
}
