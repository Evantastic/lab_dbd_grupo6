@extends('layouts.app')
@section('content')

@foreach($vehiculos as $vehiculo)
<p>
  {{$vehiculo}}
</p><br>
@endforeach

@endsection
