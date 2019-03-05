@extends('layouts.app')
@section('content')

<div class="container">
    <div class="align-content-center">
        <br/><br/>
        <div class="card">
            <div class="card-header">
                Informacion
            </div>
            <div class="card-body">
                <h5 class="card-title">Usuario</h5>
                <p class="card-text">
                    Nombre: {{$request->nombre}}<br/>
                    Apellido: {{$request->apellido}}<br/>
                    Email: {{$request->email}}<br/>
                    Nacionalidad: {{$request->nacionalidad}}<br/>
                    Edad: {{$request->edad}}<br/>
                </p>
            </div>
        </div>
        <br/><br/>
        <div class="card">
            <div class="card-header">
                Informacion
            </div>
            <div class="card-body">
                <h5 class="card-title">Compra</h5>
                <p class="card-text">
                    Precio Vehiculo por {{$days}} días: ${{$reserva->costo}}<br/>
                    Precio Vehiculo por día: ${{$vehiculo->precio}}<br/>
                    Medio de pago:
                    @if ($request->medio == 1)
                        Efectivo
                    @elseif ($request->medio == 2)
                        Tarjeta
                    @else
                        Cheque
                    @endif
                </p>
            </div>
        </div>
        <br/><br/>
        <div class="card">
            <div class="card-header">
                Información
            </div>
            <div class="card-body">
                <h5 class="card-title">Vehiculo</h5>
                <p class="card-text">
                  Automotora: {{$vehiculo->automotora()->first()->nombre}} <br/>
                  Marca: {{$vehiculo->marca}} <br/>
                  Modelo: {{$vehiculo->modelo}} <br/>
                  Tipo: {{$vehiculo->tipo}} <br/>
                  Patente: {{$vehiculo->patente}} <br/>
                  Precio diario: {{$vehiculo->precio}} <br/>
                  Capacidad: {{$vehiculo->capacidad}} <br/>
                </p>
            </div>
        </div>
        <br/><br/>

        <a href="http://192.168.10.10/comprar/vehiculo/{{$vehiculo->id}}/{{$user->id}}/{{$reserva->id}}?fecha_inicio={{$request->fecha_inicio}}&fecha_termino={{$request->fecha_termino}}&medio={{$request->medio}}">
            <button type="button" class="btn btn-primary">Confirmar</button>
        </a>
    </div>

@endsection
