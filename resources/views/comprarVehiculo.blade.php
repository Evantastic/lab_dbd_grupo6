@extends('layouts.app')
@section('content')

<div class="container">
    <div class="align-content-center">


        <form action="{{$vehiculo->id}}/boleta" method="get">
            <div class="form-group row">
                <label for="nombreInput" class="col-2 col-form-label">Nombre</label>
                <div class="col-10">
                    <input class="form-control" type="text" value="" id="nombreInput" name="nombre">
                </div>
            </div>
            <div class="form-group row">
                <label for="apellidoInput" class="col-2 col-form-label">Apellido</label>
                <div class="col-10">
                    <input class="form-control" type="text" value="" id="apellidoInput" name="apellido">
                </div>
            </div>
            <div class="form-group row">
                <label for="nacionalidadInput" class="col-2 col-form-label">Nacionalidad</label>
                <div class="col-10">
                    <input class="form-control" type="text" value="" id="nacionalidadInput" name="nacionalidad">
                </div>
            </div>
            <div class="form-group row">
                <label for="edadInput" class="col-2 col-form-label">Edad</label>
                <div class="col-10">
                    <input class="form-control" type="number" value="" id="edadInput" name="edad">
                </div>
            </div>
            <div class="form-group row">
                <label for="emailInput" class="col-2 col-form-label">Email</label>
                <div class="col-10">
                    <input class="form-control" type="email" value="" id="emailInput" name="email">
                </div>
            </div>

            <div class="form-group row">
                <label for="fecha_inicio" class="col-2 col-form-label">Fecha Inicio</label>
                <div class="col-10">
                    <input class="form-control" type="text" value="" id="fecha_inicio" name="fecha_inicio">
                </div>
                <small id="medioHelp" class="form-text text-muted">En formato Año-mes-día</small>
            </div>

            <div class="form-group row">
                <label for="fecha_termino" class="col-2 col-form-label">Fecha Termino</label>
                <div class="col-10">
                    <input class="form-control" type="text" value="" id="fecha_termino" name="fecha_termino">
                </div>
                <small id="medioHelp" class="form-text text-muted">En formato Año-mes-día</small>
            </div>

            <div class="form-group row">
                <label for="medioInput" class="col-2 col-form-label">Medio de pago</label>
                <div class="col-10">
                    <input class="form-control" type="number" value="" id="medioInput" name="medio" min="1" max="3">
                </div>
                <small id="medioHelp" class="form-text text-muted">1 para efectivo, 2 para tarjeta, 3 para cheque</small>
            </div>
            <br/>
            <button type="submit" class="btn btn-primary">Ver boleta</button>
        </form>
    </div>
</div>

@endsection
