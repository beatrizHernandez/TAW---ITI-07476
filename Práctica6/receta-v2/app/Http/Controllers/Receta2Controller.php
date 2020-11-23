<?php

namespace App\Http\Controllers;

use App\CategoriaReceta;
use App\Receta2;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;
use Auth;

class Receta2Controller extends Controller
{

    //Validar la restricción a todos los métodos de usuario autenticado
    public function _construct() {
        $this->middleware('auth', ['except' => ['show', 'search']]);
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
        if(Auth::check()) {
            $usuario = auth()->user();

            $recetas = Receta2::where('user_id', $usuario->id)->paginate(10);
            //print_r($recetas);

            return view('recetas.index')
                ->with('recetas', $recetas)
                ->with('usuario', $usuario);
        } else {
            return redirect()->action('HomeController@index');
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Creamos una consulta a la BD sobre las categorias de las recetas
        //$categorias=DB::table('categoria_receta')->get()->pluck('nombre', 'id');
        //Esta consulta retorna un array con los elementos de la tabla categoria

        $categorias = CategoriaReceta::all(['id', 'nombre']);

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

        //dd($request['imagen']->store('uploads-recetas', 'public'));
       $data=request()->validate([
            //Reglas de validación
            'titulo'=>'required|min:6',
            'categoria'=>'required',
            'preparacion'=>'required',
            'ingredientes'=>'required',
            'imagen'=>'required|image|',
        ]);

        $ruta_imagen = $request['imagen']->store('uploads-recetas', 'public');

        $img = Image::make( public_path("storage/{$ruta_imagen}"))->fit(1200, 550);

        $img->save();


        //Fascade (librerías de laravel)
        /*DB::table('receta2s')->insert([
           'titulo' => $request['titulo'],
           'preparacion'=>$request['preparacion'],
           'ingredientes'=>$request['ingredientes'],
           'imagen'=>$ruta_imagen, 
           'user_id'=>Auth::user()->id,
           'categoria_id'=>$request['categoria']
        ]); */

        auth()->user()->recetas()->create([
            'titulo'=>$request['titulo'],
            'preparacion'=>$request['preparacion'],
            'ingredientes'=>$request['ingredientes'],
            'imagen'=>$ruta_imagen,
            'categoria_id'=>$request['categoria']
        ]);

        return redirect()->action('Receta2Controller@index');

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
        $this->authorize('view', $receta2);

        $categorias = CategoriaReceta::all('id', 'nombre');

        return view('recetas.edit', compact('categorias', 'receta'));
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
        $this->authorize('update', $receta2);

        $data = $request->validate([
            'titulo'=>'required|min:6',
            'categoria'=>'required',
            'preparacion'=>'required',
            'ingredientes'=>'required'
        ]);

        $receta2->titulo = $request['titulo'];
        $receta2->preparacion = $request['preparacion'];
        $receta2->ingredientes = $request['ingredientes'];
        $receta2->categoria_id = $request['categoria'];

        if(request('imagen')){
            $ruta_image = $request['imagen']->store('upload-recetas', 'public');

            $img = Image::make( public_path("storage/{$ruta_image}"))->fit(1200, 550);

            $img->save();

            $receta->imagen = $ruta_image; 
        }
        $receta2->save();

        return redirect()->action('Receta2Controller@index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Receta2  $receta2
     * @return \Illuminate\Http\Response
     */
    public function destroy(Receta2 $receta)
    {
        //
        $this->authorize('delete', $receta);

        $receta->delete();

        return redirect()->action('Receta2Controller@index'); 
    }
}
