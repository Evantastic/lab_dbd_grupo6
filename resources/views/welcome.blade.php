@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row">

        <div class="col-lg-3">

            <h1 class="my-4">Atam Airlines</h1>
            <div class="list-group">
                <a href="http://192.168.10.10/paquete/" class="list-group-item">Paquetes</a>
            </div>

        </div>

        <div class="col-lg-9">
            <br/>
            <div class="jumbotron jumbotron-fluid">
                <div class="container">
                    <h1 class="display-4">Disfruta de nuestros viajes</h1>
                    <p class="lead">Si no tienes un objetivo fijo ¡Mira nuestros destinos!</p>
                    <a href="http://192.168.10.10/buscar/">
                        <button type="button" class="btn btn-primary">En caso contrario, cuéntanos hacia donde vas</button>
                    </a>
                </div>
            </div>

            <div class="row">
                @foreach($viajes as $viaje)
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card h-100">
                        <a href="http://192.168.10.10/viaje/{{$viaje->id}}"><img class="card-img-top" src="https://o.aolcdn.com/images/dims3/GLOB/crop/2200x1103+0+191/resize/630x315!/format/jpg/quality/85/http%3A%2F%2Fo.aolcdn.com%2Fhss%2Fstorage%2Fmidas%2Fbed3568ba66967253916f23bdca8aa86%2F205548752%2FRTSSS75.jpeg" alt=""></a>
                        <div class="card-body">
                            <h4 class="card-title">
                                <a href="http://192.168.10.10/viaje/{{$viaje->id}}">{{ $viaje->ciudad_destino()->first()->nombre_pais}}</a>
                            </h4>
                            <p class="card-text">Desde {{ $viaje->ciudad_origen()->first()->nombre_pais}}</p>
                        </div>
                        <div class="card-footer">
                            <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <!-- /.row -->

        </div>
        <!-- /.col-lg-9 -->

    </div>
    <!-- /.row -->

</div>

@endsection
