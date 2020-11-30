@extends('layouts.app')
<!-- show de las categorías que se encuentran -->
@section('content')
    <div class="container">
        <h2 class="titulo-categoria text-uppercase mt-5 mb-4">
            <!-- Modelo por nombre o título de la receta -->
            CategoriaReceta: {{$categoria->nombre}}
        </h2>
        <div class="row">
            @foreach ($recetas as $receta)
                @include('usuario.receta')
            @endforeach
        </div> 
        <div class="d-flex justify-content-center mt-5">
            {{ $recetas->links() }}
        </div>
    </div>
@endsection