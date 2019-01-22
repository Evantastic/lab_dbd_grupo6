@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="center-block">

            <br/>
            <div class="jumbotron jumbotron-fluid">
                <div class="container">
                    <h1 class="display-4">Disfruta de este recorrido ¡Te lo mereces!</h1>
                    <p class="lead">Ahorra en tu compra con Atam</p>
                </div>
            </div>

            @foreach($vuelos as $vuelo)
                <div class="card">
                    <div class="card-header">
                        Desde {{$vuelo->vuelo()->first()->aeropuerto_origen()->first()->ciudad()->first()->nombre}} hasta {{$vuelo->vuelo()->first()->aeropuerto_destino()->first()->ciudad()->first()->nombre}}
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Hora de salida: {{$vuelo->vuelo()->first()->tiempo_salida}}, Hora de llegada: {{$vuelo->vuelo()->first()->tiempo_llegada}}</h5>
                        <p class="card-text">Asientos disponibles: {{$vuelo->vuelo()->first()->capacidad_economica}} en economico y {{$vuelo->vuelo()->first()->capacidad_bussiness}} asientos bussiness</p>
                        <a href="http://192.168.10.10/recorrido/{{$recorrido->id}}" class="btn btn-primary">Seleccionar</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection