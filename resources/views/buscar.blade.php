@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="center-block">
            <br/>
            <div class="jumbotron jumbotron-fluid">
                <div class="container">
                    <h1 class="display-4">Disfruta de nuestros viajes</h1>
                    <p class="lead">¡Dinos de donde vienes y hacia donde vas!</p>
                </div>
            </div>
        <form action="/vuelo/buscar" method="get">
            <div class="form-group row">
                <label for="nombreInput" class="col-2 col-form-label">Ciudad de Origen</label>
                <div class="col-10">
                    <input class="form-control" type="text" value="" id="nombreInput" name="nombre_ciudad_origen">
                </div>
            </div>
            <div class="form-group row">
                <label for="nombreInput" class="col-2 col-form-label">Ciudad de Destino</label>
                <div class="col-10">
                    <input class="form-control" type="text" value="" id="nombreInput" name="nombre_ciudad_destino">
                </div>
            </div>
            <div class="form-group row">
                <label for="apellidoInput" class="col-2 col-form-label">Fecha Inicio</label>
                <div class="col-10">
                    <input class="form-control" type="text" value="" id="apellidoInput" name="fecha_inicio">
                    <small id="medioHelp" class="form-text text-muted">AAAA-MM-DD</small>
                </div>
                
            </div>
            <div class="form-group row">
                <label for="nacionalidadInput" class="col-2 col-form-label">Cantidad</label>
                <div class="col-10">
                    <input class="form-control" type="text" value="" id="nacionalidadInput" name="cantidad">
                    
                </div>
                
            </div>
            
            <br/>
            <button type="submit" class="btn btn-primary">Buscar</button>
        </form>
    
           
        </div>
    </div>


@endsection