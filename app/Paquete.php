<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paquete extends Model
{
    protected $table = "paquetes";
    
    public function recorrido(){
        return $this->belongsTo(Recorrido::class);
    }
    
    public function vehiculo(){
        return $this->belongsTo(Vehiculo::class);
    }

    public function habitacion(){
        return $this->belongsTo(Habitacion::class);
    }

    public function reservas(){
        return $this->belongsToMany(Reserva::class);
    }
}
