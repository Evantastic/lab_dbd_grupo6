<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Recorrido_Vuelo;
use App\Paquete;

class Recorrido extends Model
{
    protected $table = 'recorridos';

    protected $fillable = [
        'costo_economico',
        'costo_bussiness'
    ];
    
    public function recorrido_vuelos(){
        return $this->hasMany(Recorrido_Vuelo::class);
    }
    
    public function paquetes(){
        return $this->hasMany(Paquete::class);
    }

    public function reservas(){
        return $this->belongsToMany(Reserva::class);
    }
}
