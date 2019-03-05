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
                    Precio habitación por {{$days}} días: ${{$reserva->costo}}<br/>
                    Precio habitación por día: ${{$habitacion->precio}}<br/>
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
                <h5 class="card-title">Habitación</h5>
                <p class="card-text">
                  Hotel: {{$habitacion->hotel()->first()->nombre}} <br/>
                  Número de habitación: {{$habitacion->numero_habitacion}} <br/>
                  Capacidad: {{$habitacion->capacidad}} <br/>
                  Precio diario: {{$habitacion->precio}} <br/>
                </p>
            </div>
        </div>
        <br/><br/>

        <a href="http://192.168.10.10/comprar/habitacion/{{$habitacion->id}}/{{$user->id}}/{{$reserva->id}}?fecha_inicio={{$request->fecha_inicio}}&fecha_termino={{$request->fecha_termino}}&medio={{$request->medio}}">
            <button type="button" class="btn btn-primary">Confirmar</button>
        </a>
    </div>

@endsection
