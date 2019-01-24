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
                        Precio total: ${{$costo}}<br/>

                        Precio unitario:
                        @if ($request->bussiness == "on")
                            ${{$recorrido->costo_bussiness}}
                        @else
                            ${{$recorrido->costo_economico}}
                        @endif<br/>

                        Cantidad: {{$request->cantidad}}<br/>

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
            <a href="http://192.168.10.10/comprar/{{$recorrido->id}}/confirmar/{{$user->id}}/{{$reserva->id}}?bussiness={{$request->bussiness}}&cantidad={{$request->cantidad}}&medio={{$request->medio}}">
                <button type="button" class="btn btn-primary">Confirmar</button>
            </a>
        </div>
    </div>
