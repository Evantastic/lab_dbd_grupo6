<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vehiculo extends Model
{
    protected $table = "vehiculos";

    protected $fillable = [
        'automotora_id',
        'marca',
        'modelo',
        'tipo',
        'patente',
        'precio',
        'capacidad'
    ];
    
    public function automotora(){
        return $this->belongsTo(Automotora::class);
    }

    public function paquetes(){
        return $this->hasMany(Paquete::class);
    }

    public function reserva_vehiculos(){
        return $this->hasMany(Paquete::class);
    }
}
