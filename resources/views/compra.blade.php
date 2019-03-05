@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="align-content-center">

            <br/>
            <div class="jumbotron jumbotron-fluid">
                <div class="container">
                    <h1 class="display-4">Compra realizada</h1>
                    <p class="lead">
                        Id de Compra: {{$compra->id}}<br/>
                        Compra asociada a: {{$user->email}}<br/>
                        Recorrido: {{$recorrido->id}}
                    </p>
                </div>
            </div>

            <br/><br/>
            <div class="card">
                <div class="card-header">
                    Informacion pasajes
                </div>
                @foreach($pasajes as $pasaje)
                <div class="card-body">
                    <h5 class="card-title">Id pasaje: {{$pasaje->id}}</h5>
                    <p class="card-text">
                        Id de vuelo: {{$pasaje->vuelo_id}}<br/>
                        Bussiness: {{$pasaje->asiento_bussiness ? "on" : "off"}}
                    </p>
                </div>
                @endforeach
            </div>
            <br/><br/>
            <a href="http://192.168.10.10/">
                <button type="button" class="btn btn-primary">Volver a la pagina principal</button>
            </a>
        </div>
    </div>
@endsection