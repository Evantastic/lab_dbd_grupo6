@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Administrador</div>

                <div class="card-body">
                    Bienvenido a la página de admin
                </div>
            </div>
        </div>
      </div>
      <div class="col-centered">
        <br>
        <div class="jumbotron">
          <h1 class="display-4">Publicar</h1>
          <p class="lead">Con los siguientes botones puede publicar información</p>
          <hr class="my-4">
          <p>Un gran poder conlleva una gran personalidad</p>
          <p class="lead">
            <a class="btn btn-primary btn-lg" href="/admin/vuelo" role="button">Vuelo</a>
          </p>
          <p class="lead">
            <a class="btn btn-primary btn-lg" href="/admin/recorrido" role="button">Recorrido</a>
          </p>
          <p class="lead">
            <a class="btn btn-primary btn-lg" href="/admin/viaje" role="button">Viaje</a>
          </p>
        </div>
    </div>
</div>
@endsection
