@extends('layouts.app')


@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.4/trix.css" integrity="sha512-qjOt5KmyILqcOoRJXb9TguLjMgTLZEgROMxPlf1KuScz0ZMovl0Vp8dnn9bD5dy3CcHW5im+z5gZCKgYek9MPA==" crossorigin="anonymous" />
@endsection

@section('botones')
    <a href="{{route('recetas.index')}}" class="btn btn-primary mr-2 text-white">Volver</a>

@endsection

@section('content')
    <h1 class="text-center">Editar perfil</h1>

    <div class="row justify-content-center mt-5">
        <div class="col-md-10 bg-white p-3">
            <form 
                action="{{ route('perfiles.update', ['perfil' => $perfil->id]) }}" method="POST" enctype="multipart/form-data"
            >
            @csrf
            @method('PUT')
                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" 
                        name="nombre" 
                        class="form-control @error('nombre') is-invalid @enderror"
                        id="nombre" 
                        placeholder="Tu nombre"
                        value="{{ $perfil->usuario->name}}" 
                    >
                    @error('nombre')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                    @enderror
                </div>
    
                <div class="form-group">
                    <label for="nombre">Sitio web</label>
                    <input type="text" 
                        name="url" 
                        class="form-control @error('url') is-invalid @enderror"
                        id="url" 
                        placeholder="Tu url"
                         value="{{ $perfil->usuario->url}}" 
                    >
                    @error('url')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                    @enderror
                </div>
    
                <div class="form-group mt-3">
                    <label for="biografia">Biografía</label>
                    <input 
                        type="hidden" 
                        id="biografia"   
                        name="biografia" 
                        value="{{$perfil->biografia}}"
                    >
                    <trix-editor class="form-control @error('biografia') is-invalid @enderror" input="biografia"></trix-editor>
                    @error('biografia')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                    @enderror
                </div>
    
                <div class="form-group mt-3">
                    <label for="imagen">Elige tu imagen</label>
                    <input 
                        type="file"
                        name="imagen"
                        id="imagen"
                        class="form-group @error('imagen') is-invalid @enderror"
                    >
    
                    @if ( $perfil->imagen)
                                        
                    <div class="mt-4">
                        <p>Imagen Actual:</p>
                        <img src="/storage/{{$perfil->imagen}}" style="width: 300px" alt="Imagen">
                    </div>
                    @error('imagen')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                    @enderror
                    @endif
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Guardar Perfil">
                </div>
            </form>
        </div>
    </div>
@endsection

@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.4/trix.js" integrity="sha512-zEL66hBfEMpJUz7lHU3mGoOg12801oJbAfye4mqHxAbI0TTyTePOOb2GFBCsyrKI05UftK2yR5qqfSh+tDRr4Q==" crossorigin="anonymous" defer></script>
@endsection