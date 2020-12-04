@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g==" crossorigin="anonymous" />
@endsection

<!-- Sección hero por default dentro de HTML por tanto hero-categorias-->
@section('hero')
    <div class="hero-categorias ">
        <!-- Referencia a método buscar dentro del controlador de la receta  -->
            <form action="{{ route('buscar.show')}}" class="container h-100">
                <div class="row h-100 align-items-center">
                    <div class="col-md-12 texto-buscar text-center">
                        <!-- Frase de recibimiento en la primer pantalla a la que podemos llamar
                            Pantalla de inicio (contiene el buscador de la receta -->
                        <p class="display-4">Recetario con variedad</p>
                        <input type="search" name="buscar" placeholder="Buscar..." class="form-control">
                    </div>
                </div>
            </form>
    </div>
@endsection

<!-- NOTA: owl para el carrusel deslizante de las imagénes, responsivo si se puede (si no, estatico) -->
@section('content')   
    <div class="container nuevas-recetas">
        <h2 class="titulo-categoria text-uppercase mb-4">Recetas recientes</h2>
        <div class="owl-carousel owl-theme">
            @foreach ($nuevas as $nueva)
                <div class="card">
                    <!-- Source o storage donde esta la imagen asociada a la receta -->
                    <img src="/storage/{{$nueva->imagen}}" class="card-img-top" alt="Imagen Receta">
                    <div class="card-body">
                        <h2>{{ Str::upper($nueva->titulo)}}</h2>
                        <!-- strip_tags() sirve para quitar una cadena de etiquetas HTML, etc -->
                        <p> {{ Str::words(strip_tags($nueva->preparacion), 20) }} </p>
                        <!-- Manda al show de la receta seleccionada (en base a su id)-->
                        <a href=" {{ route('recetas.show', ['receta' => $nueva->id])}}" class="btn btn-primary d-block font-weight-bold text-uppercase">Ver receta</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    
@endsection