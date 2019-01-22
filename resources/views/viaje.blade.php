@extends('layouts.app')

@section('content')
<div class="container">
  <div class="center-block">
    @foreach($recorridos as $recorrido)
    <div class="card">
      <div class="card-header">
        {{$viaje->ciudad_destino()->first()->nombre}}
      </div>
      <div class="card-body">
        <h5 class="card-title">Desde ${{$recorrido->costo_economico}} hasta ${{$recorrido->costo_bussiness}}</h5>
        <p class="card-text">Origen: {{$viaje->ciudad_origen()->first()->nombre}}</p>
        <a href="#" class="btn btn-primary">Comprar</a>
      </div>
    </div>
    @endforeach
  </div>
</div>

@endsection
