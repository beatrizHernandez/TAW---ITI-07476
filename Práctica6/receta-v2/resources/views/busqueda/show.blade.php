@extends('layouts.app')
<!-- show de las busquedas que se encuentran en el inicio -->
@section('content')
    <div class="container">
        <h2 class="titulo-categoria text-uppercase mt-5 mb-4">
            Resultado de la búsqueda {{ $busqueda }}
        </h2>
        <div class="row">
            @foreach ($recetas as $receta)
                @include('usuario.receta')
            @endforeach
        </div>
        <div class="d-flex justify-content-center mt-5">
            <!-- El método links() muestra los enlaces al resto de las páginas
             y cada uno de estos enlaces contiene la paginate() adecuada -->
            {{ $recetas->links() }}
        </div>
    </div>
@endsection