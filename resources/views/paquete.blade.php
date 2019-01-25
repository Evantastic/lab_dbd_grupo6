@extends('layouts.app')
@section('content')
<div class="container">

      <!-- Page Heading -->
      <h1 class="my-4">Paquetes
        <small>Selecciona el mejor paquete para ti</small>
      </h1>

      <div class="row">
        @foreach ($paquetes as $paquete)
        <div class="col-lg-4 col-sm-6 portfolio-item">
          <div class="card h-100">
            <a href="/paquete/{{$paquete->id}}"><img class="card-img-top" src="https://s-ec.bstatic.com/images/hotel/max1024x768/681/68184730.jpg" alt=""></a>
            <div class="card-body">
              <h4 class="card-title">
                <a href="/paquete/{{$paquete->id}}">Paquete para {{$paquete->cantidad_personas}}</a>
              </h4>
              <p class="card-text">Aprovecha esta promoción y obten un {{$paquete->descuento}}% de descuento</p>
            </div>
          </div>
        </div>
        @endforeach

</div>
@endsection
