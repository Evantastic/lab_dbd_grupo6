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
                        Vehiculo: {{$vehiculo->id}}<br/>
                    </p>
                </div>
            </div>

            <br/><br/>
            <a href="http://192.168.10.10/">
                <button type="button" class="btn btn-primary">Volver a la pagina principal</button>
            </a>
        </div>
    </div>
@endsection
