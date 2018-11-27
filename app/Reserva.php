<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    protected $table = "reservas";

    public function recorridos(){
        $this->belongsToMany(Recorrido::class);
    }

    public function paquetes(){
        $this->belongsToMany(Paquete::class);
    }

    public function habitaciones(){
        $this->belongsToMany(Habitacion::class,'habitacion_reserva');
    }

    public function vehiculos(){
        $this->belongsToMany(Vehiculo::class);
    }
}
