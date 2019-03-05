@extends('layouts.app')
@section('content')
<div class="container">
      <!-- Page Heading -->
  	<h1 class="my-4">Vehiculos 
    	<small>Selecciona el vehiculo que mas se acomode a tu viaje</small>
  	</h1>

  	<div class="row">

	@foreach($vehiculos as $vehiculo)
	<div class="col-lg-4 col-sm-6 portfolio-item">
          <div class="card h-100">
            <a href="/vehiculo/{{$vehiculo->id}}"><img class="card-img-top" src="http://lagosandinos.cl/wp-content/uploads/2017/09/rentacar.png" alt=""></a>
            <div class="card-body">
              <h4 class="card-title">
                <a href="/vehiculo/{{$vehiculo->id}}">Vehiculo para {{$vehiculo->capacidad}} personas</a>
              </h4>
             
            </div>
          </div>
        </div>	

	@endforeach
</div>
@endsection
