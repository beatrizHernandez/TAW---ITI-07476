<?php

namespace App\Http\Controllers;

use App\Receta2;
use Illuminate\Http\Request;

class Receta2Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return Receta2::get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $receta = new Receta2();
        $receta->nombre = $request->nombre;

        $receta->save();

       // RecetaController::hola($request->all());
        //Redireccion de la página a el alias en la ruta
        return redirect('recetas');

       // echo 'Hola';
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
