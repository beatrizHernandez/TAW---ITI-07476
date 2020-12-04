<div class="col-md-4 mt-4">
    <div class="card shadow">
        <img src="/storage/{{$receta->imagen}}" alt="Imagen receta" class="card-img-top">
        <!-- Este archivo esta destinado a mostrar las recetas que el usuario ha ido colocando
            es decir, estan asociadas a su id dentro de la BD -->
        <div class="card-body">
            <h3 class="card-title">{{$receta->titulo}}</h3>

            <div class="meta-receta d-flex justify-content-between">
                @php
                    $fecha = $receta->created_at
                @endphp

                <p class="text-primary fecha font-wight-bold">
                    <fecha-receta fecha="{{$fecha}}"></fecha-receta>
                </p>              
                <!-- A cuantas personas (o cuantos likes) ha tenido esta receta-->        
                <p> A {{count($receta->likes)}} les gustó esta receta </p>               
            </div>
            <p class="card-text">
                {{Str::words(strip_tags( $receta->preparacion ), 20, '...')}}
            </p>
            <!-- Ruta y botón que dirige a la vista de la receta -->
            <a href="{{ route('recetas.show', ['receta' => $receta->id])}}" class="btn btn-primary d-block btn-recetas">Ver receta</a>
        </div>
    </div>
</div>