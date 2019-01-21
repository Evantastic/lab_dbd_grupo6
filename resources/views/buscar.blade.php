@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="center-block">
            <form>
                <div class="form-group">
                    <label for="origen">Ciudad de origen</label>
                    <input type="text" class="form-control" id="origen" name="origen" aria-describedby="origenHelp" placeholder="Ingrese la ciudad de origen">
                    <small id="origenHelp" class="form-text text-muted">Cuentanos de donde quieres partir</small>
                </div>

                <div class="form-group">
                    <label for="destino">Ciudad de destino</label>
                    <input type="text" class="form-control" id="destino" name="destino" aria-describedby="destinoHelp" placeholder="Ingrese la ciudad de destino">
                    <small id="destinoHelp" class="form-text text-muted">Dinos hacia donde quieres llegar</small>
                </div>

                <a href="http://192.168.10.10/buscar/#origen/#destino">
                    <button type="submit" class="btn btn-primary">Buscar</button>
                </a>
            </form>
        </div>
    </div>


@endsection