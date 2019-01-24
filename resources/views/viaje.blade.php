@extends('layouts.app')

@section('content')
<div class="container">
  <div class="center-block">

    <br/>
    <div class="jumbotron jumbotron-fluid">
      <div class="container">
        <h1 class="display-4">Disfruta de este gran viaje a {{$viaje->ciudad_destino()->first()->nombre}}</h1>
        <p class="lead">Disfruta el paisaje!</p>
      </div>
    </div>

    @foreach($recorridos as $recorrido)
    <div class="card">
      <div class="card-header">
        {{$viaje->ciudad_destino()->first()->nombre}}
      </div>
      <div class="card-body">
        <h5 class="card-title">Desde ${{$recorrido->costo_economico}} hasta ${{$recorrido->costo_bussiness}}</h5>
        <p class="card-text">Origen: {{$viaje->ciudad_origen()->first()->nombre}}</p>
        <a href="http://192.168.10.10/recorrido/{{$recorrido->id}}" class="btn btn-primary">Seleccionar</a>
      </div>
    </div>
    @endforeach
  </div>
</div>

@endsection
