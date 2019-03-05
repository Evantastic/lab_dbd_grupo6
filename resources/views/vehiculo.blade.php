@extends('layouts.app')
@section('content')
  <!-- Page Content -->
  <div class="container">

    <div class="row">




      <div class="col-lg-9">

        <div class="card mt-4">
          <img class="card-img-top img-fluid" src="http://silverinfra.com/wp-content/uploads/2015/01/hotel.jpg" alt="">
            <div class="card-body">
          	
	          <div class="card-body">
	          	<b style="font-size:30px">Vehiculo</b>
	            <p>
	              <b>Marca: </b>{{$vehiculos->marca}}<br/>
	              <b>Modelo: </b>{{$vehiculos->modelo}}<br/>
	              <b>Tipo: </b>{{$vehiculos->tipo}}<br/>
	              <b>Capacidad: </b>{{$vehiculos->capacidad}}<br/>

	            </p><br/>
	            <a href="/comprar/paquete/{{$vehiculos->id}}"><button   type="submit" class="btn btn-primary">Comprar</button></a>

	            </p>

	          </div>
        	</div>


      	</div>
      <!-- /.col-lg-9 -->

    </div>

  </div>
  <!-- /.container -->


@endsection
