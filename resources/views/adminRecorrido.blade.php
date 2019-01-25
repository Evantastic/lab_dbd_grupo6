@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="align-content-center">

            <form action="/recorrido/" method="POST">

                <div class="form-group row">
                    <label for="viaje_id" class="col-2 col-form-label">Viaje Id</label>
                    <div class="col-10">
                        <input class="form-control" type="number" value="" id="viaje_id" name="viaje_id">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="costo_economico" class="col-2 col-form-label">Costo Pasaje Económico</label>
                    <div class="col-10">
                        <input class="form-control" type="number" min="0" value="" id="costo_economico" name="costo_economico">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="costo_bussiness" class="col-2 col-form-label">Costo Pasaje Bussiness</label>
                    <div class="col-10">
                        <input class="form-control" type="number" min="0"  value="" id="costo_bussiness" name="costo_bussiness">
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