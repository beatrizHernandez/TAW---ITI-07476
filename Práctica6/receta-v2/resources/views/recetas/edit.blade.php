@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.4/trix.css" integrity="sha512-qjOt5KmyILqcOoRJXb9TguLjMgTLZEgROMxPlf1KuScz0ZMovl0Vp8dnn9bD5dy3CcHW5im+z5gZCKgYek9MPA==" crossorigin="anonymous" />
@endsection

@section('botones')
    <a href="{{route('recetas.index')}}" class="btn btn-primary mr-2" text-white> Volver </a>
@endsection

<!-- Sección de edicion de la informacion de la receta aunque en realidad, no esta funcionando al 100%
tiene lapsos donde funciona correctamente pero de un momento a otro vuelve a mostrar el error -->
@section('content')
	<h2 class="text-center mb-5">Editar receta</h2>

	<div class="row justify-content-center mt-5">
		<div class="col-md-8">
			<form method="POST" action="{{route('recetas.update', ['receta' => $receta->id])}}" enctype="multipart/form-data" novalidate>
				@csrf
                @method('PUT')
                <div class="form-group">
                    <!-- Título de la receta con el que esta registrada en la BD -->
                	<label for="titulo">Titulo de receta</label>
                	<input id="titulo" type="text" name="titulo" placeholder="Titulo Receta" class="form-control @error('titulo') is-invalid @enderror"
                    value="{{ $receta->titulo}}">
                    <!-- En caso de haber error -->
                    @error('titulo')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                    @enderror

                </div>
                <!-- Categoría donde se encuentra almacenada la receta -->
                <div class="form-group">
                	<label for="categoria">Categoría</label>
                	<select id="categoria" name="categoria" class="form-control @error('categoria') is-invalid @enderror" >
                		<option value="">--Seleccione--</option>
                        <!-- For para las diferentes categirías 
                            Por default aparecerá el "seleccione" cuando recién se ingrese -->
                		@foreach ($categorias as $categoria )
                            <option 
                                value="{{ $categoria->id }}" 
                                {{ $receta->categoria_id == $categoria->id ? 'selected' : '' }}
                            >{{$categoria->nombre}}</option>
                        @endforeach

                	</select>
                    <!-- Como el previo, aparecerá error en caso de no seleccionar una categoría -->
                	@error('categoria')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                    @enderror
                </div>
                <!-- Div de preparacion de la receta para editar la información que contiene -->
                <div class="form-group mt-3">
                	<label for="preparacion">Preparación</label>
                	<input type="hidden" name="preparacion" id="preparacion" value="{{$receta->preparacion}}">
                	<trix-editor class="form-control @error('preparacion') is-invalid @enderror" input="preparacion"></trix-editor>
                    <!-- Como el previo, aparecerá error en caso de dejar este espacio en blanco -->
                	@error('preparacion')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                     @enderror

                </div>
                <!-- Div de ingredientes de la receta para editar la información que contiene -->
                <div class="form-group mt-3">
                	<label for="ingredientes">Ingredientes</label>
                	<input type="hidden" id="ingredientes"   name="ingredientes" value="{{$receta->ingredientes}}">
                	<trix-editor class="form-control @error('ingredientes') is-invalid @enderror" input="ingredientes"></trix-editor>
                    <!-- Como el previo, aparecerá error en caso de dejar este espacio en blanco -->
                	@error('ingrendientes')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                    @enderror

                </div>
                <!-- Edición de la imagen de la receta -->
                <div class="form-group mt-3">
                	<label for="imagen">Elige la imagen</label>
                    <input id="imagen" type="file" name="imagen" class="form-group @error('imagen') is-invalid @enderror">
                    <!-- Muestra de la imagen actual -->
                    <div class="mt-4">
                    	<p>Imagen actual: </p>
                        <img src="/storage/{{$receta->imagen}}" style="width: 300px" alt="Imagen">
                    </div>

                    @error('imagen')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                    @enderror

                </div>

                <div class="form-group">
                	<input type="submit" class="btn btn-primary" value="Actualizar receta">
                </div>
            </form>
		</div>
		
	</div>
@endsection

@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.4/trix.js" integrity="sha512-zEL66hBfEMpJUz7lHU3mGoOg12801oJbAfye4mqHxAbI0TTyTePOOb2GFBCsyrKI05UftK2yR5qqfSh+tDRr4Q==" crossorigin="anonymous" defer></script>
@endsection