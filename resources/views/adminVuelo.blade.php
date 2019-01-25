@extends('layouts.app')

@section('content')
<div class="container">
  <div class="align-content-center">

    <form action="/vuelo/" method="POST">

        <div class="form-group row">
            <label for="aeropuerto_origen_id" class="col-2 col-form-label">Aeropuerto Origen Id</label>
            <div class="col-10">
                <input class="form-control" type="number" value="" id="aeropuerto_origen_id" name="aeropuerto_origen_id">
            </div>
        </div>

        <div class="form-group row">
            <label for="aeropuerto_destino_id" class="col-2 col-form-label">Aeropuerto Destino Id</label>
            <div class="col-10">
                <input class="form-control" type="number" value="" id="aeropuerto_destino_id" name="aeropuerto_destino_id">
            </div>
        </div>

        <div class="form-group row">
            <label for="capacidad_economica" class="col-2 col-form-label">Capacidad Económica</label>
            <div class="col-10">
                <input class="form-control" type="number" value="" id="capacidad_economica" name="capacidad_economica">
            </div>
        </div>

        <div class="form-group row">
            <label for="capacidad_bussiness" class="col-2 col-form-label">Capacidad Bussiness</label>
            <div class="col-10">
                <input class="form-control" type="number" value="" id="capacidad_bussiness" name="capacidad_bussiness">
            </div>
        </div>

        <div class="form-group row">
            <label for="capacidad_discapacidad_economica" class="col-2 col-form-label">Capacidad Discapacidad Económica</label>
            <div class="col-10">
                <input class="form-control" type="number" value="" id="capacidad_discapacidad_economica" name="capacidad_discapacidad_economica">
            </div>
        </div>

        <div class="form-group row">
            <label for="capacidad_discapacidad_bussiness" class="col-2 col-form-label">Capacidad Discapacidad Bussiness</label>
            <div class="col-10">
                <input class="form-control" type="number" value="" id="capacidad_discapacidad_bussiness" name="capacidad_discapacidad_bussiness">
            </div>
        </div>

        <div class='input-group date row' id='datetimepicker1'>
          <input type='text' class="form-control" />
            <span class="input-group-addon">
              <span class="glyphicon glyphicon-calendar"></span>
            </span>
          </div>

        <div class="form-group row">
            <label for="patente" class="col-2 col-form-label">Patente</label>
            <div class="col-10">
                <input class="form-control" type="text" value="" id="patente" name="patente">
            </div>
        </div>

        <br/>

        <button type="submit" class="btn btn-primary">Publicar</button>
    </form>
  </div>
</div>
@endsection
