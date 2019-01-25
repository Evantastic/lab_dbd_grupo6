@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="align-content-center">

            <form action="/viaje/" method="POST">

                <div class="form-group row">
                    <label for="ciudad_origen_id" class="col-2 col-form-label">Ciudad Origen Id</label>
                    <div class="col-10">
                        <input class="form-control" type="number" value="" id="ciudad_origen_id" name="ciudad_origen_id">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="ciudad_destino_id" class="col-2 col-form-label">Ciudad Destino Id</label>
                    <div class="col-10">
                        <input class="form-control" type="number" value="" id="ciudad_destino_id" name="ciudad_destino_id">
                    </div>
                </div>

                <br/>

                <button type="submit" class="btn btn-primary">Publicar</button>
                <a href="http://192.168.10.10/admin">
                    <button type="button" class="btn btn-primary">Volver</button>
                </a>
            </form>
        </div>
    </div>
@endsection
