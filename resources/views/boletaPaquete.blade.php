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
                    Precio total: ${{$costoTotal}}<br/>
                    Precio habitacion por {{$days}} dias: ${{$costoHabitacion}}<br/>
                    Precio Vehiculo por {{$days}} días: ${{$costoVehiculo}}<br/>
                    Precio Recorrido para {{$paquete->cantidad_personas}} personas: ${{$costoRecorrido}}<br/>
                    Bussiness:
                    @if ($request->bussiness == "on")
                        Si
                    @else
                        No
                    @endif<br/>
                    Seguro:
                    @if ($request->seguro == "on")
                        Si
                    @else
                        No
                    @endif<br/>
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
                Informacion
            </div>
            <div class="card-body">
                <h5 class="card-title">Recorrido</h5>
                <p class="card-text">
                    Origen: {{$recorrido->viaje()->first()->ciudad_origen()->first()->nombre_pais}}<br/>
                    Destino: {{$recorrido->viaje()->first()->ciudad_origen()->first()->nombre_pais}}<br/>
                    Economico: ${{$recorrido->costo_economico}}<br/>
                    Bussiness: ${{$recorrido->costo_bussiness}}<br/>
                </p>
            </div>
        </div>
        <br/><br/>
        <div class="card">
            <div class="card-header">
                Informacion
            </div>
            <div class="card-body">
                <h5 class="card-title">Vuelos</h5>
                @foreach($vuelos as $vuelo)
                <p class="card-text">
                    Id de vuelo: {{$vuelo->vuelo()->first()->id}}<br/>
                    Fecha salida: {{$vuelo->vuelo()->first()->tiempo_salida}}<br/>
                    Fecha llegada: {{$vuelo->vuelo()->first()->tiempo_llegada}}<br/>
                    Aeropuerto origen: {{$vuelo->vuelo()->first()->aeropuerto_origen()->first()->nombre}}<br/>
                    Aeropuerto destino: {{$vuelo->vuelo()->first()->aeropuerto_destino()->first()->nombre}}<br/>
                </p>
                @endforeach
            </div>
        </div>
        <br/><br/>
        <div class="card">
            <div class="card-header">
                Vehiculo
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
        <div class="card">
            <div class="card-header">
                Habitación
            </div>
            <div class="card-body">
                <h5 class="card-title">Vehiculo</h5>
                <p class="card-text">
                  Hotel: {{$habitacion->hotel()->first()->nombre}} <br/>
                  Número de habitación: {{$habitacion->numero_habitacion}} <br/>
                  Capacidad: {{$habitacion->capacidad}} <br/>
                  Precio diario: {{$habitacion->precio}} <br/>
                </p>
            </div>
        </div>
        <br/><br/>
        <a href="http://192.168.10.10/comprar/paquete/{{$paquete->id}}/{{$user->id}}/{{$reserva->id}}/{{$vehiculo->id}}/{{$habitacion->id}}/{{$recorrido->id}}?fecha_inicio={{$request->fecha_inicio}}&fecha_termino={{$request->fecha_termino}}&costoRecorrido={{(int)$costoRecorrido}}&costoVehiculo={{(int)$costoVehiculo}}&costoHabitacion={{(int)$costoHabitacion}}&bussiness={{$request->bussiness}}&medio={{$request->medio}}">
            <button type="button" class="btn btn-primary">Confirmar</button>
        </a>
    </div>

@endsection
