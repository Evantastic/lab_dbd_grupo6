@extends('layouts.app')
@section('content')

<div class="container">
    <div class="align-content-center">

@if ($error404)

<div class="jumbotron">
  <h1 class="display-4">Error</h1>
  <p class="lead">No existe la compra.</p>
  <hr class="my-4">
  <p>Vuelva a la pantalla principal y corrija la compra.</p>
  <p class="lead">
    <a class="btn btn-primary btn-lg" href="http://192.168.10.10/" role="button">Volver</a>
  </p>
</div>
@elseif ($errorCheckeada)
<div class="jumbotron">
  <h1 class="display-4">Error</h1>
  <p class="lead">Ya se ha realizado un check in a la compra con anterioridad.</p>
  <hr class="my-4">
  <p>Vuelva a la pantalla principal y corrija la compra.</p>
  <p class="lead">
    <a class="btn btn-primary btn-lg" href="http://192.168.10.10/" role="button">Volver</a>
  </p>
</div>
@else
<div class="jumbotron">
  <h1 class="display-4">Felicidades</h1>
  <p class="lead">Se ha realizado el check in a la compra.</p>
  <hr class="my-4">
  <p>Vuelva a la pagina principal y siga comprando con nosotros.</p>
  <p class="lead">
    <a class="btn btn-primary btn-lg" href="http://192.168.10.10/" role="button">Volver</a>
  </p>
</div>
@endif
</div></div>
@endsection
