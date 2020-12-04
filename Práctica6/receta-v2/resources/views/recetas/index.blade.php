@extends('layouts.app')

<!-- Botón para crear una nueva receta, lleva directamente al método de crear dentro del controlador de la receta -->
@section('botones')
	<a href="{{route('recetas.create')}}" class="btn btn-primary mr-2" text-white> Crear receta </a>
	
@endsection

@section('content')

    <!-- Esquema de div realizado por profesor dentro de la clase con los compartimientos necesarios
        para las funcionalidades necesarias -->
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

                <!-- For para cada fila que se encuentre regsitrada (es decir, receta existente) 
                    muestra su nombre y a que categoría pertenece esta misma, siguiendo el esquema previamente establecido-->
				@foreach ($recetas as $receta)
                	<tr>
                    <td>{{$receta->titulo}}</td>
                    <td>{{$receta->categoria->nombre}}</td>

                    <!-- Botones propios de eliminar, editar y ver
                        ... problemas con la funcionalidad de editar la información de la receta -->
                    <td>
                        <eliminar-receta
                            receta-id={{$receta->id}}> 
                        </eliminar-receta>                        
                        <a href="{{ route('recetas.edit', ['receta' => $receta->id]) }}" class="btn btn-secondary">Editar</a>
                        <a href="{{ route('recetas.show', ['receta' => $receta->id]) }}" class="btn btn-info ">Ver</a>
						
                    </td>
                </tr>
                @endforeach 
			</tbody>
		</table>
		
		<div class="col-12 mt-4 justify-content-center d-flex">
            {{ $recetas->links()}}
        </div>  

        <!-- Muestra de recetas a las que el usuario le ha dado like o favoritos -->
        <h2 class="text-center my-5">Recetas que te han gustado</h2>
        <div class="col-md-10 mx-auto bg-white p-3">

            @if (count($usuario->meGusta) > 0)
                <ul class="list-group">
                     @foreach ($usuario->meGusta as $receta)
                    <li class="list-group-item d-flex justify-content-between alignt-items-center">
                        <p>{{$receta->titulo}}</p>
                        <a class="btn btn outline-success text-uppercase" href="{{ route('recetas.show', ['receta' => $receta->id])}}">Ver</a>
                    </li>
                    @endforeach  
                <!-- En caso de no haber mninguna marcada como favorita -->
                </ul> 
                @else
                    <p class="text-center">No hay recetas favoritas<br><small>Da "me gusta" a tus recetas favoritas</small></p>
            @endif           
        </div>

	</div>

@endsection
