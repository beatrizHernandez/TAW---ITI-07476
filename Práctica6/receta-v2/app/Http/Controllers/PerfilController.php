<?php

namespace App\Http\Controllers;

use App\Perfil;
use App\Receta2;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class PerfilController extends Controller
{
    //Filtrado de petición HTTP para la autenticación
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
        //Muestra el perfil en base al id dentro del modelo
        //Paginación o restricción de 10
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
        //edición de los datos del perfil del usuario
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
        //actualización de los datos editados del perfil
        $this->authorize('update', $perfil);
        //Validación de los datos: nombre, url, biografía
        $data = request()->validate([
            //datos requeridos
            'nombre' => 'required',
            'url' => 'required',
            'biografia' => 'required'
        ]);
        //request de imagen para foto de perfil 
        if($request['imagen']){
            $ruta_image = $request['imagen']->store('upload-perfiles', 'public');
            //storage de la imagen
            $img = Image::make( public_path("storage/{$ruta_image}"))->fit(1200, 550);
            $img->save();

            $array_imagen = ['imagen' => $ruta_image];
        } 

        auth()->user()->url = $data['url'];
        auth()->user()->name = $data['nombre'];
        auth()->user()->save();

        unset($data['url']);
        unset($data['nombre']);

        //nota: array_merge se usa para combinar dos o más elementos del array, en este caso los datos anteriores
        //y la imagen
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
        //TODO:eliminación de perfil
        //sin ser necesario en realidad
    }

    //se tomará en cuenta lo del perfil?
    //29/11 -> NO
}
