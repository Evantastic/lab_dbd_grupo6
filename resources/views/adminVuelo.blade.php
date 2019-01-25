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

        <div class="form-group">
          <script type="text/javascript">
              $(function () {
                  $('#datetimepicker1').datetimepicker();
              });
          </script>
            <div class="input-group date" id="datetimepicker1" data-target-input="nearest">
              <label for="tiempo_salida" class="col-2 col-form-label">Tiempo Salida</label>
                <input type="text" class="form-control datetimepicker-input" data-target="#datetimepicker1" id="tiempo_salida" name="tiempo_salida"/>
                <div class="input-group-append" data-target="#datetimepicker1" data-toggle="datetimepicker">
                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                </div>
            </div>
        </div>

        <div class="form-group">
          <script type="text/javascript">
              $(function () {
                  $('#datetimepicker2').datetimepicker();
              });
          </script>
            <div class="input-group date" id="datetimepicker2" data-target-input="nearest">
              <label for="tiempo_llegada" class="col-2 col-form-label">Tiempo Llegada</label>
                <input type="text" class="form-control datetimepicker-input" data-target="#datetimepicker2" id="tiempo_llegada" name="tiempo_llegada"/>
                <div class="input-group-append" data-target="#datetimepicker2" data-toggle="datetimepicker">
                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                </div>
            </div>
        </div>

        <div class="form-group row">
            <label for="patente" class="col-2 col-form-label">Patente</label>
            <div class="col-10">
                <input class="form-control" type="text" value="" id="patente" name="patente">
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
