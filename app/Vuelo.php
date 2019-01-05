<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Aeropuerto;
use App\Recorrido_Vuelo;
use App\Pasaje;

class Vuelo extends Model
{
    protected $table = 'vuelos';
    
    protected $fillable = [
        'aeropuerto_origen_id',
        'aeropuerto_destino_id',
        'capacidad_economica',
        'capacidad_bussiness',
        'capacidad_discapacidad_economica',
        'capacidad_discapacidad_bussiness',
        'patente',
        'tiempo_salida',
        'tiempo_llegada'
    ];
    
    protected $dates = [
        'tiempo_salida',
        'tiempo_llegada'
    ];

    public function getDateFormat()
    {
        return 'Y-m-d H:i:s';
    }
    
    public function aeropuerto_origen(){
        return $this->belongsTo(Aeropuerto::class,'aeropuerto_origen_id');
    }
    
    public function aeropuerto_destino(){
        return $this->belongsTo(Aeropuerto::class,'aeropuerto_destino_id');
    }
    
    public function recorrido_vuelos(){
        return $this->hasMany(Recorrido_Vuelo::class);
    }
    
    public function pasajes(){
        return $this->hasMany(Pasaje::class);
    }
}
