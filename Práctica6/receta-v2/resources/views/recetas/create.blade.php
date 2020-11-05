@extends('layouts.app')

<!-- Definir la sección de los estilos del editor Trix -->
@section('styles')
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.0/trix.css" integrity="sha512-EQF8N0EBjfC+2N2mlaH4tNWoUXqun/APQIuFmT1B+ThTttH9V1bA0Ors2/UyeQ55/7MK5ZaVviDabKbjcsnzYg==" crossorigin="anonymous" />
@endsection


@section('botones')
	<a href="{{route('recetas.index')}}" class="btn btn-primary mr-2" text-white> Volver </a>
@endsection

@section('content')
	<h2 class="text-center mb-5"> Crear nueva receta </h2>

	<div class="row justify-content-center mt-5">
		<div class="col-md-8">
			<form method="POST" action="{{route('recetas.store')}}" novalidate>
				@csrf
				<!-- {{$categorias}} -->
				<div class="form-group">
					<label for="Titulo de receta"></label>
					<input type="text" 
							name="titulo"
							class="form-control @error('titulo') is-invalid @enderror"
							placeholder="Título de la receta"
							value={{old('titulo')}}>

							<!-- Directiva de Laravel para poner un msj de error -->
							@error('titulo')
								<spam class="invalid-feedback d-block" role="alert">
									<!-- Ponemos un msj generado por Laravel -->
									<strong>{{$message}}</strong>
							@enderror
				</div>
				<!-- Select de categorias -->
				<div class="form-group">
					<label for="categoria">Categorías</label>
					<select 
							name="categoria"
							class="form-control @error('categoria') is-invalid @enderror"
							id="categoria">

							<option value="">--Seleccione--</option>

							@foreach($categorias as $id => $categoria)
								<option value="{{$id}}"
								{{old('categoria')==$id?'selected':''}}
								>{{$categoria}}</option>
							@endforeach
					</select>

					<!-- Validación y mandamos retroalimentación al usuario -->
					@error('categoria')
						<span class="invalid-feedback d-block" role="alert">
							<!-- Ponemos un msj de laravel -->
							<strong>{{$message}}</strong>
						</span>
					@enderror
				</div>
				<!-- Final de select -->


				<!-- Inicio campo de texto con preparación con Trix -->
				<div class="form-group mt-3">
					<label for="preparacion"> Preparación </label>
					<!-- Campo de texto de preparación, se agrega el elemento -->
					<input id="preparacion" type="hidden" name="preparacion" value="{{old('preparacion')}}">
					<!-- Agregamos el editor -->
					<trix-editor 
					class="form-control @error('preparacion') is-invalid @enderror"
					input type="preparacion"></trix-editor>
					<!-- Validación de msj de error -->
					@error('preparacion')
						<span class="invalid-feedback d-block" role="alert">
						<!-- Poner el msj generado por laravel -->
						<strong>{{$message}}</strong>
					@enderror
				</div>
				<!-- Fin de campo de texto de preparación -->


				<!-- Inicio campo de texto con ingredientes con Trix -->
				<div class="form-group mt-3">
					<label for="ingredientes"> Ingredientes </label>
					<!-- Campo de texto de ingredientes, se agrega el elemento -->
					<input id="ingredientes" type="hidden" name="ingredientes" value="{{old('ingredientes')}}">
					<!-- Agregamos el editor -->
					<trix-editor 
					class="form-control @error('ingredientes') is-invalid @enderror"
					input type="ingredientes"></trix-editor>
					<!-- Validación de msj de error -->
					@error('ingredientes')
						<span class="invalid-feedback d-block" role="alert">
						<!-- Poner el msj generado por laravel -->
						<strong>{{$message}}</strong>
					@enderror
				</div>
				<!-- Fin de campo de texto de ingredientes -->


				<!-- Campo para carga de imágenes -->
				<div class="form-group mt-3">
					<label for="imagen"> Elige una imagen... </label>
					<input id="imagen" type="file" class="form-control @error('imagen') is-invalid @enderror" name="imagen">

					<!-- Validar msj de error -->
					@error('imagen')
						<span class="invalid-feedback d-block" role="alert">
						<!-- Poner el msj generado por laravel -->
						<strong>{{$message}}</strong>
					@enderror
				</div>
				<!-- Fin de campo imagen -->


				<!-- Button -->
				<div class="form-group">
					<input type="submit" class="btn btn-primary" value="Agregar receta">
				</div>
			</form>
		</div>
	</div>
@endsection

<!-- Definir la sección de los scripts para el editor de Trix -->
@section('scripts')
	<script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.0/trix.js" integrity="sha512-S9EzTi2CZYAFbOUZVkVVqzeVpq+wG+JBFzG0YlfWAR7O8d+3nC+TTJr1KD3h4uh9aLbfKIJzIyTWZp5N/61k1g==" crossorigin="anonymous"></script>
@endsection

