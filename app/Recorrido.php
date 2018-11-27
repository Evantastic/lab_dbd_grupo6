<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recorrido extends Model
{
    protected $table = "recorridos";
    
    public function vuelos(){
        return $this->belongsToMany(Vuelo::class);
    }
    
    public function paquetes(){
        return $this->hasMany(Paquete::class);
    }

    public function reservas(){
        return $this->belongsToMany(Reserva::class);
    }
}
