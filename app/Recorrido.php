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

    public function recorrido_reservas(){
        return $this->hasMany(Recorrido_Reserva::class);
    }

    public function viaje(){
        return $this->belongsTo(Viaje::class);
    }
}
