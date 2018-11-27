<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vuelo extends Model
{
    protected $table = "vuelos";
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
