@extends('layouts.app')
@section('content')

<div class="container">
    <div class="align-content-center">

@foreach($compras as $compra)

<div class="card">
    <div class="card-header">
      Id de compra: {{$compra->id}}
    </div>
    <div class="card-body">
        <h5 class="card-title">Costo: $ {{$compra->reserva()->first()->costo}}</h5>
        <p class="card-text">
            Seguro: {{$compra->reserva()->first()->seguro ? "Si" : "No"}}<br>
            Fecha: {{$compra->fecha_compra}}<br>
            Medio de Pago:
            @if ($compra->medio_pago == 1)
            Efectivo
            @elseif ($compra->medio_pago == 2)
            Tarjeta
            @else
            Cheque
            @endif <br>
            Check In: {{$compra->checkeada ? "Si": "No"}}
        </p>
        @if (!$compra->checkeada)
        <a href="http://192.168.10.10/check-in?compra={{$compra->id}}">
            <button type="button" class="btn btn-primary">Confirmar</button>
        </a>
        @endif
    </div>
</div>
<br>

@endforeach

</div>
</div>

@endsection
