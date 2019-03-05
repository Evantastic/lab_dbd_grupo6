@extends('layouts.app')
@section('content')

<div class="container">
      <!-- Page Heading -->
  	<h1 class="my-4">habitaciones 
    	<small>Selecciona el habitacion que mas se acomode a tu viaje</small>
  	</h1>

  	<div class="row">

	@foreach($habitaciones as $habitacion)
	<div class="col-lg-4 col-sm-6 portfolio-item">
          <div class="card h-100">
            <a href="/habitacion/{{$habitacion->id}}"><img class="card-img-top" src="https://s-ec.bstatic.com/images/hotel/max1024x768/681/68184730.jpg" alt=""></a>
            <div class="card-body">
              <h4 class="card-title">
                <a href="/habitacion/{{$habitacion->id}}">Habitacion para {{$habitacion->capacidad}} personas</a>
              </h4>
             
            </div>
          </div>
        </div>	

	@endforeach
</div>

@endsection
