@extends('layouts.app')
@section('content')

@foreach($habitaciones as $habitacion)
<p>
  {{$habitacion}}
</p><br>
@endforeach


@endsection
