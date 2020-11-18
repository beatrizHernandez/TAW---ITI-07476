@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.4/trix.css" integrity="sha512-qjOt5KmyILqcOoRJXb9TguLjMgTLZEgROMxPlf1KuScz0ZMovl0Vp8dnn9bD5dy3CcHW5im+z5gZCKgYek9MPA==" crossorigin="anonymous" />
@endsection

@section('botones')
    <a href={{route('recetas.index')}} class="btn btn-primary mr-2 text-white">Volver</a>

@endsection

@section('content')
	<h2 class="text-center mb-5">Editar receta</h2>

	<div class="row justify-content-center mt-5">
		<div class="col-md-8">
			<form method="POST" action={{route('recetas.update', ['receta' => $receta->id])}} enctype="multipart/form-data" novalidate>
				@csrf
                @method('PUT')
                <div class="form-group">
                	<label for="titulo">Titulo de receta</label>
                	<input id="titulo" type="text" name="titulo" placeholder="Titulo Receta" class="form-control @error('titulo') is-invalid @enderror"
                    value="{{ $receta->titulo}}">

                    @error('titulo')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                    @enderror

                </div>

                <div class="form-group">
                	<label for="categoria">Categoría</label>
                	<select id="categoria" name="categoria" class="form-control @error('categoria') is-invalid @enderror" >
                		<option value="">--Seleccione--</option>

                		@foreach ($categorias as $categoria )
                            <option 
                                value="{{ $categoria->id }}" 
                                {{ $receta->categoria_id == $categoria->id ? 'selected' : '' }}
                            >{{$categoria->nombre}}</option>
                        @endforeach

                	</select>

                	@error('categoria')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group mt-3">
                	<label for="preparacion">Preparación</label>
                	<input type="hidden" name="preparacion" id="preparacion" value="{{$receta->preparacion}}">
                	<trix-editor class="form-control @error('preparacion') is-invalid @enderror" input="preparacion"></trix-editor>

                	@error('preparacion')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                     @enderror

                </div>

                <div class="form-group mt-3">
                	<label for="ingredientes">Ingredientes</label>
                	<input type="hidden" id="ingredientes"   name="ingredientes" value="{{$receta->ingredientes}}">
                	<trix-editor class="form-control @error('ingredientes') is-invalid @enderror" input="ingredientes"></trix-editor>

                	@error('ingrendientes')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                    @enderror

                </div>

                <div class="form-group mt-3">
                	<label for="imagen">Elige la imagen</label>
                    <input id="imagen" type="file" name="imagen" class="form-group @error('imagen') is-invalid @enderror">

                    <div class="mt-4">
                    	<p>Imagen actual: </p>

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