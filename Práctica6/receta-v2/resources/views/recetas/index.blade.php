@extends('layouts.app')

@section('botones')
	<a href="{{route('recetas.create')}}" class="btn btn-primary mr-2" text-white> Crear receta </a>
	<!-- <a href={{route('perfiles.edit', ['perfil' => Auth::user()])}} class="btn btn-outline-success mr-2">Editar Perfil</a>
    <a href={{route('perfiles.show', ['perfil' => Auth::user()])}} class="btn btn-outline-info mr-2">Ver Perfil</a> -->
@endsection

@section('content')

	<h2 class="text-center mb-5"> Administra tus recetas </h2>
	<div class="col-md-10 mx-auto bg-white p-3">
		<table class="table"> 
			<thead class="bg-primary text-light">
				<tr>
					<th scole="col">Título</th>
					<th scole="col">Categoría</th>
					<th scole="col">Acciones</th>
				</tr>
			</thead>
			<tbody>

				@foreach ($recetas as $receta)
                	<tr>
                    <td>{{$receta->titulo}}</td>
                    <td>{{$receta->categoria->nombre}}</td>

                    <td>
                        <eliminar-receta
                            receta-id={{$receta->id}}> 
                        </eliminar-receta>                        
                        <a href="{{ route('recetas.edit', ['receta' => $receta->id]) }}" class="btn btn-secondary mr-1 d-block mb-2">Editar</a>
                        <a href="{{ route('recetas.show', ['receta' => $receta->id]) }}" class="btn btn-info mr-1 d-block mb-2">Ver</a>

						
                    </td>
                </tr>
                @endforeach 
			</tbody>
		</table>
		
		<div class="col-12 mt-4 justify-content-center d-flex">
            {{ $recetas->links()}}
        </div>  

        <h2 class="text-center my-5">Recetas que te han gustado</h2>
        <div class="col-md-10 mx-auto bg-white p-3">

            @if (count($usuario->meGusta) > 0)
                <ul class="list-group">
                                    
                </ul> 
                @else
                    <p class="text-center">No hay recetas favoritas<br><small>Da "me gusta" a tus recetas favoritas</small></p>
            @endif           
        </div>

	</div>

@endsection
