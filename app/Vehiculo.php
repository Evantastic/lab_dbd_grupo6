<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vehiculo extends Model
{
    protected $table = "vehiculos";
    public function automotora(){
        return $this->belongsTo(Automotora::class);
    }
    public function paquetes(){
        return $this->hasMany(Paquete::class);
    }
    public function reservas(){
        return $this->belongsToMany(Reserva::class);
    }
}
