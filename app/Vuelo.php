<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Aeropuerto;
use App\Recorrido;

class Vuelo extends Model
{
    protected $table = "vuelos";
    
    protected $fillable = [
        "aeropuertos_origen_id",
        "aeropuertos_destino_id",
        "capacidad_economica",
        "capacidad_bussiness",
        "capacidad_discapacidad_economica",
        "capacidad_discapacidad_bussiness",
        "patente"
    ];
    
    protected $dates = [
        "tiempo_salida",
        "tiempo_llegada"
    ];
    
    public function aeropuerto_origen(){
        return $this->belongsTo(Aeropuerto::class,'aeropuerto_origen_id');
    }
    
    public function aeropuerto_destino(){
        return $this->belongsTo(Aeropuerto::class,'aeropuerto_destino_id');
    }
    
    public function recorridos(){
        return $this->belongsToMany(Recorrido::class);
    }
}
