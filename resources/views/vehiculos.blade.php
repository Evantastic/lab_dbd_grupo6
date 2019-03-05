@extends('layouts.app')
@section('content')
<div class="container">
      <!-- Page Heading -->

        <form action="/vehiculo/buscar" method="get">
            <div class="form-group row">
                <label for="nombreInput" class="col-2 col-form-label">Ciudad</label>
                <div class="col-10">
                    <input class="form-control" type="text" value="" id="nombreInput" name="nombre_ciudad">
                </div>
            </div>
            <div class="form-group row">
                <label for="apellidoInput" class="col-2 col-form-label">Fecha Inicio</label>
                <div class="col-10">
                    <input class="form-control" type="text" value="" id="apellidoInput" name="fecha_inicio">
                    <small id="medioHelp" class="form-text text-muted">AAAA-MM-DD</small>
                </div>
                
            </div>
            <div class="form-group row">
                <label for="nacionalidadInput" class="col-2 col-form-label">Fecha Termino</label>
                <div class="col-10">
                    <input class="form-control" type="text" value="" id="nacionalidadInput" name="fecha_termino">
                    <small id="medioHelp" class="form-text text-muted">AAAA-MM-DD</small>
                </div>
                
            </div>
            
            <br/>
            <button type="submit" class="btn btn-primary">Buscar</button>
        </form>
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
