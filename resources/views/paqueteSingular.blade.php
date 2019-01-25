@extends('layouts.app')
@section('content')


  <!-- Page Content -->
  <div class="container">

    <div class="row">




      <div class="col-lg-9">

        <div class="card mt-4">
          <img class="card-img-top img-fluid" src="http://silverinfra.com/wp-content/uploads/2015/01/hotel.jpg" alt="">
          <div class="card-body">
            <h3 class="card-title">Paquete para {{$paquete->cantidad_personas}} personas </h3>
            <p>
              Aprovecha este paquete con <b>{{$paquete->descuento}}% de Descuento</b>
            </p>
          </div>
        </div>
        <!-- /.card -->

        <div class="card card-outline-secondary my-4">
          <div class="card-header">
            <b style="font-size:30px">Hotel</b>
          </div>
          <div class="card-body">
            <p>
              <b>Nombre: </b>{{$hotel->nombre}}<br/>
              <b>Descripción: </b>{{$hotel->descripcion}}<br/>
              <b>Ciudad: </b>{{$hotel->ciudad()->first()->nombre}}<br/>
              <b>Dirección: </b>{{$hotel->direccion}}<br/>
              <b>Estrellas: </b>
              <span class="text-warning">
                 @for ($i =1; $i <= $hotel->estrellas; $i++)
                  &#9733;
                @endfor
              </span>
            </p><br/>
            <!--a href="#" class="btn btn-success">Ver Hotel</a> -->
          </div>
        </div>
        <div class="card card-outline-secondary my-4">
          <div class="card-header">
            <b style="font-size:30px">Auto</b>
          </div>
          <div class="card-body">
            <p>
              <b>Marca: </b>{{$auto->marca}}<br/>
              <b>Modelo: </b>{{$auto->modelo}}<br/>
              <b>Tipo: </b>{{$auto->tipo}}<br/>
              <b>Capacidad: </b>{{$auto->capacidad}}<br/>

            </p><br/>
            <!--<a href="#" class="btn btn-success">Ver Auto</a>-->
          </div>
        </div>
        <div class="card card-outline-secondary my-4">
          <div class="card-header">
            <b style="font-size:30px">Recorrido</b>
          </div>
          <div class="card-body">
            <p>
              <b>Ciudad de Origen: </b>{{$recorrido->viaje()->first()->ciudad_origen()->first()->nombre}}<br/>
              <b>País de Origen: </b>{{$recorrido->viaje()->first()->ciudad_origen()->first()->nombre_pais}}<br/>
              <b>Ciudad de Destino: </b>{{$recorrido->viaje()->first()->ciudad_destino()->first()->nombre}}<br/>
              <b>País de Destino: </b>{{$recorrido->viaje()->first()->ciudad_destino()->first()->nombre_pais}}<br/>

            </p><br/>
            <!--<a href="#" class="btn btn-success">Recorrido</a>-->
          </div>
        </div>
        <!-- /.card -->

      </div>
      <!-- /.col-lg-9 -->

    </div>

  </div>
  <!-- /.container -->




@endsection
