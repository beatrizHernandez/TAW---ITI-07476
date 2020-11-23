<?php

namespace App\Http\Controllers;

use App\Perfil;
use App\Receta2;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class PerfilController extends Controller
{

    public function _construct() {
        $this->middleware('auth', ['except', 'show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Display the specified resource.
     *
     * @param  \App\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function show(Perfil $perfil)
    {
        //
        $recetas = Receta2::where('user_id', $perfil->user_id)->paginate(10);

        return view('perfiles.show', compact('perfil', 'recetas'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function edit(Perfil $perfil)
    {
        //
        $this->authorize('view', $perfil);
        return view('perfiles.edit', compact('perfil'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Perfil $perfil)
    {
        //
        $this->authorize('update', $perfil);

        $data = request()->validate([
            'nombre' => 'required',
            'url' => 'required',
            'biografia' => 'required'
        ]);

        if($request['imagen']){
            $ruta_image = $request['imagen']->store('upload-perfiles', 'public');

            $img = Image::make( public_path("storage/{$ruta_image}"))->fit(1200, 550);
            $img->save();

            $array_imagen = ['imagen' => $ruta_image];
        } 

        auth()->user()->url = $data['url'];
        auth()->user()->name = $data['nombre'];
        auth()->user()->save();

        unset($data['url']);
        unset($data['nombre']);

        auth()->user()->perfil()->update(array_merge($data, $array_imagen ?? []));

        return redirect()->action('Receta2Controller@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function destroy(Perfil $perfil)
    {
        //
    }
}
