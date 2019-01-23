@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="center-block">

            <br/>
            <div class="jumbotron jumbotron-fluid">
                <div class="container">
                    <h1 class="display-4">Disfruta de este recorrido ¡Te lo mereces!</h1>
                    <p class="lead">Ahorra en tu compra con Atam</p>
                        <a href="http://192.168.10.10/comprar/{{$recorrido->id}}/" class="btn btn-primary">Comprar</a>
                </div>
            </div>

            <div class="page-header">
                <h1>Informacion del recorrido</h1>
            </div><br/>

            <div class="card">
                <div class="card-header">
                    Desde {{$viaje->ciudad_origen()->first()->nombre_pais}} hasta {{$viaje->ciudad_destino()->first()->nombre_pais}}
                </div>
                <div class="card-body">
                    <h5 class="card-title">Precio: </h5>
                    <p class="card-text">
                        Economico: ${{$recorrido->costo_economico}}.<br/>
                        Bussiness: ${{$recorrido->costo_bussiness}}.
                    </p>
                </div>
            </div>
            <br/>
            <div class="page-header">
                <h1>Lista de vuelos</h1>
            </div><br/>

            @foreach($vuelos as $vuelo)
                <div class="card">
                    <div class="card-header">
                        Desde {{$vuelo->vuelo()->first()->aeropuerto_origen()->first()->ciudad()->first()->nombre}} hasta {{$vuelo->vuelo()->first()->aeropuerto_destino()->first()->ciudad()->first()->nombre}}
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Fecha de salida: {{$vuelo->vuelo()->first()->tiempo_salida}}. Fecha de llegada: {{$vuelo->vuelo()->first()->tiempo_llegada}}</h5>
                        <p class="card-text">
                            Asientos disponibles: {{$vuelo->vuelo()->first()->capacidad_economica}} en economico y {{$vuelo->vuelo()->first()->capacidad_bussiness}} asientos bussiness. <br/>
                            Aeropuerto de origen: {{$vuelo->vuelo()->first()->aeropuerto_origen()->first()->nombre}}. Aeropuerto de destino: {{$vuelo->vuelo()->first()->aeropuerto_destino()->first()->nombre}}. <br/>
                            Pais de origen: {{$vuelo->vuelo()->first()->aeropuerto_origen()->first()->ciudad()->first()->nombre_pais}}. Pais de destino: {{$vuelo->vuelo()->first()->aeropuerto_destino()->first()->ciudad()->first()->nombre_pais}}
                        </p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection