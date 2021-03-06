<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/', 'InicioController@index')->name('inicio.index');

//Ruta para mostrar un controlador que retorna un string
//Como se hacía en versión laravel 6 y 7
//route::get('/', 'RecetaController@hola');

//Como se hacía en versión laravel 8
//route::get('/hola', 'RecetaController@hola');

//Ruta para consumir un controlador llamado recetas
//route::get('/recetas', 'RecetaController@hola')->name('recetas');

//route::post('/recetas/add', 'Receta2Controller@store')->name('add');

route::get('/recetas', 'Receta2Controller@index')->name('recetas.index');

route::get('/recetas/create', 'Receta2Controller@create')->name('recetas.create');

route::post('/recetas', 'Receta2Controller@store')->name('recetas.store');

route::get('/recetas/{receta}', 'Receta2Controller@show')->name('recetas.show');

route::get('/recetas/{receta}/edit', 'Receta2Controller@edit')->name('recetas.edit');

route::put('/recetas/{receta}', 'Receta2Controller@update')->name('recetas.update');

route::delete('/recetas/{receta}', 'Receta2Controller@destroy')->name('recetas.destroy');

route::get('/categorias/{categoria}', 'CategoriaController@show')->name('categorias.show');

route::post('/recetas/{receta}', 'LikesController@update')->name('likes.update');

Route::get('/perfiles/{perfil}', 'PerfilController@show')->name('perfiles.show');

Route::get('/perfiles/{perfil}/edit', 'PerfilController@edit')->name('perfiles.edit');

Route::put('/perfiles/{perfil}', 'PerfilController@update')->name('perfiles.update'); 

Route::get('/buscar', 'Receta2Controller@search')->name('buscar.show');
