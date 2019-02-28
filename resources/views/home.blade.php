@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div>
    </div>
    <div class="col-centered">
      <br>
      <div class="jumbotron">
        <h1 class="display-4">Información</h1>
          <p class="lead">Con los siguientes botones podrás ver tu información</p>
          <hr class="my-4">
          <p class="lead">
            <a class="btn btn-primary btn-lg" href="/usuario/{{Auth::user()->id}}" role="button">Compras</a>
          </p>
      </div>
  </div>
</div>
@endsection
