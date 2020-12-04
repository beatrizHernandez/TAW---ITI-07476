<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Definir el yield de estilos para la integración del editor Trix -->
    @yield('styles')
    
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-primary shadow-sm barra">
            <div class="container">
                <a class=" navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Lado izquierdo del menú de navegación -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Lado derecho del menú de navegación -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <!-- Dropdowns de bootstrap, tanto como aria-haspopup como aria-labelledby
                                    propio de las opciones del perfil loggeado en el momento-->
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>


                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Sidebar de categorías estaticas -> las categorías no salieron commo se esperaban
            Función del botón solo despliega-->
        <div class="wrapper">
            <nav id="sidebar">
                <div class="container">

                    <div class="sidebar-header">
                       <button class="btn btn-primary mr-2" type="button" data-toggle="collapse" data-target="#categorias" aria-controls="categorias" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                            <!-- Botón que despliega lista-->
                            Categorías
                        </button>
                    </div>

                    <!-- Mostrar el nombre de las categorías -->
                    <div class="collapse navbar-collapse " id="categorias">
                        <!-- Left Side Of Navbar -->
                        <ul class="navbar-nav w-100 d-flex justify-content-between">
                            @foreach ($categorias as $categoria)
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('categorias.show', ['categoria' => $categoria->id ]) }}">
                                   {{ $categoria->nombre }}
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </nav>

            @yield('hero')
        
            <!-- Contenedor de secciones (creadas en clase) de botones y contenido en general -->
            <div class="container">
                <div class="row">
                    <div class="py-4 mt-5 col-12">
                        @yield('botones')
                    </div>
                    <main class="py-3 col-12">
                        @yield('content')
                    </main>
                </div>
            </div>
        </div>
        
    </div>

    <!-- Definir el yield de los script JS para la integración del editor Trix -->
    @yield('scripts')
</body>
</html>
