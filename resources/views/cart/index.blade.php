@extends('layouts.app')
@section('content')
  <h3>Contenido Carrito</h3>
  <ol>
  	@foreach($cartItems as $cartItem)
  		<li> {{$cartItem->nombre}}</li>
  	@endforeach
  </ol>
@endsection