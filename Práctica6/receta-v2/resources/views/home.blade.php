@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <!-- Botón para en caso de entrar directo a home, se diriga, con su funcionalidad 
            a el total de recetas registradas-->
        <div class="col-md-8">
            <a href="{{route('recetas.index')}}" class="btn btn-primary mr-2" text-white> {{ 'Ver recetas'}} </a>
        </div>

        <!-- Dashboard por defecto con la plantilla, solo el cambio hecho en clase-->
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in! - Bienvenidos UPV') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
