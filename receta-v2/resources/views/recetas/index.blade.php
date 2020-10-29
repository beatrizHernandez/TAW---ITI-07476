@extends('layouts.app')

@section('content')

	<h1> Recetas </h1>

	@foreach ($recetas as $receta)
		<li>{{$receta}}</li>
	@endforeach

	<h1> Categorías </h1>

	@foreach ($categorias as $categoria)
		<li>{{$categoria}}</li>
	@endforeach

	<form action="{{route('add')}}" method="post">
		@csrf
        <input type="text" name="nombre">
        <button type="submit">Guardar</button>
    </form>

    <h1> Recetas en BD </h1>
    @foreach ($recetasbd as $recetabd)
		<li>ID: {{$recetabd->id}} <br> Nombre: {{$recetabd->nombre}} <br> Created_at: {{$recetabd->created_at}} <br> Updated_at: {{$recetabd->updated_at}} </li>
	@endforeach

@endsection

