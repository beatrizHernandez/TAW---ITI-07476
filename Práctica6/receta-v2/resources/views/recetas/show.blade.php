@extends('layouts.app')

<!-- Botón de volver al dar clikc al botón de "ver" en cualquier receta, este permite volver 
a su vista anterior del listado general -->
@section('botones')
    <a href="{{route('recetas.index')}}" class="btn btn-primary mr-2" text-white> Volver </a>
@endsection

@section('content')
	<div class="contenido-receta bg-white">
        <!-- Título de la receta que el usuario le haya dado-->
		<h1 class="text-center text-white bg-dark mb-4">{{$receta->titulo}}</h1>

        <!-- Imagen asociada con la receta creada por el usuario -->
        <div class="imagen-receta left">
            
            <img src="/storage/{{$receta->imagen}}" alt="imagen" class="w-50">
        </div>

		<div class="receta-meta right">
			<p>
                <!-- Categoría a la que pertenece -->
				<span class="font-weight-bold text-dark">Categoría:</span>
				<a class="text-dark" href="{{ route('categorias.show', ['categoria' => $receta->categoria->id])}}">{{$receta->categoria->nombre}}</a>                    
            </p>

            <p>
                <!-- Usuario autor de la receta
                    en realidad, terminó siendo no tan relevante debido a que no hay funcionalidad de los perfiles
                    dentro del proyecto... -->
        	   <span class="font-weight-bold text-dark">Escrita por:</span>
        	   <a class="text-dark" href="{{ route('perfiles.show', ['perfil' => $receta->autor->id])}}">{{$receta->autor->name}}</a>
            </p> 

            <!-- Ingredientes usados, especificados por el usuario -->
            <div class="ingredientes">
            	<span class="font-weight-bold text-dark">Ingredientes: </span>
            	{!! $receta->ingredientes !!}
            </div>

            <!-- Preparación de la receta, también especificada por el usuario que la creó -->
            <div class="preparacion">
            	<span class="font-weight-bold text-dark">Preparación: </span>
            	{!! $receta->preparacion !!}
            </div>

            <!-- Botón de like de la receta (se añade a los favoritos del usuario)
                Modalidad descubierta ya con herramienta integrada, es decir, no tuvo que ser creada desde cero -->
            <div class="justify-content-center text-center">
                <like-button receta-id="{{$receta->id}}" like="{{$like}}" likes="{{$likes}}"></like-button>
            </div>
        </div>
	</div>
@endsection